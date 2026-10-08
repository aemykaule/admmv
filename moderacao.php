<?php
session_start();

/* Verifica se o administrador está logado */
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/conexao.php';

/* Logout */
if (isset($_GET['sair'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

/* Token de segurança dos formulários */
if (empty($_SESSION['csrf_moderacao'])) {
    $_SESSION['csrf_moderacao'] = bin2hex(random_bytes(32));
}

/* Filtro atual */
$filtrosPermitidos = ['pendente', 'aprovado', 'recusado', 'inativo'];
$filtro = $_GET['filtro'] ?? $_POST['filtro'] ?? 'pendente';

if (!in_array($filtro, $filtrosPermitidos, true)) {
    $filtro = 'pendente';
}

$mensagem = '';
$tipoMensagem = 'sucesso';

/* Processa ações */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';

    if (!is_string($token) || !hash_equals($_SESSION['csrf_moderacao'], $token)) {
        $mensagem = 'Sessão de segurança inválida. Atualize a página e tente novamente.';
        $tipoMensagem = 'erro';
    } else {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $acao = $_POST['acao'] ?? '';
        $filtroPost = $_POST['filtro'] ?? 'pendente';

        if (!in_array($filtroPost, $filtrosPermitidos, true)) {
            $filtroPost = 'pendente';
        }

        if (!$id || $id <= 0) {
            $mensagem = 'Feedback inválido.';
            $tipoMensagem = 'erro';
        } else {
            /* Confere se o feedback existe e não está arquivado */
            $stmt = $conexao->prepare(
                "SELECT status FROM feedbacks WHERE id = ? AND arquivado = 0 LIMIT 1"
            );
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $resultadoAtual = $stmt->get_result();
            $feedbackAtual = $resultadoAtual->fetch_assoc();
            $stmt->close();

            if (!$feedbackAtual) {
                $mensagem = 'Feedback não encontrado.';
                $tipoMensagem = 'erro';
            } elseif ($feedbackAtual['status'] === 'inativo') {
                $mensagem = 'Feedbacks inativos não podem receber novas ações.';
                $tipoMensagem = 'erro';
            } else {
                $novoStatus = null;
                $redirecionarMensagem = '';

                if ($acao === 'aprovar') {
                    $novoStatus = 'aprovado';
                    $redirecionarMensagem = 'aprovado';
                } elseif ($acao === 'recusar') {
                    $novoStatus = 'recusado';
                    $redirecionarMensagem = 'recusado';
                } elseif ($acao === 'inativar') {
                    $novoStatus = 'inativo';
                    $redirecionarMensagem = 'inativo';
                } elseif ($acao === 'mover_aprovados') {
                    $novoStatus = 'aprovado';
                    $redirecionarMensagem = 'movido';
                } elseif ($acao === 'mover_recusados') {
                    $novoStatus = 'recusado';
                    $redirecionarMensagem = 'movido';
                } elseif ($acao === 'remover') {
                    /* Exclusão definitiva somente de aprovados ou recusados */
                    if (in_array($feedbackAtual['status'], ['aprovado', 'recusado'], true)) {
                        $stmt = $conexao->prepare(
                            "DELETE FROM feedbacks
                             WHERE id = ? AND arquivado = 0
                             AND status IN ('aprovado', 'recusado')"
                        );
                        $stmt->bind_param('i', $id);
                        $stmt->execute();
                        $removido = $stmt->affected_rows > 0;
                        $stmt->close();

                        $msg = $removido ? 'removido' : 'erro';
                    } else {
                        $msg = 'erro';
                    }

                    header('Location: moderacao.php?filtro=' . urlencode($filtroPost) . '&msg=' . $msg);
                    exit;
                } else {
                    $mensagem = 'Ação inválida.';
                    $tipoMensagem = 'erro';
                }

                if ($novoStatus !== null) {
                    $stmt = $conexao->prepare(
                        "UPDATE feedbacks
                         SET status = ?
                         WHERE id = ? AND arquivado = 0 AND status <> 'inativo'"
                    );
                    $stmt->bind_param('si', $novoStatus, $id);
                    $stmt->execute();
                    $atualizado = $stmt->affected_rows >= 0;
                    $stmt->close();

                    $msg = $atualizado ? $redirecionarMensagem : 'erro';
                    header('Location: moderacao.php?filtro=' . urlencode($filtroPost) . '&msg=' . $msg);
                    exit;
                }
            }
        }
    }
}

/* Mensagens após redirecionamento */
if (isset($_GET['msg'])) {
    $mensagens = [
        'aprovado' => ['Feedback aprovado e adicionado ao mural.', 'sucesso'],
        'recusado' => ['Feedback recusado.', 'erro'],
        'inativo' => ['Feedback inativado. Ele não poderá mais receber ações.', 'sucesso'],
        'movido' => ['Status do feedback atualizado.', 'sucesso'],
        'removido' => ['Feedback apagado definitivamente do sistema.', 'sucesso'],
        'erro' => ['Não foi possível concluir a ação.', 'erro']
    ];

    if (isset($mensagens[$_GET['msg']])) {
        [$mensagem, $tipoMensagem] = $mensagens[$_GET['msg']];
    }
}

/* Contagem dos feedbacks */
$quantidades = [
    'pendente' => 0,
    'aprovado' => 0,
    'recusado' => 0,
    'inativo' => 0
];

$resultadoContagem = $conexao->query(
    "SELECT status, COUNT(*) AS total
     FROM feedbacks
     WHERE arquivado = 0
     GROUP BY status"
);

if ($resultadoContagem) {
    while ($item = $resultadoContagem->fetch_assoc()) {
        if (isset($quantidades[$item['status']])) {
            $quantidades[$item['status']] = (int) $item['total'];
        }
    }
}

/* Busca feedbacks — mantém os nomes de coluna do código enviado */
$stmt = $conexao->prepare(
    "SELECT id, titulo, categoria, texto, data_criacao, status
     FROM feedbacks
     WHERE status = ? AND arquivado = 0
     ORDER BY data_criacao DESC"
);
$stmt->bind_param('s', $filtro);
$stmt->execute();
$resultadoFeedbacks = $stmt->get_result();

function e($valor) {
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

function dataFormatada($data) {
    if (empty($data)) {
        return 'Data não informada';
    }
    $timestamp = strtotime($data);
    return $timestamp ? date('d/m/Y H:i', $timestamp) : 'Data não informada';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderação de Feedbacks | Sesc Senac Caiobá</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        azul: '#003B5C',
                        azul2: '#005B82',
                        laranja: '#F58220',
                        laranjaEscuro: '#D96500',
                        fundo: '#F5F7F8'
                    }
                }
            }
        };
    </script>
</head>

<body class="min-h-screen bg-fundo text-slate-800">
<header class="bg-azul">
    <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-5 px-5 py-5">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-orange-300">Administração</p>
            <h1 class="mt-1 text-xl font-black text-white">Painel Administrativo</h1>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <a href="editar_site.php" class="rounded-xl border border-white/20 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-white/10">
                <i class="bi bi-pencil-square mr-2"></i>Editar site
            </a>
            <a href="index.php" class="rounded-xl border border-white/20 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-white/10">
                <i class="bi bi-house-door mr-2"></i>Voltar ao site
            </a>
            <a href="moderacao.php?sair=1" class="rounded-xl bg-laranja px-5 py-2.5 text-sm font-bold text-white transition hover:bg-laranjaEscuro">
                <i class="bi bi-box-arrow-right mr-1"></i>Sair
            </a>
        </div>
    </div>
</header>

<main class="mx-auto max-w-7xl px-5 py-12">
    <div class="mb-10">
        <span class="text-sm font-bold uppercase tracking-wider text-laranja">Feedbacks dos estudantes</span>
        <h2 class="mt-3 text-4xl font-black text-azul md:text-5xl">Moderação de feedbacks</h2>
        <p class="mt-4 max-w-2xl leading-7 text-slate-500">
            Analise os feedbacks enviados pelos estudantes antes de permitir que sejam publicados no mural.
        </p>
    </div>

    <?php if ($mensagem !== ''): ?>
        <div class="mb-8 rounded-xl border px-5 py-4 text-sm font-bold
            <?= $tipoMensagem === 'erro'
                ? 'border-red-200 bg-red-50 text-red-700'
                : 'border-green-200 bg-green-50 text-green-700' ?>">
            <i class="bi <?= $tipoMensagem === 'erro' ? 'bi-exclamation-circle' : 'bi-check-circle' ?> mr-2"></i>
            <?= e($mensagem) ?>
        </div>
    <?php endif; ?>

    <?php
    $abas = [
        'pendente' => ['Pendentes', 'bi-hourglass-split'],
        'aprovado' => ['Aprovados', 'bi-check-circle'],
        'recusado' => ['Recusados', 'bi-x-circle'],
        'inativo' => ['Inativos', 'bi-archive']
    ];
    ?>

    <nav class="mb-8 flex flex-wrap gap-3 border-b border-slate-200 pb-6">
        <?php foreach ($abas as $status => $dados): ?>
            <a href="moderacao.php?filtro=<?= e($status) ?>"
               class="rounded-xl px-5 py-3 text-sm font-bold transition
               <?= $filtro === $status ? 'bg-azul text-white' : 'bg-white text-slate-600 hover:bg-slate-100' ?>">
                <i class="bi <?= e($dados[1]) ?> mr-1"></i>
                <?= e($dados[0]) ?> (<?= $quantidades[$status] ?>)
            </a>
        <?php endforeach; ?>
    </nav>

    <?php if ($resultadoFeedbacks && $resultadoFeedbacks->num_rows > 0): ?>
        <div class="space-y-5">
            <?php while ($feedback = $resultadoFeedbacks->fetch_assoc()): ?>
                <article class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm transition hover:shadow-md">
                    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
                        <div>
                            <span class="inline-block rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-laranjaEscuro">
                                <?= e($feedback['categoria'] ?: 'Sem categoria') ?>
                            </span>
                            <h3 class="mt-4 break-words text-xl font-black text-azul">
                                <?= e($feedback['titulo'] ?: 'Feedback sem título') ?>
                            </h3>
                            <p class="mt-2 text-xs text-slate-400">
                                <i class="bi bi-calendar3 mr-1"></i><?= e(dataFormatada($feedback['data_criacao'])) ?>
                                <span class="mx-1">•</span>ID: <?= (int) $feedback['id'] ?>
                            </p>
                        </div>

                        <?php
                        $statusLabels = [
                            'pendente' => ['Pendente', 'bg-yellow-100 text-yellow-700'],
                            'aprovado' => ['Aprovado', 'bg-green-100 text-green-700'],
                            'recusado' => ['Recusado', 'bg-red-100 text-red-700'],
                            'inativo' => ['Inativo', 'bg-slate-200 text-slate-600']
                        ];
                        $statusInfo = $statusLabels[$feedback['status']] ?? ['Desconhecido', 'bg-slate-100 text-slate-600'];
                        ?>
                        <span class="w-fit rounded-full px-3 py-1 text-xs font-bold <?= e($statusInfo[1]) ?>">
                            <?= e($statusInfo[0]) ?>
                        </span>
                    </div>

                    <p class="mt-5 whitespace-pre-line break-words leading-7 text-slate-600"><?= e($feedback['texto']) ?></p>

                    <div class="mt-6 flex flex-wrap items-center justify-between gap-4 border-t border-slate-100 pt-5">
                        <span class="text-xs text-slate-400">
                            <i class="bi bi-person-lock mr-1"></i>Feedback anônimo
                        </span>

                        <?php if ($feedback['status'] !== 'inativo'): ?>
                            <div class="flex flex-wrap gap-3">
                                <?php if ($feedback['status'] === 'pendente'): ?>
                                    <form method="POST" action="moderacao.php">
                                        <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_moderacao']) ?>">
                                        <input type="hidden" name="id" value="<?= (int) $feedback['id'] ?>">
                                        <input type="hidden" name="acao" value="aprovar">
                                        <input type="hidden" name="filtro" value="<?= e($filtro) ?>">
                                        <button type="submit" class="rounded-xl bg-azul px-5 py-3 text-sm font-bold text-white transition hover:bg-azul2">
                                            <i class="bi bi-check-lg mr-1"></i>Aprovar
                                        </button>
                                    </form>

                                    <form method="POST" action="moderacao.php">
                                        <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_moderacao']) ?>">
                                        <input type="hidden" name="id" value="<?= (int) $feedback['id'] ?>">
                                        <input type="hidden" name="acao" value="recusar">
                                        <input type="hidden" name="filtro" value="<?= e($filtro) ?>">
                                        <button type="submit" class="rounded-xl bg-red-50 px-5 py-3 text-sm font-bold text-red-600 transition hover:bg-red-100">
                                            <i class="bi bi-x-lg mr-1"></i>Recusar
                                        </button>
                                    </form>

                                    <form method="POST" action="moderacao.php">
                                        <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_moderacao']) ?>">
                                        <input type="hidden" name="id" value="<?= (int) $feedback['id'] ?>">
                                        <input type="hidden" name="acao" value="inativar">
                                        <input type="hidden" name="filtro" value="<?= e($filtro) ?>">
                                        <button type="submit" class="rounded-xl border border-slate-200 px-5 py-3 text-sm font-bold text-slate-600 transition hover:bg-slate-100">
                                            <i class="bi bi-archive mr-1"></i>Inativar
                                        </button>
                                    </form>

                                <?php elseif (in_array($feedback['status'], ['aprovado', 'recusado'], true)): ?>
                                    <?php if ($feedback['status'] === 'aprovado'): ?>
                                        <form method="POST" action="moderacao.php">
                                            <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_moderacao']) ?>">
                                            <input type="hidden" name="id" value="<?= (int) $feedback['id'] ?>">
                                            <input type="hidden" name="acao" value="mover_recusados">
                                            <input type="hidden" name="filtro" value="<?= e($filtro) ?>">
                                            <button type="submit" class="rounded-xl border border-slate-200 px-5 py-3 text-sm font-bold text-slate-600 transition hover:bg-slate-100">
                                                <i class="bi bi-arrow-left-right mr-1"></i>Mover para recusados
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <form method="POST" action="moderacao.php">
                                            <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_moderacao']) ?>">
                                            <input type="hidden" name="id" value="<?= (int) $feedback['id'] ?>">
                                            <input type="hidden" name="acao" value="mover_aprovados">
                                            <input type="hidden" name="filtro" value="<?= e($filtro) ?>">
                                            <button type="submit" class="rounded-xl bg-green-50 px-5 py-3 text-sm font-bold text-green-700 transition hover:bg-green-100">
                                                <i class="bi bi-arrow-left-right mr-1"></i>Mover para aprovados
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                    <form method="POST" action="moderacao.php" class="form-remover">
                                        <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_moderacao']) ?>">
                                        <input type="hidden" name="id" value="<?= (int) $feedback['id'] ?>">
                                        <input type="hidden" name="acao" value="remover">
                                        <input type="hidden" name="filtro" value="<?= e($filtro) ?>">
                                        <button type="button" class="btn-remover rounded-xl bg-red-50 px-5 py-3 text-sm font-bold text-red-600 transition hover:bg-red-100">
                                            <i class="bi bi-trash3 mr-1"></i>Excluir definitivamente
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <span class="text-sm text-slate-400">
                                <i class="bi bi-lock mr-1"></i>Sem ações disponíveis
                            </span>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
            <div class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-slate-100 text-2xl text-azul">
                <i class="bi bi-inbox"></i>
            </div>
            <h3 class="mt-5 text-xl font-black text-azul">Nenhum feedback encontrado</h3>
            <p class="mt-2 text-sm text-slate-500">
                <?php
                $vazios = [
                    'pendente' => 'Não existem feedbacks aguardando moderação.',
                    'aprovado' => 'Nenhum feedback foi aprovado ainda.',
                    'recusado' => 'Nenhum feedback foi recusado ainda.',
                    'inativo' => 'Não há feedbacks inativos.'
                ];
                echo e($vazios[$filtro]);
                ?>
            </p>
        </div>
    <?php endif; ?>
</main>

<!-- Confirmação de exclusão -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastExclusao" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Confirmar exclusão</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            <p class="mb-0">Este feedback será retirado definitivamente do sistema. Essa ação não poderá ser desfeita.</p>
            <div class="mt-3 flex gap-2">
                <button type="button" class="btn btn-danger btn-sm" id="confirmarExclusao">Sim, excluir</button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const toastElement = document.getElementById('toastExclusao');
    const toast = new bootstrap.Toast(toastElement, { autohide: false });
    let formularioAtual = null;

    document.querySelectorAll('.btn-remover').forEach(function (botao) {
        botao.addEventListener('click', function () {
            formularioAtual = botao.closest('.form-remover');
            toast.show();
        });
    });

    document.getElementById('confirmarExclusao').addEventListener('click', function () {
        if (formularioAtual) {
            formularioAtual.submit();
        }
    });
</script>
</body>
</html>
<?php
$stmt->close();
$conexao->close();
?>
