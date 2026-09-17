<?php

session_start();


// verifica se o administrador está logado
if (
    !isset($_SESSION['admin']) ||
    $_SESSION['admin'] !== true
) {

    header('Location: login.php');
    exit;

}


// conexão com o banco
require_once __DIR__ . '/conexao.php';


// logout
if (isset($_GET['sair'])) {

    session_unset();
    session_destroy();

    header('Location: login.php');
    exit;

}


// filtro atual
$filtro = $_POST['filtro'] ?? $_GET['filtro'] ?? 'pendente';

$filtrosPermitidos = [
    'pendente',
    'aprovado',
    'recusado'
];

if (!in_array($filtro, $filtrosPermitidos, true)) {
    $filtro = 'pendente';
}


// aprovar, recusar ou remover feedback
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = intval($_POST['id'] ?? 0);
    $acao = $_POST['acao'] ?? '';


    if ($id > 0) {


        // aprovar
        if ($acao === 'aprovar') {

            $stmt = $conexao->prepare(
                "UPDATE feedbacks
                 SET status = 'aprovado'
                 WHERE id = ?"
            );

            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();

            header(
                'Location: moderacao.php?filtro=pendente&msg=aprovado'
            );

            exit;

        }


        // recusar
        if ($acao === 'recusar') {

            $stmt = $conexao->prepare(
                "UPDATE feedbacks
                 SET status = 'recusado'
                 WHERE id = ?"
            );

            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();

            header(
                'Location: moderacao.php?filtro=pendente&msg=recusado'
            );

            exit;

        }


        // remover feedback aprovado definitivamente
        if ($acao === 'remover') {

            $stmt = $conexao->prepare(
                "DELETE FROM feedbacks
                 WHERE id = ? AND status = 'aprovado'"
            );

            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();

            header(
                'Location: moderacao.php?filtro=aprovado&msg=removido'
            );

            exit;

        }

    }

}



// contagem dos feedbacks
$quantidades = [
    'pendente' => 0,
    'aprovado' => 0,
    'recusado' => 0
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

            $quantidades[$item['status']] = $item['total'];

        }

    }

}


// busca os feedbacks do filtro selecionado
$stmt = $conexao->prepare(
    "SELECT
        id,
        titulo,
        categoria,
        texto,
        data_criacao,
        status
     FROM feedbacks
     WHERE status = ?
     AND arquivado = 0
     ORDER BY data_criacao DESC"
);

$stmt->bind_param('s', $filtro);
$stmt->execute();

$resultadoFeedbacks = $stmt->get_result();

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Moderação de Feedbacks | Sesc Senac Caiobá
    </title>


    <script src="https://cdn.tailwindcss.com"></script>


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

        }

    </script>

</head>


<body
    class="min-h-screen bg-fundo text-slate-800"
>


<!-- header -->

<header
    class="bg-azul text-white"
>

    <div
        class="mx-auto flex max-w-7xl items-center justify-between gap-5 px-5 py-5"
    >


        <div>

            <p
                class="text-xs font-bold uppercase tracking-[0.2em] text-orange-300"
            >
                Administração
            </p>


            <h1
                class="mt-1 text-xl font-black"
            >
                Painel Administrativo
            </h1>

        </div>



        <div
            class="flex items-center gap-3"
        >


            <!-- voltar ao site -->

            <a
                href="index.php"
                class="rounded-xl border border-white/20 px-5 py-2.5 text-sm font-bold transition hover:bg-white/10"
            >
                Voltar ao site
            </a>



            <!-- sair -->

            <a
                href="moderacao.php?sair=1"
                class="rounded-xl bg-laranja px-5 py-2.5 text-sm font-bold text-white transition hover:bg-laranjaEscuro"
            >
                Sair
            </a>


        </div>

    </div>

</header>



<!-- conteúdo -->

<main
    class="mx-auto max-w-7xl px-5 py-12"
>


    <!-- título -->

    <div
        class="mb-10"
    >


        <span
            class="text-sm font-bold uppercase tracking-wider text-laranja"
        >
            Feedbacks dos estudantes
        </span>


        <h2
            class="mt-3 text-4xl font-black text-azul md:text-5xl"
        >
            Moderação de feedbacks
        </h2>


        <p
            class="mt-4 max-w-2xl leading-7 text-slate-500"
        >
            Analise os feedbacks enviados pelos estudantes
            antes de permitir que sejam publicados no mural.
        </p>


    </div>



    <!-- mensagem aprovado -->

    <?php if (
        isset($_GET['msg']) &&
        $_GET['msg'] === 'aprovado'
    ): ?>

        <div
            class="mb-8 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-bold text-green-700"
        >
            ✓ Feedback aprovado com sucesso.
        </div>

    <?php endif; ?>



    <!-- mensagem recusado -->

    <?php if (
        isset($_GET['msg']) &&
        $_GET['msg'] === 'recusado'
    ): ?>

        <div
            class="mb-8 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-bold text-red-700"
        >
            ✕ Feedback recusado.
        </div>

    <?php endif; ?>



    <!-- mensagem removido -->

    <?php if (
        isset($_GET['msg']) &&
        $_GET['msg'] === 'removido'
    ): ?>

        <div
            class="mb-8 rounded-xl border border-blue-200 bg-blue-50 px-5 py-4 text-sm font-bold text-blue-700"
        >
            ✓ Feedback apagado definitivamente do sistema.
        </div>

    <?php endif; ?>


    <!-- filtros -->

    <div
        class="mb-8 flex flex-wrap gap-3 border-b border-slate-200 pb-6"
    >


        <!-- pendentes -->

        <a
            href="moderacao.php?filtro=pendente"
            class="rounded-xl px-5 py-3 text-sm font-bold transition
            <?= $filtro === 'pendente'
                ? 'bg-azul text-white'
                : 'bg-white text-slate-600 hover:bg-slate-100' ?>"
        >

            Pendentes

            <span>
                (<?= $quantidades['pendente'] ?>)
            </span>

        </a>



        <!-- aprovados -->

        <a
            href="moderacao.php?filtro=aprovado"
            class="rounded-xl px-5 py-3 text-sm font-bold transition
            <?= $filtro === 'aprovado'
                ? 'bg-azul text-white'
                : 'bg-white text-slate-600 hover:bg-slate-100' ?>"
        >

            Aprovados

            <span>
                (<?= $quantidades['aprovado'] ?>)
            </span>

        </a>



        <!-- recusados -->

        <a
            href="moderacao.php?filtro=recusado"
            class="rounded-xl px-5 py-3 text-sm font-bold transition
            <?= $filtro === 'recusado'
                ? 'bg-azul text-white'
                : 'bg-white text-slate-600 hover:bg-slate-100' ?>"
        >

            Recusados

            <span>
                (<?= $quantidades['recusado'] ?>)
            </span>

        </a>


    </div>



    <!-- lista -->

    <?php if (
        $resultadoFeedbacks &&
        $resultadoFeedbacks->num_rows > 0
    ): ?>


        <div
            class="space-y-5"
        >


            <?php while (
                $feedback = $resultadoFeedbacks->fetch_assoc()
            ): ?>


                <article
                    class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm transition hover:shadow-md"
                >


                    <!-- topo -->

                    <div
                        class="flex flex-col justify-between gap-4 sm:flex-row sm:items-start"
                    >


                        <div>


                            <!-- categoria -->

                            <span
                                class="inline-block rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-laranjaEscuro"
                            >

                                <?= htmlspecialchars(
                                    $feedback['categoria']
                                ) ?>

                            </span>


                            <!-- título -->

                            <h3
                                class="mt-4 text-xl font-black text-azul"
                            >

                                <?= htmlspecialchars(
                                    $feedback['titulo']
                                ) ?>

                            </h3>


                        </div>



                        <!-- status pendente -->

                        <?php if (
                            $feedback['status'] === 'pendente'
                        ): ?>

                            <span
                                class="w-fit rounded-full bg-yellow-100 px-3 py-1 text-xs font-bold text-yellow-700"
                            >
                                Pendente
                            </span>


                        <!-- status aprovado -->

                        <?php elseif (
                            $feedback['status'] === 'aprovado'
                        ): ?>

                            <span
                                class="w-fit rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700"
                            >
                                Aprovado
                            </span>


                        <!-- status recusado -->

                        <?php else: ?>

                            <span
                                class="w-fit rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700"
                            >
                                Recusado
                            </span>

                        <?php endif; ?>


                    </div>



                    <!-- texto -->

                    <p
                        class="mt-5 whitespace-pre-line leading-7 text-slate-600"
                    >

                        <?= htmlspecialchars(
                            $feedback['texto']
                        ) ?>

                    </p>



                    <!-- parte inferior -->

                    <div
                        class="mt-6 flex flex-wrap items-center justify-between gap-4 border-t border-slate-100 pt-5"
                    >


                        <!-- data -->

                        <span
                            class="text-xs text-slate-400"
                        >

                            Anônimo •

                            <?= date(
                                'd/m/Y H:i',
                                strtotime(
                                    $feedback['data_criacao']
                                )
                            ) ?>

                        </span>



                        <!-- ações -->

                        <?php if (
                            $feedback['status'] === 'pendente'
                        ): ?>


                            <div
                                class="flex flex-wrap gap-3"
                            >


                                <!-- aprovar -->

                                <form
                                    method="POST"
                                    action="moderacao.php"
                                >


                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= $feedback['id'] ?>"
                                    >


                                    <input
                                        type="hidden"
                                        name="acao"
                                        value="aprovar"
                                    >

                                    <input
                                        type="hidden"
                                        name="filtro"
                                        value="<?= htmlspecialchars($filtro) ?>"
                                    >


                                    <button
                                        type="submit"
                                        class="rounded-xl bg-azul px-5 py-3 text-sm font-bold text-white transition hover:bg-azul2"
                                    >
                                        ✓ Aprovar
                                    </button>


                                </form>



                                <!-- recusar -->

                                <form
                                    method="POST"
                                    action="moderacao.php"
                                >


                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= $feedback['id'] ?>"
                                    >


                                    <input
                                        type="hidden"
                                        name="acao"
                                        value="recusar"
                                    >

                                    <input
                                        type="hidden"
                                        name="filtro"
                                        value="<?= htmlspecialchars($filtro) ?>"
                                    >


                                    <button
                                        type="submit"
                                        class="rounded-xl bg-red-50 px-5 py-3 text-sm font-bold text-red-600 transition hover:bg-red-100"
                                    >
                                        ✕ Recusar
                                    </button>


                                </form>


                            </div>


                        <?php elseif (
                            $feedback['status'] === 'aprovado'
                        ): ?>

                            <form
                                method="POST"
                                action="moderacao.php"
                                onsubmit="return confirm('Atenção! Este feedback será apagado definitivamente do sistema. Essa ação não pode ser desfeita. Deseja continuar?');"
                            >

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= $feedback['id'] ?>"
                                >

                                <input
                                    type="hidden"
                                    name="acao"
                                    value="remover"
                                >

                                <button
                                    type="submit"
                                    class="rounded-xl bg-red-50 px-5 py-3 text-sm font-bold text-red-600 transition hover:bg-red-100"
                                >
                                    🗑️ Remover do mural
                                </button>

                            </form>

                        <?php endif; ?>


                    </div>


                </article>


            <?php endwhile; ?>


        </div>


    <?php else: ?>


        <!-- nenhum feedback -->

        <div
            class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center"
        >


            <div
                class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-slate-100 text-2xl text-azul"
            >
                ✓
            </div>


            <h3
                class="mt-5 text-xl font-black text-azul"
            >
                Nenhum feedback encontrado
            </h3>


            <p
                class="mt-2 text-sm text-slate-500"
            >


                <?php if (
                    $filtro === 'pendente'
                ): ?>

                    Não existem feedbacks aguardando moderação.


                <?php elseif (
                    $filtro === 'aprovado'
                ): ?>

                    Nenhum feedback foi aprovado ainda.


                <?php else: ?>

                    Nenhum feedback foi recusado ainda.

                <?php endif; ?>


            </p>


        </div>


    <?php endif; ?>


</main>


</body>

</html>

<?php
$stmt->close();
$conexao->close();
?>