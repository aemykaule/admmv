
<?php

session_start();

if (
    !isset($_SESSION['admin']) ||
    $_SESSION['admin'] !== true
) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/conexao.php';

if (empty($_SESSION['csrf_editor_site'])) {
    $_SESSION['csrf_editor_site'] = bin2hex(random_bytes(32));
}

// Textos editáveis.
$camposTexto = [
    'inicio_etiqueta' => [
        'label' => 'Início — etiqueta',
        'padrao' => 'Ensino Médio Integrado ao Técnico'
    ],
    'inicio_titulo' => [
        'label' => 'Início — título',
        'padrao' => 'Formação completa em Caiobá.'
    ],
    'inicio_descricao' => [
        'label' => 'Início — descrição',
        'padrao' => 'No Sesc Senac Caiobá, o Ensino Médio é integrado ao curso Técnico em Informática para Internet, unindo formação geral, tecnologia e preparação para o mundo do trabalho.'
    ],
    'escola_titulo' => [
        'label' => 'Escola — título',
        'padrao' => 'Ensino Médio e formação técnica no mesmo percurso'
    ],
    'escola_descricao' => [
        'label' => 'Escola — descrição',
        'padrao' => 'A unidade de Caiobá, em Matinhos, oferece o Técnico em Informática para Internet integrado ao Ensino Médio. Ao longo dos três anos, o estudante desenvolve a formação da Educação Básica junto com competências profissionais da área de tecnologia.'
    ],
    'objetivo_titulo' => [
        'label' => 'Objetivo — título',
        'padrao' => 'Objetivo do programa'
    ],
    'objetivo_descricao' => [
        'label' => 'Objetivo — descrição',
        'padrao' => 'A formação busca desenvolver cidadania, acesso à cultura, crescimento pessoal e preparação profissional, fortalecendo competências socioemocionais e o protagonismo juvenil.'
    ],
    'ensino_titulo' => [
        'label' => 'Ensino — título',
        'padrao' => 'Ensino integrado e aprendizagem na prática'
    ],
    'curso_titulo' => [
        'label' => 'Curso técnico — título',
        'padrao' => 'Técnico em Informática para Internet'
    ],
    'projetos_titulo' => [
        'label' => 'Projetos — título',
        'padrao' => 'Ciência, tecnologia e realidade local'
    ],
    'espacos_titulo' => [
        'label' => 'Espaços escolares — título',
        'padrao' => 'Espaços para aprender além da sala de aula'
    ],
];

// Imagens editáveis.
$camposImagem = [
    'imagem_escola_1' => [
        'label' => 'Carrossel da escola — imagem 1',
        'padrao' => './img/iscola.png'
    ],
    'imagem_escola_2' => [
        'label' => 'Carrossel da escola — imagem 2',
        'padrao' => './img/volei-sesc.png'
    ],
    'imagem_escola_3' => [
        'label' => 'Carrossel da escola — imagem 3',
        'padrao' => './img/formatura-sesc.png'
    ],
    'imagem_escola_4' => [
        'label' => 'Carrossel da escola — imagem 4',
        'padrao' => './img/fachada-sesc.png'
    ],
    'imagem_ensino_1' => [
        'label' => 'Card Ensino Médio',
        'padrao' => './img/ensino-medio-integrado-sesc-pr.jpg'
    ],
    'imagem_ensino_2' => [
        'label' => 'Card Formação técnica',
        'padrao' => './img/informaticaaa.png'
    ],
    'imagem_ensino_3' => [
        'label' => 'Card Metodologias ativas',
        'padrao' => './img/ZOOLITO.jpg'
    ],
    'imagem_projetos_1' => [
        'label' => 'Projetos — imagem 1',
        'padrao' => './img/feira-cientifica-sesc-senac.jpg'
    ],
    'imagem_projetos_2' => [
        'label' => 'Projetos — imagem 2',
        'padrao' => './img/sesc-senac-evento-cientifico.jpeg'
    ],
];

$mensagem = '';
$tipoMensagem = 'sucesso';
$conteudos = [];

// Lê os conteúdos salvos.
$resultado = $conexao->query(
    "SELECT chave, valor FROM conteudos_site"
);

if ($resultado) {
    while ($linha = $resultado->fetch_assoc()) {
        $conteudos[$linha['chave']] = $linha['valor'];
    }
}

// Processa o formulário.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';

    if (
        !is_string($token) ||
        !hash_equals($_SESSION['csrf_editor_site'], $token)
    ) {
        $mensagem = 'Sua sessão expirou. Atualize a página e tente novamente.';
        $tipoMensagem = 'erro';
    } else {
        $conexao->begin_transaction();

        try {
            // Salva os textos e suas respectivas cores.
            foreach ($camposTexto as $chave => $campo) {
                if (
                    isset($_POST[$chave]) &&
                    is_string($_POST[$chave])
                ) {
                    $valor = trim($_POST[$chave]);

                    if (mb_strlen($valor, 'UTF-8') > 5000) {
                        throw new RuntimeException(
                            'Um dos textos ultrapassou 5.000 caracteres.'
                        );
                    }

                    $stmt = $conexao->prepare(
                        "INSERT INTO conteudos_site (chave, valor)
                         VALUES (?, ?)
                         ON DUPLICATE KEY UPDATE valor = VALUES(valor)"
                    );

                    $stmt->bind_param('ss', $chave, $valor);

                    if (!$stmt->execute()) {
                        $stmt->close();

                        throw new RuntimeException(
                            'Não foi possível salvar os textos.'
                        );
                    }

                    $stmt->close();
                    $conteudos[$chave] = $valor;
                }

                // A cor é armazenada em uma chave separada.
                $chaveCor = 'cor_' . $chave;
                $cor = $_POST[$chaveCor] ?? null;

                if ($cor !== null) {
                    if (
                        !is_string($cor) ||
                        !preg_match('/^#[0-9a-fA-F]{6}$/', $cor)
                    ) {
                        throw new RuntimeException(
                            'Uma das cores é inválida. Escolha uma cor válida.'
                        );
                    }

                    $cor = strtoupper($cor);

                    $stmt = $conexao->prepare(
                        "INSERT INTO conteudos_site (chave, valor)
                         VALUES (?, ?)
                         ON DUPLICATE KEY UPDATE valor = VALUES(valor)"
                    );

                    $stmt->bind_param('ss', $chaveCor, $cor);

                    if (!$stmt->execute()) {
                        $stmt->close();

                        throw new RuntimeException(
                            'Não foi possível salvar as cores.'
                        );
                    }

                    $stmt->close();
                    $conteudos[$chaveCor] = $cor;
                }
            }

            // Pasta de destino das imagens.
            $pastaImagens = __DIR__ . '/img/uploads-site';

            if (
                !is_dir($pastaImagens) &&
                !mkdir($pastaImagens, 0755, true) &&
                !is_dir($pastaImagens)
            ) {
                throw new RuntimeException(
                    'Não foi possível criar a pasta de imagens.'
                );
            }

            // Bloqueia a execução de scripts na pasta de uploads.
            $arquivoHtaccess = $pastaImagens . '/.htaccess';

            if (!file_exists($arquivoHtaccess)) {
                $regras = "Options -Indexes\n"
                    . "<FilesMatch \"\\.(php[0-9]?|phtml|phar|cgi|pl|py|sh)$\">\n"
                    . "Require all denied\n"
                    . "</FilesMatch>\n";

                if (file_put_contents($arquivoHtaccess, $regras) === false) {
                    throw new RuntimeException(
                        'Não foi possível proteger a pasta de imagens.'
                    );
                }
            }

            // Formatos permitidos.
            $tiposPermitidos = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/webp' => 'webp',
                'image/gif' => 'gif',
            ];

            $finfo = new finfo(FILEINFO_MIME_TYPE);

            foreach ($camposImagem as $chave => $campo) {
                if (
                    !isset($_FILES[$chave]) ||
                    $_FILES[$chave]['error'] === UPLOAD_ERR_NO_FILE
                ) {
                    continue;
                }

                $arquivo = $_FILES[$chave];

                if ($arquivo['error'] !== UPLOAD_ERR_OK) {
                    throw new RuntimeException(
                        'O envio de uma das imagens falhou.'
                    );
                }

                if ($arquivo['size'] > 5 * 1024 * 1024) {
                    throw new RuntimeException(
                        'Cada imagem pode ter no máximo 5 MB.'
                    );
                }

                if (!is_uploaded_file($arquivo['tmp_name'])) {
                    throw new RuntimeException('Arquivo enviado inválido.');
                }

                $mime = $finfo->file($arquivo['tmp_name']);

                if (!isset($tiposPermitidos[$mime])) {
                    throw new RuntimeException(
                        'Formato não permitido. Use JPG, PNG, WebP ou GIF.'
                    );
                }

                $dimensoes = @getimagesize($arquivo['tmp_name']);

                if ($dimensoes === false) {
                    throw new RuntimeException(
                        'Um dos arquivos não é uma imagem válida.'
                    );
                }

                if (
                    $dimensoes[0] > 6000 ||
                    $dimensoes[1] > 6000
                ) {
                    throw new RuntimeException(
                        'As dimensões máximas são 6000 × 6000 pixels.'
                    );
                }

                $extensao = $tiposPermitidos[$mime];
                $nomeArquivo = bin2hex(random_bytes(16)) . '.' . $extensao;
                $destino = $pastaImagens . '/' . $nomeArquivo;
                $caminhoPublico = './img/uploads-site/' . $nomeArquivo;

                if (!move_uploaded_file($arquivo['tmp_name'], $destino)) {
                    throw new RuntimeException(
                        'Não foi possível salvar uma das imagens.'
                    );
                }

                $stmt = $conexao->prepare(
                    "INSERT INTO conteudos_site (chave, valor)
                     VALUES (?, ?)
                     ON DUPLICATE KEY UPDATE valor = VALUES(valor)"
                );

                $stmt->bind_param('ss', $chave, $caminhoPublico);

                if (!$stmt->execute()) {
                    $stmt->close();

                    throw new RuntimeException(
                        'Não foi possível registrar a imagem.'
                    );
                }

                $stmt->close();
                $conteudos[$chave] = $caminhoPublico;
            }

            $conexao->commit();

            $mensagem = 'Alterações e cores salvas com sucesso!';
            $tipoMensagem = 'sucesso';

        } catch (Throwable $erro) {
            $conexao->rollback();

            $mensagem = $erro instanceof RuntimeException
                ? $erro->getMessage()
                : 'Ocorreu um erro ao salvar. Verifique o banco de dados e as permissões das pastas.';

            $tipoMensagem = 'erro';
        }
    }
}

// Retorna conteúdo salvo ou valor padrão.
function valorEditor(
    string $chave,
    array $campos,
    array $conteudos
): string {
    return $conteudos[$chave]
        ?? ($campos[$chave]['padrao'] ?? '');
}

// Cores padrão para cada texto.
function corPadrao(string $chave): string {
    if (str_contains($chave, 'etiqueta')) {
        return '#F58220';
    }

    if (str_contains($chave, 'descricao')) {
        return '#475569';
    }

    return '#003B5C';
}

function h(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar site | Sesc Senac Caiobá</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        azul: '#003B5C',
                        azul2: '#005B82',
                        laranja: '#F58220',
                        fundo: '#F5F7F8'
                    }
                }
            }
        };
    </script>
</head>

<body class="min-h-screen bg-fundo text-slate-800">

<header class="bg-azul text-white">
    <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-5 py-5">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-orange-300">
                Administração
            </p>

            <h1 class="mt-1 text-xl font-black">Editar site</h1>
        </div>

        <div class="flex flex-wrap gap-3">
            <a
                href="moderacao.php"
                class="rounded-xl border border-white/20 px-4 py-3 text-sm font-bold transition hover:bg-white/10"
            >
                <i class="bi bi-chat-square-text mr-2"></i>
                Feedbacks
            </a>

            <a
                href="index.php"
                class="rounded-xl border border-white/20 px-4 py-3 text-sm font-bold transition hover:bg-white/10"
            >
                <i class="bi bi-globe mr-2"></i>
                Ver site
            </a>

            <a
                href="moderacao.php?sair=1"
                class="rounded-xl bg-laranja px-4 py-3 text-sm font-bold transition hover:bg-orange-600"
            >
                Sair
            </a>
        </div>
    </div>
</header>

<main class="mx-auto max-w-5xl px-5 py-10">

    <div class="mb-8">
        <span class="text-sm font-bold uppercase tracking-wider text-laranja">
            Personalização
        </span>

        <h2 class="mt-2 text-3xl font-black text-azul md:text-4xl">
            Conteúdo da página inicial
        </h2>

        <p class="mt-3 max-w-2xl leading-7 text-slate-500">
            Edite os textos, escolha suas cores e envie novas imagens.
            Você pode visualizar a cor antes de salvar.
        </p>
    </div>

    <?php if ($mensagem !== ''): ?>
        <div class="mb-6 rounded-xl border px-5 py-4 text-sm font-semibold
            <?= $tipoMensagem === 'erro'
                ? 'border-red-200 bg-red-50 text-red-700'
                : 'border-green-200 bg-green-50 text-green-700' ?>">
            <?= h($mensagem) ?>
        </div>
    <?php endif; ?>

    <form
        method="POST"
        enctype="multipart/form-data"
        class="space-y-8"
    >
        <input
            type="hidden"
            name="csrf_token"
            value="<?= h($_SESSION['csrf_editor_site']) ?>"
        >

        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm md:p-8">

            <div class="mb-6 flex items-center gap-3">
                <div class="grid h-11 w-11 place-items-center rounded-xl bg-orange-100 text-xl text-laranja">
                    <i class="bi bi-palette"></i>
                </div>

                <div>
                    <h3 class="text-xl font-black text-azul">
                        Textos, títulos e cores
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Escolha uma cor diferente para cada texto.
                    </p>
                </div>
            </div>

            <div class="space-y-6">

                <?php foreach ($camposTexto as $chave => $campo): ?>

                    <?php
                    $valorAtual = valorEditor(
                        $chave,
                        $camposTexto,
                        $conteudos
                    );

                    $chaveCor = 'cor_' . $chave;

                    $corAtual = $conteudos[$chaveCor]
                        ?? corPadrao($chave);

                    if (!preg_match('/^#[0-9a-fA-F]{6}$/', $corAtual)) {
                        $corAtual = corPadrao($chave);
                    }
                    ?>

                    <div class="rounded-xl border border-slate-200 p-4">

                        <label
                            for="<?= h($chave) ?>"
                            class="mb-2 block text-sm font-bold text-azul"
                        >
                            <?= h($campo['label']) ?>
                        </label>

                        <?php if (mb_strlen($campo['padrao'], 'UTF-8') > 180): ?>

                            <textarea
                                id="<?= h($chave) ?>"
                                name="<?= h($chave) ?>"
                                rows="4"
                                maxlength="5000"
                                class="w-full rounded-xl border border-slate-200 px-4 py-3 leading-6 outline-none transition focus:border-laranja focus:ring-4 focus:ring-orange-100"
                            ><?= h($valorAtual) ?></textarea>

                        <?php else: ?>

                            <input
                                id="<?= h($chave) ?>"
                                name="<?= h($chave) ?>"
                                type="text"
                                maxlength="5000"
                                value="<?= h($valorAtual) ?>"
                                class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-laranja focus:ring-4 focus:ring-orange-100"
                            >

                        <?php endif; ?>

                        <div class="mt-4 rounded-xl bg-slate-50 p-4">

                            <label class="mb-3 block text-sm font-bold text-slate-700">
                                <i class="bi bi-palette-fill mr-1"></i>
                                Cor deste texto
                            </label>

                            <div class="flex flex-wrap items-center gap-4">

                                <input
                                    type="color"
                                    id="seletor_<?= h($chave) ?>"
                                    value="<?= h($corAtual) ?>"
                                    aria-label="Escolher cor para <?= h($campo['label']) ?>"
                                    class="h-12 w-16 cursor-pointer rounded-lg border border-slate-200 bg-white p-1"
                                >

                                <div class="min-w-0 flex-1">
                                    <label
                                        for="<?= h($chaveCor) ?>"
                                        class="mb-1 block text-xs font-semibold text-slate-500"
                                    >
                                        Código da cor
                                    </label>

                                    <input
                                        type="text"
                                        id="<?= h($chaveCor) ?>"
                                        name="<?= h($chaveCor) ?>"
                                        value="<?= h(strtoupper($corAtual)) ?>"
                                        pattern="^#[0-9a-fA-F]{6}$"
                                        maxlength="7"
                                        required
                                        class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 font-mono text-sm uppercase outline-none focus:border-laranja focus:ring-4 focus:ring-orange-100"
                                    >
                                </div>

                            </div>

                            <div class="mt-4 rounded-lg border border-slate-200 bg-white p-4">
                                <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Prévia
                                </p>

                                <p
                                    id="previa_<?= h($chave) ?>"
                                    style="color: <?= h($corAtual) ?>"
                                    class="break-words text-lg font-bold"
                                ><?= h($valorAtual) ?></p>
                            </div>

                            <div class="mt-3 flex flex-wrap gap-2">
                                <span class="w-full text-xs text-slate-500">
                                    Cores rápidas:
                                </span>

                                <?php
                                $coresRapidas = [
                                    '#003B5C',
                                    '#005B82',
                                    '#F58220',
                                    '#000000',
                                    '#475569',
                                    '#FFFFFF',
                                    '#FF0000',
                                    '#008000',
                                ];
                                ?>

                                <?php foreach ($coresRapidas as $corRapida): ?>
                                    <button
                                        type="button"
                                        class="h-8 w-8 rounded-full border border-slate-300 transition hover:scale-110"
                                        style="background-color: <?= h($corRapida) ?>"
                                        data-cor-alvo="<?= h($chave) ?>"
                                        data-cor="<?= h($corRapida) ?>"
                                        aria-label="Selecionar cor <?= h($corRapida) ?>"
                                        title="<?= h($corRapida) ?>"
                                    ></button>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
        </section>

        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm md:p-8">

            <div class="mb-6 flex items-center gap-3">
                <div class="grid h-11 w-11 place-items-center rounded-xl bg-orange-100 text-xl text-laranja">
                    <i class="bi bi-images"></i>
                </div>

                <div>
                    <h3 class="text-xl font-black text-azul">
                        Imagens do site
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        JPG, PNG, WebP ou GIF. Máximo de 5 MB por imagem.
                    </p>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">

                <?php foreach ($camposImagem as $chave => $campo): ?>

                    <?php
                    $imagemAtual = valorEditor(
                        $chave,
                        $camposImagem,
                        $conteudos
                    );
                    ?>

                    <div class="rounded-xl border border-slate-200 p-4">

                        <label
                            for="<?= h($chave) ?>"
                            class="mb-3 block text-sm font-bold text-azul"
                        >
                            <?= h($campo['label']) ?>
                        </label>

                        <img
                            src="<?= h($imagemAtual) ?>"
                            alt="Imagem atual: <?= h($campo['label']) ?>"
                            class="mb-4 h-44 w-full rounded-lg bg-slate-100 object-contain"
                            onerror="this.style.display='none'"
                        >

                        <p class="mb-3 break-all text-xs text-slate-400">
                            Atual: <?= h($imagemAtual) ?>
                        </p>

                        <input
                            id="<?= h($chave) ?>"
                            name="<?= h($chave) ?>"
                            type="file"
                            accept=".jpg,.jpeg,.png,.webp,.gif,image/jpeg,image/png,image/webp,image/gif"
                            class="block w-full text-sm text-slate-600 file:mr-3 file:rounded-lg file:border-0 file:bg-azul file:px-4 file:py-2 file:font-bold file:text-white hover:file:bg-azul2"
                        >

                        <p class="mt-2 text-xs text-slate-400">
                            Se não selecionar um arquivo, a imagem atual será mantida.
                        </p>

                    </div>

                <?php endforeach; ?>

            </div>
        </section>

        <div class="sticky bottom-4 flex flex-wrap items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white/95 p-4 shadow-lg backdrop-blur">

            <p class="text-sm text-slate-500">
                <i class="bi bi-shield-check mr-1 text-azul"></i>
                Somente administradores podem salvar alterações.
            </p>

            <button
                type="submit"
                class="rounded-xl bg-laranja px-7 py-3.5 font-bold text-white transition hover:bg-orange-600"
            >
                <i class="bi bi-floppy mr-2"></i>
                Salvar alterações
            </button>

        </div>
    </form>
</main>

<script>
// Sincroniza o seletor de cor, o código hexadecimal e a prévia.
document.querySelectorAll('input[type="color"]').forEach(function(seletor) {
    const chave = seletor.id.replace('seletor_', '');
    const campoHex = document.getElementById('cor_' + chave);
    const previa = document.getElementById('previa_' + chave);

    function atualizarPrevia(cor) {
        if (!/^#[0-9a-fA-F]{6}$/.test(cor)) {
            return;
        }

        seletor.value = cor;
        campoHex.value = cor.toUpperCase();
        previa.style.color = cor;
    }

    seletor.addEventListener('input', function() {
        atualizarPrevia(seletor.value);
    });

    campoHex.addEventListener('input', function() {
        const cor = campoHex.value.trim();

        if (/^#[0-9a-fA-F]{6}$/.test(cor)) {
            atualizarPrevia(cor);
        }
    });

    campoHex.addEventListener('change', function() {
        const cor = campoHex.value.trim();

        if (!/^#[0-9a-fA-F]{6}$/.test(cor)) {
            campoHex.setCustomValidity(
                'Informe uma cor hexadecimal válida, como #003B5C.'
            );
            campoHex.reportValidity();
        } else {
            campoHex.setCustomValidity('');
            atualizarPrevia(cor);
        }
    });
});

// Atalhos de cores rápidas.
document.querySelectorAll('[data-cor-alvo]').forEach(function(botao) {
    botao.addEventListener('click', function() {
        const chave = botao.dataset.corAlvo;
        const cor = botao.dataset.cor;
        const seletor = document.getElementById('seletor_' + chave);

        if (seletor) {
            seletor.value = cor;
            seletor.dispatchEvent(new Event('input'));
        }
    });
});
</script>

</body>
</html>

<?php
$conexao->close();
?>
