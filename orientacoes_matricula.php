<?php

session_start();

if (!isset($_SESSION['aluno_id'])) {
    header('Location: login_aluno.php');
    exit;
}

$nome = $_SESSION['aluno_nome'] ?? 'Estudante';
$primeiroNome = explode(' ', trim($nome))[0];

$cadastroSucesso = (
    isset($_GET['cadastro']) &&
    $_GET['cadastro'] === 'sucesso'
);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Orientações de Matrícula | Sesc Senac</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap Icons -->
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
                        azulEscuro: '#002B43',
                        laranja: '#FF8A32',
                        fundo: '#F3F6F8'
                    }
                }
            }
        };
    </script>
</head>

<body class="min-h-screen bg-fundo text-slate-800">

    <!-- Cabeçalho -->
    <header class="bg-azul text-white shadow-md">

        <div class="mx-auto flex max-w-7xl items-center justify-between
                    gap-4 px-5 py-5 sm:px-8">

            <a href="index.php" class="flex items-center gap-3">

                <div class="grid h-11 w-11 place-items-center
                            rounded-xl bg-white text-azul">
                    <i class="bi bi-mortarboard-fill text-2xl"></i>
                </div>

                <div>
                    <span class="block text-sm font-black">
                        ENSINO MÉDIO
                    </span>

                    <span class="block text-xs font-bold text-orange-300">
                        INTEGRADO AO TÉCNICO
                    </span>
                </div>

            </a>

            <a href="sair_aluno.php"
               class="flex items-center gap-2 rounded-lg border
                      border-white/30 px-4 py-2 text-sm font-semibold
                      transition hover:bg-white/10">

                <i class="bi bi-box-arrow-right"></i>

                <span class="hidden sm:inline">Sair da conta</span>
                <span class="sm:hidden">Sair</span>

            </a>

        </div>

    </header>

    <main class="mx-auto max-w-7xl px-5 py-10 sm:px-8 sm:py-14">

        <!-- Boas-vindas -->
        <section class="relative overflow-hidden rounded-2xl
                        bg-azul px-6 py-9 text-white
                        shadow-sm sm:px-10 sm:py-12">

            <div class="absolute -right-12 -top-16 h-64 w-64
                        rounded-full border-[32px] border-white/5">
            </div>

            <div class="relative max-w-3xl">

                <?php if ($cadastroSucesso): ?>

                    <div class="mb-5 inline-flex items-center gap-2
                                rounded-lg bg-green-500/15 px-4 py-2
                                text-sm font-semibold text-green-100">

                        <i class="bi bi-check-circle-fill"></i>
                        Conta criada com sucesso!

                    </div>

                <?php endif; ?>

                <p class="text-sm font-bold uppercase tracking-widest
                          text-orange-200">
                    Área do aluno
                </p>

                <h1 class="mt-3 text-3xl font-black leading-tight
                           sm:text-4xl lg:text-5xl">

                    Olá, <?= htmlspecialchars($primeiroNome, ENT_QUOTES, 'UTF-8') ?>!

                </h1>

                <p class="mt-4 max-w-2xl leading-7 text-blue-100 sm:text-lg">
                    Seja bem-vindo à área de orientações do Ensino Médio
                    Integrado ao Técnico. Aqui você encontra informações
                    para começar a se preparar para o processo de matrícula.
                </p>

            </div>

        </section>

        <!-- Introdução -->
        <section class="mt-10">

            <div class="mb-6">

                <p class="text-sm font-bold uppercase tracking-widest text-laranja">
                    Vamos começar?
                </p>

                <h2 class="mt-2 text-2xl font-black text-azul sm:text-3xl">
                    Orientações para matrícula
                </h2>

                <p class="mt-3 max-w-3xl leading-7 text-slate-600">
                    Confira algumas etapas importantes para acompanhar
                    o processo de ingresso na instituição.
                </p>

            </div>

            <!-- Cards de orientação -->
            <div class="grid gap-5 md:grid-cols-3">

                <!-- Etapa 1 -->
                <article class="rounded-2xl border border-slate-200
                                bg-white p-6 shadow-sm transition
                                hover:-translate-y-1 hover:shadow-md">

                    <div class="grid h-12 w-12 place-items-center
                                rounded-xl bg-blue-50 text-azul">

                        <i class="bi bi-info-circle text-2xl"></i>

                    </div>

                    <h3 class="mt-5 text-lg font-black text-azul">
                        1. Consulte as informações
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-600">
                        Confira os comunicados e as orientações divulgadas
                        pelos canais oficiais do Sesc Senac sobre o ingresso
                        no Ensino Médio Integrado ao Técnico.
                    </p>

                </article>

                <!-- Etapa 2 -->
                <article class="rounded-2xl border border-slate-200
                                bg-white p-6 shadow-sm transition
                                hover:-translate-y-1 hover:shadow-md">

                    <div class="grid h-12 w-12 place-items-center
                                rounded-xl bg-orange-50 text-orange-600">

                        <i class="bi bi-calendar-check text-2xl"></i>

                    </div>

                    <h3 class="mt-5 text-lg font-black text-azul">
                        2. Verifique os prazos
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-600">
                        Acompanhe os períodos de inscrição e matrícula
                        divulgados pela instituição. Confira as datas
                        atualizadas antes de realizar qualquer procedimento.
                    </p>

                </article>

                <!-- Etapa 3 -->
                <article class="rounded-2xl border border-slate-200
                                bg-white p-6 shadow-sm transition
                                hover:-translate-y-1 hover:shadow-md">

                    <div class="grid h-12 w-12 place-items-center
                                rounded-xl bg-green-50 text-green-700">

                        <i class="bi bi-folder2-open text-2xl"></i>

                    </div>

                    <h3 class="mt-5 text-lg font-black text-azul">
                        3. Prepare os documentos
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-600">
                        Consulte a lista oficial de documentos exigidos
                        para o seu processo e organize-os com antecedência.
                        Os requisitos podem variar conforme o edital.
                    </p>

                </article>

            </div>

        </section>

        <!-- Aviso importante -->
        <section class="mt-8 rounded-2xl border border-orange-200
                        bg-orange-50 p-6 sm:p-8">

            <div class="flex items-start gap-4">

                <div class="mt-1 text-2xl text-orange-600">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>

                <div>

                    <h2 class="text-lg font-black text-azul">
                        Fique atento!
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-slate-700">
                        Esta página apresenta orientações gerais e não
                        confirma uma inscrição ou matrícula. Para consultar
                        datas, documentos obrigatórios, vagas e procedimentos,
                        utilize os comunicados e canais oficiais da instituição.
                    </p>

                </div>

            </div>

        </section>

        <!-- Atalhos -->
        <section class="mt-10">

            <h2 class="text-xl font-black text-azul">
                O que você deseja fazer?
            </h2>

            <div class="mt-5 grid gap-4 sm:grid-cols-2">

                <a href="index.php"
                   class="flex items-center justify-between gap-4
                          rounded-xl border border-slate-200 bg-white
                          p-5 transition hover:border-azul hover:shadow-sm">

                    <div class="flex items-center gap-4">

                        <div class="grid h-11 w-11 place-items-center
                                    rounded-lg bg-blue-50 text-azul">

                            <i class="bi bi-house-door text-xl"></i>

                        </div>

                        <div>
                            <h3 class="font-bold text-azul">
                                Conhecer a escola
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Voltar ao site principal
                            </p>
                        </div>

                    </div>

                    <i class="bi bi-arrow-up-right text-lg text-slate-400"></i>

                </a>

                <a href="sair_aluno.php"
                   class="flex items-center justify-between gap-4
                          rounded-xl border border-slate-200 bg-white
                          p-5 transition hover:border-azul hover:shadow-sm">

                    <div class="flex items-center gap-4">

                        <div class="grid h-11 w-11 place-items-center
                                    rounded-lg bg-orange-50 text-orange-600">

                            <i class="bi bi-box-arrow-right text-xl"></i>

                        </div>

                        <div>
                            <h3 class="font-bold text-azul">
                                Encerrar sessão
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Sair da sua conta com segurança
                            </p>
                        </div>

                    </div>

                    <i class="bi bi-arrow-up-right text-lg text-slate-400"></i>

                </a>

            </div>

        </section>

        <!-- Rodapé -->
        <footer class="mt-12 border-t border-slate-200 pt-6 text-center">

            <p class="text-sm text-slate-500">
                Ensino Médio Integrado ao Técnico
            </p>

            <p class="mt-1 text-xs text-slate-400">
                Sesc Senac Caiobá · Matinhos/PR
            </p>

        </footer>

    </main>

</body>
</html>
```
