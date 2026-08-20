<?php

$resultado = null;
$acertos = 0;
$total = 20;
$porcentagem = 0;
$aprovado = false;

$gabarito = [
    1 => "B",
    2 => "C",
    3 => "A",
    4 => "D",
    5 => "B",
    6 => "C",
    7 => "A",
    8 => "D",
    9 => "B",
    10 => "C",
    11 => "A",
    12 => "B",
    13 => "D",
    14 => "C",
    15 => "A",
    16 => "B",
    17 => "C",
    18 => "D",
    19 => "A",
    20 => "B"
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = htmlspecialchars($_POST["nome"] ?? "");
    $cpf = htmlspecialchars($_POST["cpf"] ?? "");
    $telefone = htmlspecialchars($_POST["telefone"] ?? "");
    $email = htmlspecialchars($_POST["email"] ?? "");

    for ($i = 1; $i <= $total; $i++) {

        $resposta = $_POST["questao" . $i] ?? "";

        if ($resposta === $gabarito[$i]) {
            $acertos++;
        }
    }

    $porcentagem = ($acertos / $total) * 100;

    if ($porcentagem >= 60) {
        $aprovado = true;
    }

    $resultado = true;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Avaliação de Ingresso | EscolaTech</title>

    <!-- Tailwind -->
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

<body class="bg-fundo text-slate-800">

<!-- ========================================================= -->
<!-- HEADER -->
<!-- ========================================================= -->

<header class="sticky top-0 z-50 border-b border-white/10 bg-azul text-white">

    <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4">

        <!-- LOGO -->

        <a href="index.php" class="flex items-center gap-3">

            <span class="grid h-10 w-10 place-items-center rounded-lg bg-laranja text-lg font-black">
                E
            </span>

            <div>

                <span class="block font-bold leading-none">
                    EscolaTech
                </span>

                <span class="text-xs text-blue-200">
                    Ensino Médio
                </span>

            </div>

        </a>

        <!-- VOLTAR -->

        <a href="index.php"
           class="rounded-lg border border-white/20 px-5 py-2.5 text-sm font-bold transition hover:bg-white/10">

            Voltar para o início

        </a>

    </div>

</header>


<!-- ========================================================= -->
<!-- TOPO DA AVALIAÇÃO -->
<!-- ========================================================= -->

<section class="bg-azul px-5 py-16 text-white">

    <div class="mx-auto max-w-5xl text-center">

        <span class="inline-block rounded-full bg-white/10 px-4 py-2 text-sm font-semibold text-orange-200">
            Processo de ingresso
        </span>

        <h1 class="mt-5 text-4xl font-black md:text-5xl">
            Avaliação de Ingresso
        </h1>

        <p class="mx-auto mt-5 max-w-2xl leading-8 text-blue-100">

            Responda às questões abaixo para participar do processo
            de ingresso da EscolaTech.

        </p>

    </div>

</section>


<!-- ========================================================= -->
<!-- RESULTADO -->
<!-- ========================================================= -->

<?php if ($resultado): ?>

<section class="px-5 py-16">

    <div class="mx-auto max-w-3xl">

        <?php if ($aprovado): ?>

            <div class="overflow-hidden rounded-3xl bg-white shadow-xl">

                <div class="bg-green-600 px-8 py-10 text-center text-white">

                    <div class="mx-auto grid h-20 w-20 place-items-center rounded-full bg-white text-4xl text-green-600">
                        ✓
                    </div>

                    <h2 class="mt-5 text-3xl font-black">
                        Parabéns!
                    </h2>

                    <p class="mt-2 text-green-100">
                        Você foi aprovado na avaliação.
                    </p>

                </div>

                <div class="p-8 text-center">

                    <p class="text-lg text-slate-600">
                        Resultado de
                        <strong class="text-azul">
                            <?= $nome ?>
                        </strong>
                    </p>

                    <div class="mt-8 grid gap-4 md:grid-cols-3">

                        <div class="rounded-2xl bg-fundo p-6">

                            <strong class="block text-4xl font-black text-azul">
                                <?= $acertos ?>
                            </strong>

                            <span class="text-sm text-slate-500">
                                Acertos
                            </span>

                        </div>

                        <div class="rounded-2xl bg-fundo p-6">

                            <strong class="block text-4xl font-black text-azul">
                                <?= $total ?>
                            </strong>

                            <span class="text-sm text-slate-500">
                                Questões
                            </span>

                        </div>

                        <div class="rounded-2xl bg-fundo p-6">

                            <strong class="block text-4xl font-black text-laranja">
                                <?= number_format($porcentagem, 0) ?>%
                            </strong>

                            <span class="text-sm text-slate-500">
                                Aproveitamento
                            </span>

                        </div>

                    </div>

                    <div class="mt-8 rounded-2xl bg-green-50 p-6 text-left">

                        <h3 class="font-black text-green-800">
                            Próximos passos
                        </h3>

                        <p class="mt-2 leading-7 text-green-700">

                            Seu resultado foi positivo. Em um sistema real,
                            a escola poderia entrar em contato pelo telefone
                            ou e-mail informado no cadastro para apresentar
                            as próximas etapas do processo.

                        </p>

                    </div>

                    <a href="prova.php"
                       class="mt-8 inline-block rounded-xl bg-azul px-7 py-4 font-bold text-white transition hover:bg-azul2">

                        Refazer avaliação

                    </a>

                </div>

            </div>

        <?php else: ?>

            <div class="overflow-hidden rounded-3xl bg-white shadow-xl">

                <div class="bg-red-600 px-8 py-10 text-center text-white">

                    <div class="mx-auto grid h-20 w-20 place-items-center rounded-full bg-white text-4xl text-red-600">
                        !
                    </div>

                    <h2 class="mt-5 text-3xl font-black">
                        Avaliação concluída
                    </h2>

                    <p class="mt-2 text-red-100">
                        Você ainda não atingiu a pontuação mínima.
                    </p>

                </div>

                <div class="p-8 text-center">

                    <p class="text-lg text-slate-600">

                        Resultado de
                        <strong class="text-azul">
                            <?= $nome ?>
                        </strong>

                    </p>

                    <div class="mt-8 grid gap-4 md:grid-cols-3">

                        <div class="rounded-2xl bg-fundo p-6">

                            <strong class="block text-4xl font-black text-azul">
                                <?= $acertos ?>
                            </strong>

                            <span class="text-sm text-slate-500">
                                Acertos
                            </span>

                        </div>

                        <div class="rounded-2xl bg-fundo p-6">

                            <strong class="block text-4xl font-black text-azul">
                                <?= $total ?>
                            </strong>

                            <span class="text-sm text-slate-500">
                                Questões
                            </span>

                        </div>

                        <div class="rounded-2xl bg-fundo p-6">

                            <strong class="block text-4xl font-black text-laranja">
                                <?= number_format($porcentagem, 0) ?>%
                            </strong>

                            <span class="text-sm text-slate-500">
                                Aproveitamento
                            </span>

                        </div>

                    </div>

                    <div class="mt-8 rounded-2xl bg-orange-50 p-6 text-left">

                        <h3 class="font-black text-orange-800">
                            Não desista!
                        </h3>

                        <p class="mt-2 leading-7 text-orange-700">

                            Você pode revisar seus conhecimentos e tentar
                            novamente. Para este projeto, a pontuação mínima
                            definida é de 60%.

                        </p>

                    </div>

                    <a href="prova.php"
                       class="mt-8 inline-block rounded-xl bg-laranja px-7 py-4 font-bold text-white transition hover:bg-laranjaEscuro">

                        Tentar novamente

                    </a>

                </div>

            </div>

        <?php endif; ?>

    </div>

</section>

<?php else: ?>


<!-- ========================================================= -->
<!-- FORMULÁRIO -->
<!-- ========================================================= -->

<main class="px-5 py-16">

    <div class="mx-auto max-w-5xl">

        <!-- DADOS -->

        <div class="rounded-3xl bg-white p-8 shadow-sm">

            <div>

                <span class="text-sm font-bold uppercase tracking-wider text-laranja">
                    Dados do candidato
                </span>

                <h2 class="mt-2 text-3xl font-black text-azul">
                    Antes de começar
                </h2>

                <p class="mt-3 text-slate-500">
                    Preencha seus dados para iniciar a avaliação.
                </p>

            </div>


            <div class="mt-8 grid gap-6 md:grid-cols-2">

                <!-- NOME -->

                <div class="md:col-span-2">

                    <label class="mb-2 block text-sm font-bold text-azul">
                        Nome completo
                    </label>

                    <input
                        type="text"
                        name="nome"
                        id="nome"
                        form="avaliacao"
                        required
                        placeholder="Digite seu nome completo"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-laranja focus:ring-2 focus:ring-orange-100">

                </div>


                <!-- CPF -->

                <div>

                    <label class="mb-2 block text-sm font-bold text-azul">
                        CPF
                    </label>

                    <input
                        type="text"
                        name="cpf"
                        id="cpf"
                        form="avaliacao"
                        required
                        maxlength="14"
                        placeholder="000.000.000-00"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-laranja focus:ring-2 focus:ring-orange-100">

                </div>


                <!-- TELEFONE -->

                <div>

                    <label class="mb-2 block text-sm font-bold text-azul">
                        Telefone
                    </label>

                    <input
                        type="tel"
                        name="telefone"
                        id="telefone"
                        form="avaliacao"
                        required
                        maxlength="15"
                        placeholder="(00) 00000-0000"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-laranja focus:ring-2 focus:ring-orange-100">

                </div>


                <!-- EMAIL -->

                <div class="md:col-span-2">

                    <label class="mb-2 block text-sm font-bold text-azul">
                        E-mail
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        form="avaliacao"
                        required
                        placeholder="seuemail@email.com"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-laranja focus:ring-2 focus:ring-orange-100">

                </div>

            </div>

        </div>


        <!-- ================================================= -->
        <!-- AVALIAÇÃO -->
        <!-- ================================================= -->

        <form id="avaliacao" method="POST" class="mt-8">

            <!-- ================================================= -->
            <!-- QUESTÃO 1 -->
            <!-- ================================================= -->

            <div class="questao">

                <div class="mb-4 flex items-center gap-3">

                    <span class="grid h-9 w-9 place-items-center rounded-lg bg-laranja font-black text-white">
                        1
                    </span>

                    <span class="text-sm font-bold uppercase tracking-wider text-laranja">
                        Língua Portuguesa
                    </span>

                </div>

                <h2 class="text-xl font-black text-azul">
                    Qual alternativa apresenta uma frase corretamente escrita?
                </h2>

                <div class="mt-5 space-y-3">

                    <label class="opcao">
                        <input type="radio" name="questao1" value="A" required>
                        A) Os aluno estudam todos os dias.
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao1" value="B">
                        B) Os alunos estudam todos os dias.
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao1" value="C">
                        C) Os alunos estuda todos os dias.
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao1" value="D">
                        D) O alunos estudam todos os dias.
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 2 -->

            <div class="questao">

                <div class="numero">2</div>

                <h2 class="pergunta">
                    Qual é o resultado de 15 × 4?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao2" value="A" required>
                        A) 45
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao2" value="B">
                        B) 50
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao2" value="C">
                        C) 60
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao2" value="D">
                        D) 75
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 3 -->

            <div class="questao">

                <div class="numero">3</div>

                <h2 class="pergunta">
                    Qual é o maior planeta do Sistema Solar?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao3" value="A" required>
                        A) Júpiter
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao3" value="B">
                        B) Terra
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao3" value="C">
                        C) Marte
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao3" value="D">
                        D) Vênus
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 4 -->

            <div class="questao">

                <div class="numero">4</div>

                <h2 class="pergunta">
                    Qual é a capital do Brasil?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao4" value="A" required>
                        A) São Paulo
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao4" value="B">
                        B) Rio de Janeiro
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao4" value="C">
                        C) Belo Horizonte
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao4" value="D">
                        D) Brasília
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 5 -->

            <div class="questao">

                <div class="numero">5</div>

                <h2 class="pergunta">
                    Qual das opções representa uma fonte de energia renovável?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao5" value="A" required>
                        A) Carvão mineral
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao5" value="B">
                        B) Energia solar
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao5" value="C">
                        C) Petróleo
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao5" value="D">
                        D) Gás natural
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 6 -->

            <div class="questao">

                <div class="numero">6</div>

                <h2 class="pergunta">
                    Quanto é 144 ÷ 12?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao6" value="A" required>
                        A) 10
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao6" value="B">
                        B) 11
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao6" value="C">
                        C) 12
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao6" value="D">
                        D) 14
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 7 -->

            <div class="questao">

                <div class="numero">7</div>

                <h2 class="pergunta">
                    Qual órgão do corpo humano é responsável por bombear o sangue?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao7" value="A" required>
                        A) Coração
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao7" value="B">
                        B) Pulmão
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao7" value="C">
                        C) Estômago
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao7" value="D">
                        D) Rim
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 8 -->

            <div class="questao">

                <div class="numero">8</div>

                <h2 class="pergunta">
                    Em qual continente está localizado o Brasil?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao8" value="A" required>
                        A) Europa
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao8" value="B">
                        B) África
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao8" value="C">
                        C) Ásia
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao8" value="D">
                        D) América do Sul
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 9 -->

            <div class="questao">

                <div class="numero">9</div>

                <h2 class="pergunta">
                    Qual linguagem é utilizada para estruturar páginas da internet?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao9" value="A" required>
                        A) Python
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao9" value="B">
                        B) HTML
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao9" value="C">
                        C) SQL
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao9" value="D">
                        D) PHP
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 10 -->

            <div class="questao">

                <div class="numero">10</div>

                <h2 class="pergunta">
                    Qual é o resultado de 25 + 37?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao10" value="A" required>
                        A) 52
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao10" value="B">
                        B) 60
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao10" value="C">
                        C) 62
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao10" value="D">
                        D) 72
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 11 -->

            <div class="questao">

                <div class="numero">11</div>

                <h2 class="pergunta">
                    Qual é o principal gás presente na atmosfera terrestre?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao11" value="A" required>
                        A) Nitrogênio
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao11" value="B">
                        B) Oxigênio
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao11" value="C">
                        C) Hidrogênio
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao11" value="D">
                        D) Gás carbônico
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 12 -->

            <div class="questao">

                <div class="numero">12</div>

                <h2 class="pergunta">
                    Qual é a função principal do sistema operacional?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao12" value="A" required>
                        A) Apenas acessar a internet
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao12" value="B">
                        B) Gerenciar recursos e programas do computador
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao12" value="C">
                        C) Criar somente documentos
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao12" value="D">
                        D) Substituir o hardware
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 13 -->

            <div class="questao">

                <div class="numero">13</div>

                <h2 class="pergunta">
                    Qual foi um dos principais acontecimentos da Revolução Industrial?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao13" value="A" required>
                        A) Fim da agricultura
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao13" value="B">
                        B) Extinção das cidades
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao13" value="C">
                        C) Desaparecimento das máquinas
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao13" value="D">
                        D) Crescimento da produção mecanizada
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 14 -->

            <div class="questao">

                <div class="numero">14</div>

                <h2 class="pergunta">
                    Qual planeta é conhecido como Planeta Vermelho?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao14" value="A" required>
                        A) Júpiter
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao14" value="B">
                        B) Saturno
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao14" value="C">
                        C) Marte
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao14" value="D">
                        D) Netuno
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 15 -->

            <div class="questao">

                <div class="numero">15</div>

                <h2 class="pergunta">
                    Qual é o dobro de 35?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao15" value="A" required>
                        A) 70
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao15" value="B">
                        B) 65
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao15" value="C">
                        C) 75
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao15" value="D">
                        D) 80
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 16 -->

            <div class="questao">

                <div class="numero">16</div>

                <h2 class="pergunta">
                    Qual destas opções é um navegador de internet?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao16" value="A" required>
                        A) Windows
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao16" value="B">
                        B) Google Chrome
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao16" value="C">
                        C) Linux
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao16" value="D">
                        D) Android
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 17 -->

            <div class="questao">

                <div class="numero">17</div>

                <h2 class="pergunta">
                    Qual é o resultado de 9²?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao17" value="A" required>
                        A) 18
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao17" value="B">
                        B) 72
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao17" value="C">
                        C) 81
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao17" value="D">
                        D) 90
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 18 -->

            <div class="questao">

                <div class="numero">18</div>

                <h2 class="pergunta">
                    O que significa a sigla CPU?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao18" value="A" required>
                        A) Central Program Unit
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao18" value="B">
                        B) Computer Personal Unit
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao18" value="C">
                        C) Computer Processing User
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao18" value="D">
                        D) Central Processing Unit
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 19 -->

            <div class="questao">

                <div class="numero">19</div>

                <h2 class="pergunta">
                    Qual destas atitudes ajuda na preservação do meio ambiente?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao19" value="A" required>
                        A) Reciclar materiais
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao19" value="B">
                        B) Jogar lixo nos rios
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao19" value="C">
                        C) Desperdiçar água
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao19" value="D">
                        D) Aumentar o desperdício
                    </label>

                </div>

            </div>


            <!-- QUESTÃO 20 -->

            <div class="questao">

                <div class="numero">20</div>

                <h2 class="pergunta">
                    Em programação, qual destas opções representa uma linguagem?
                </h2>

                <div class="alternativas">

                    <label class="opcao">
                        <input type="radio" name="questao20" value="A" required>
                        A) HDMI
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao20" value="B">
                        B) Python
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao20" value="C">
                        C) USB
                    </label>

                    <label class="opcao">
                        <input type="radio" name="questao20" value="D">
                        D) SSD
                    </label>

                </div>

            </div>


            <!-- ================================================= -->
            <!-- BOTÃO -->
            <!-- ================================================= -->

            <div class="mt-10 rounded-3xl bg-azul p-8 text-center text-white">

                <h2 class="text-2xl font-black">
                    Finalizar avaliação
                </h2>

                <p class="mx-auto mt-3 max-w-xl text-blue-100">

                    Confira suas respostas antes de enviar.
                    Após o envio, o sistema calculará automaticamente
                    sua pontuação.

                </p>

                <button
                    type="submit"
                    class="mt-6 rounded-xl bg-laranja px-8 py-4 font-black transition hover:bg-laranjaEscuro">

                    Enviar avaliação

                </button>

            </div>

        </form>

    </div>

</main>

<?php endif; ?>


<!-- ========================================================= -->
<!-- FOOTER -->
<!-- ========================================================= -->

<footer class="bg-[#002D45] px-5 py-10 text-center text-blue-100">

    <p class="text-sm">
        © 2026 EscolaTech — Ensino Médio
    </p>

</footer>


<!-- ========================================================= -->
<!-- VLibras -->
<!-- ========================================================= -->

<div vw class="enabled">

    <div vw-access-button class="active"></div>

    <div vw-plugin-wrapper>

        <div class="vw-plugin-top-wrapper"></div>

    </div>

</div>

<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>

<script>

    new window.VLibras.Widget(
        'https://vlibras.gov.br/app'
    );

</script>


<!-- ========================================================= -->
<!-- ESTILOS -->
<!-- ========================================================= -->

<style>

    .questao {

        margin-top: 24px;

        background: white;

        padding: 32px;

        border-radius: 24px;

        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);

    }


    .numero {

        width: 36px;

        height: 36px;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #F58220;

        color: white;

        font-weight: 900;

        border-radius: 8px;

        margin-bottom: 18px;

    }


    .pergunta {

        font-size: 20px;

        font-weight: 900;

        color: #003B5C;

    }


    .alternativas {

        display: flex;

        flex-direction: column;

        gap: 12px;

        margin-top: 20px;

    }


    .opcao {

        display: block;

        padding: 16px;

        border: 1px solid #E2E8F0;

        border-radius: 12px;

        cursor: pointer;

        transition: 0.2s;

    }


    .opcao:hover {

        border-color: #F58220;

        background: #FFF7ED;

    }


    .opcao input {

        margin-right: 10px;

        accent-color: #F58220;

    }

</style>


<!-- ========================================================= -->
<!-- MÁSCARAS CPF E TELEFONE -->
<!-- ========================================================= -->

<script>

    const cpf = document.getElementById("cpf");

    if (cpf) {

        cpf.addEventListener("input", function () {

            let valor = this.value.replace(/\D/g, "");

            valor = valor.substring(0, 11);

            valor = valor.replace(/(\d{3})(\d)/, "$1.$2");

            valor = valor.replace(/(\d{3})(\d)/, "$1.$2");

            valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

            this.value = valor;

        });

    }


    const telefone = document.getElementById("telefone");

    if (telefone) {

        telefone.addEventListener("input", function () {

            let valor = this.value.replace(/\D/g, "");

            valor = valor.substring(0, 11);

            valor = valor.replace(/^(\d{2})(\d)/g, "($1) $2");

            valor = valor.replace(/(\d)(\d{4})$/, "$1-$2");

            this.value = valor;

        });

    }

</script>

</body>

</html>