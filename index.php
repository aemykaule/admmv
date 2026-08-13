<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>EscolaTech | Ensino Médio</title>

    <!-- Tailwind CSS -->
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

<body class="bg-white text-slate-800">

<!-- ================================================= -->
<!-- HEADER -->
<!-- ================================================= -->

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


        <!-- MENU -->

        <nav class="hidden items-center gap-7 text-sm font-medium lg:flex">

            <a href="#escola" class="transition hover:text-laranja">
                A Escola
            </a>

            <a href="#ensino" class="transition hover:text-laranja">
                Ensino
            </a>

            <a href="#cursos" class="transition hover:text-laranja">
                Cursos
            </a>

            <a href="#feiras" class="transition hover:text-laranja">
                Feiras
            </a>

            <a href="#clubes" class="transition hover:text-laranja">
                Clubes
            </a>

        </nav>


        <!-- LOGIN + BOTÃO -->

        <div class="flex items-center gap-3">

            <!-- ÍCONE DE USUÁRIO -->

            <a
                href="login.php"
                title="Entrar ou cadastrar"
                aria-label="Entrar ou cadastrar"
                class="grid h-11 w-11 place-items-center rounded-lg border border-white/20 bg-white/10 text-white transition hover:border-laranja hover:bg-laranja"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="h-6 w-6"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.118a7.5 7.5 0 0 1 15 0A17.933 17.933 0 0 0 12 21.75a17.933 17.933 0 0 0-7.5-1.632Z"
                    />

                </svg>

            </a>


            <!-- BOTÃO AVALIAÇÃO -->

            <a
                href="prova.php"
                class="rounded-lg bg-laranja px-5 py-2.5 text-sm font-bold text-white transition hover:bg-laranjaEscuro"
            >

                Fazer Avaliação

            </a>

        </div>

    </div>

</header>


<!-- ================================================= -->
<!-- HERO -->
<!-- ================================================= -->

<section class="relative overflow-hidden bg-azul px-5 py-24 text-white">

    <div class="absolute -right-24 -top-24 h-80 w-80 rounded-full bg-laranja/10"></div>

    <div class="absolute -bottom-40 -left-20 h-96 w-96 rounded-full bg-blue-300/10"></div>


    <div class="relative mx-auto grid max-w-7xl items-center gap-14 lg:grid-cols-2">

        <!-- TEXTO -->

        <div>

            <span class="inline-block rounded-full border border-white/10 bg-white/10 px-4 py-2 text-sm font-semibold text-orange-200">

                Educação para o futuro

            </span>


            <h1 class="mt-6 text-5xl font-black leading-tight md:text-6xl">

                Onde o futuro

                <span class="text-laranja">
                    começa agora.
                </span>

            </h1>


            <p class="mt-6 max-w-xl text-lg leading-8 text-blue-100">

                Uma proposta de Ensino Médio que combina conhecimento,
                tecnologia, criatividade e desenvolvimento humano.

            </p>


            <div class="mt-8 flex flex-wrap gap-3">

                <a
                    href="prova.php"
                    class="rounded-xl bg-laranja px-6 py-3 font-bold transition hover:bg-laranjaEscuro"
                >

                    Fazer Avaliação de Ingresso

                </a>


                <a
                    href="#escola"
                    class="rounded-xl border border-white/30 px-6 py-3 font-bold transition hover:bg-white/10"
                >

                    Conheça a Escola

                </a>

            </div>


            <!-- ESTATÍSTICAS -->

            <div class="mt-12 grid max-w-xl grid-cols-3 gap-5 border-t border-white/15 pt-6">

                <div>

                    <strong class="text-2xl text-laranja">
                        1.200+
                    </strong>

                    <p class="mt-1 text-xs text-blue-200">
                        Alunos formados
                    </p>

                </div>


                <div>

                    <strong class="text-2xl text-laranja">
                        94%
                    </strong>

                    <p class="mt-1 text-xs text-blue-200">
                        Aprovação no ENEM
                    </p>

                </div>


                <div>

                    <strong class="text-2xl text-laranja">
                        100%
                    </strong>

                    <p class="mt-1 text-xs text-blue-200">
                        Inclusão
                    </p>

                </div>

            </div>

        </div>


        <!-- VÍDEO -->

        <div class="overflow-hidden rounded-2xl bg-white p-2 shadow-2xl">

            <div class="aspect-video overflow-hidden rounded-xl">

                <iframe
                    class="h-full w-full"
                    src="https://www.youtube.com/embed/5tvsNooQGDw"
                    title="Vídeo institucional da EscolaTech"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen
                >
                </iframe>

            </div>

        </div>

    </div>

</section>


<!-- ================================================= -->
<!-- SOBRE A ESCOLA -->
<!-- ================================================= -->

<section id="escola" class="px-5 py-20">

    <div class="mx-auto grid max-w-7xl items-center gap-12 lg:grid-cols-2">

        <!-- FOTO 1 -->

        <div class="overflow-hidden rounded-2xl shadow-xl">

            <img
                src="./img/iscola.png"
                alt="Escola"
                class="h-[420px] w-full object-cover"
            >

        </div>


        <!-- TEXTO -->

        <div>

            <span class="text-sm font-bold uppercase tracking-wider text-laranja">
                Sobre a Escola
            </span>


            <h2 class="mt-3 text-4xl font-black text-azul">

                Educação preparada para o mundo atual

            </h2>


            <p class="mt-6 leading-8 text-slate-500">

                A EscolaTech é uma instituição de Ensino Médio que acredita
                que a educação deve preparar os estudantes não apenas para
                avaliações, mas também para os desafios da vida.

            </p>


            <p class="mt-4 leading-8 text-slate-500">

                Nossa proposta combina uma formação acadêmica sólida com
                tecnologia, projetos, atividades culturais, empreendedorismo
                e experiências práticas.

            </p>


            <p class="mt-4 leading-8 text-slate-500">

                Buscamos formar jovens críticos, criativos, responsáveis e
                preparados para continuar aprendendo ao longo da vida.

            </p>


            <a
                href="#ensino"
                class="mt-7 inline-block rounded-lg bg-azul px-6 py-3 font-bold text-white transition hover:bg-azul2"
            >

                Conheça nossa proposta

            </a>

        </div>

    </div>

</section>


<!-- ================================================= -->
<!-- MISSÃO E VALORES -->
<!-- ================================================= -->

<section class="bg-fundo px-5 py-20">

    <div class="mx-auto max-w-7xl">

        <div class="text-center">

            <span class="inline-block rounded-full bg-orange-100 px-4 py-2 text-xs font-bold text-laranjaEscuro">

                Nossa essência

            </span>


            <h2 class="mt-4 text-4xl font-black text-azul">
                Missão e Valores
            </h2>


            <p class="mx-auto mt-4 max-w-2xl text-slate-500">

                Princípios que orientam nossa comunidade escolar.

            </p>

        </div>


        <div class="mt-12 grid gap-6 lg:grid-cols-2">

            <!-- MISSÃO -->

            <div class="rounded-3xl bg-azul p-10 text-white">

                <span class="text-sm font-bold uppercase tracking-wider text-orange-300">

                    Nossa missão

                </span>


                <h3 class="mt-4 text-3xl font-black">

                    Formar estudantes preparados para transformar o futuro.

                </h3>


                <p class="mt-5 leading-8 text-blue-100">

                    Oferecer uma educação integral de excelência, valorizando
                    o conhecimento, a criatividade, a responsabilidade e o
                    protagonismo dos estudantes.

                </p>

            </div>


            <!-- VALORES -->

            <div class="grid grid-cols-2 gap-4">

                <div class="rounded-2xl bg-white p-7 shadow-sm">

                    <div class="h-1 w-10 bg-laranja"></div>

                    <h3 class="mt-5 font-black text-azul">
                        Inovação
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">

                        Incentivo à curiosidade, criatividade e novas ideias.

                    </p>

                </div>


                <div class="rounded-2xl bg-white p-7 shadow-sm">

                    <div class="h-1 w-10 bg-laranja"></div>

                    <h3 class="mt-5 font-black text-azul">
                        Respeito
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">

                        Valorização das diferenças e da convivência.

                    </p>

                </div>


                <div class="rounded-2xl bg-white p-7 shadow-sm">

                    <div class="h-1 w-10 bg-laranja"></div>

                    <h3 class="mt-5 font-black text-azul">
                        Ética
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">

                        Responsabilidade nas decisões e atitudes.

                    </p>

                </div>


                <div class="rounded-2xl bg-white p-7 shadow-sm">

                    <div class="h-1 w-10 bg-laranja"></div>

                    <h3 class="mt-5 font-black text-azul">
                        Excelência
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">

                        Compromisso constante com o aprendizado.

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ================================================= -->
<!-- ENSINO -->
<!-- ================================================= -->

<section id="ensino" class="px-5 py-20">

    <div class="mx-auto max-w-7xl">

        <div class="max-w-3xl">

            <span class="text-sm font-bold uppercase tracking-wider text-laranja">

                Nossa metodologia

            </span>


            <h2 class="mt-3 text-4xl font-black text-azul">

                Aprender fazendo

            </h2>


            <p class="mt-5 leading-8 text-slate-500">

                Na EscolaTech, o estudante participa ativamente do processo
                de aprendizagem. Aulas teóricas são complementadas por
                projetos, pesquisas e atividades práticas.

            </p>

        </div>


        <div class="mt-12 grid gap-6 md:grid-cols-3">

            <!-- FOTO 2 -->

            <article class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-100">

                <img
                    src="COLE_O_LINK_DA_FOTO_DOS_ALUNOS_AQUI"
                    alt="Alunos em sala de aula"
                    class="h-52 w-full object-cover"
                >


                <div class="p-7">

                    <span class="text-xs font-bold uppercase tracking-wider text-laranja">
                        01
                    </span>

                    <h3 class="mt-2 text-xl font-black text-azul">
                        Aulas
                    </h3>

                    <p class="mt-3 text-sm leading-7 text-slate-500">

                        Conteúdos curriculares trabalhados de maneira dinâmica
                        e conectada ao cotidiano.

                    </p>

                </div>

            </article>


            <!-- FOTO 3 -->

            <article class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-100">

                <img
                    src="COLE_O_LINK_DA_FOTO_DE_PROJETOS_AQUI"
                    alt="Alunos desenvolvendo projetos"
                    class="h-52 w-full object-cover"
                >


                <div class="p-7">

                    <span class="text-xs font-bold uppercase tracking-wider text-laranja">
                        02
                    </span>

                    <h3 class="mt-2 text-xl font-black text-azul">
                        Projetos
                    </h3>

                    <p class="mt-3 text-sm leading-7 text-slate-500">

                        Os estudantes aplicam seus conhecimentos na criação
                        de projetos individuais e coletivos.

                    </p>

                </div>

            </article>


            <!-- FOTO 4 -->

            <article class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-100">

                <img
                    src="COLE_O_LINK_DA_FOTO_DO_LABORATORIO_AQUI"
                    alt="Laboratório de informática"
                    class="h-52 w-full object-cover"
                >


                <div class="p-7">

                    <span class="text-xs font-bold uppercase tracking-wider text-laranja">
                        03
                    </span>

                    <h3 class="mt-2 text-xl font-black text-azul">
                        Prática
                    </h3>

                    <p class="mt-3 text-sm leading-7 text-slate-500">

                        Experiências práticas aproximam o aprendizado dos
                        desafios do mundo real.

                    </p>

                </div>

            </article>

        </div>

    </div>

</section>


<!-- ================================================= -->
<!-- CURSOS -->
<!-- ================================================= -->

<section id="cursos" class="bg-fundo px-5 py-20">

    <div class="mx-auto max-w-7xl">

        <div class="text-center">

            <span class="text-sm font-bold uppercase tracking-wider text-laranja">

                Formação tecnológica

            </span>


            <h2 class="mt-3 text-4xl font-black text-azul">

                Tecnologia e inovação

            </h2>


            <p class="mx-auto mt-4 max-w-2xl text-slate-500">

                Áreas que ajudam os estudantes a desenvolver competências
                para o mundo digital.

            </p>

        </div>


        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-4">

            <!-- FOTO 5 -->

            <article class="overflow-hidden rounded-2xl bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

                <img
                    src="COLE_O_LINK_DA_FOTO_DE_PROGRAMACAO_AQUI"
                    alt="Aluno estudando programação"
                    class="h-48 w-full object-cover"
                >


                <div class="p-6">

                    <span class="text-xs font-bold uppercase tracking-wider text-laranja">
                        Tecnologia
                    </span>

                    <h3 class="mt-2 text-xl font-black text-azul">
                        Desenvolvimento Web
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-500">

                        HTML, CSS, JavaScript, PHP e desenvolvimento de
                        projetos para a web.

                    </p>

                </div>

            </article>


            <!-- FOTO 6 -->

            <article class="overflow-hidden rounded-2xl bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

                <img
                    src="COLE_O_LINK_DA_FOTO_DE_IA_AQUI"
                    alt="Tecnologia e inteligência artificial"
                    class="h-48 w-full object-cover"
                >


                <div class="p-6">

                    <span class="text-xs font-bold uppercase tracking-wider text-laranja">
                        Inovação
                    </span>

                    <h3 class="mt-2 text-xl font-black text-azul">
                        Inteligência Artificial
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-500">

                        Fundamentos de inteligência artificial, programação
                        e novas tecnologias.

                    </p>

                </div>

            </article>


            <!-- FOTO 7 -->

            <article class="overflow-hidden rounded-2xl bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

                <img
                    src="COLE_O_LINK_DA_FOTO_DE_SEGURANCA_AQUI"
                    alt="Computadores utilizados em aula"
                    class="h-48 w-full object-cover"
                >


                <div class="p-6">

                    <span class="text-xs font-bold uppercase tracking-wider text-laranja">
                        Segurança
                    </span>

                    <h3 class="mt-2 text-xl font-black text-azul">
                        Cibersegurança
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-500">

                        Segurança digital, redes e proteção de informações.

                    </p>

                </div>

            </article>


            <!-- FOTO 8 -->

            <article class="overflow-hidden rounded-2xl bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

                <img
                    src="COLE_O_LINK_DA_FOTO_DE_DESIGN_AQUI"
                    alt="Aluno trabalhando com design"
                    class="h-48 w-full object-cover"
                >


                <div class="p-6">

                    <span class="text-xs font-bold uppercase tracking-wider text-laranja">
                        Criatividade
                    </span>

                    <h3 class="mt-2 text-xl font-black text-azul">
                        Design e UX
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-500">

                        Interfaces, criatividade e experiência do usuário.

                    </p>

                </div>

            </article>

        </div>

    </div>

</section>


<!-- ================================================= -->
<!-- FEIRAS -->
<!-- ================================================= -->

<section id="feiras" class="px-5 py-20">

    <div class="mx-auto max-w-7xl">

        <div class="grid items-center gap-12 lg:grid-cols-2">

            <!-- TEXTO -->

            <div>

                <span class="text-sm font-bold uppercase tracking-wider text-laranja">

                    Projetos escolares

                </span>


                <h2 class="mt-3 text-4xl font-black text-azul">

                    Feiras e projetos

                </h2>


                <p class="mt-5 leading-8 text-slate-500">

                    As feiras da EscolaTech são momentos de compartilhamento
                    de conhecimento, criatividade e descobertas.

                </p>


                <p class="mt-4 leading-8 text-slate-500">

                    Os estudantes trabalham em equipe para pesquisar,
                    desenvolver e apresentar projetos para a comunidade escolar.

                </p>


                <a
                    href="#clubes"
                    class="mt-6 inline-block rounded-lg border-2 border-azul px-6 py-3 font-bold text-azul transition hover:bg-azul hover:text-white"
                >

                    Conheça os projetos

                </a>

            </div>


            <!-- FOTOS -->

            <div class="grid grid-cols-2 gap-4">

                <img
                    src="COLE_O_LINK_DA_FOTO_DA_FEIRA_1_AQUI"
                    alt="Alunos em feira escolar"
                    class="h-64 w-full rounded-2xl object-cover"
                >


                <img
                    src="COLE_O_LINK_DA_FOTO_DA_FEIRA_2_AQUI"
                    alt="Projeto apresentado por alunos"
                    class="mt-8 h-64 w-full rounded-2xl object-cover"
                >


                <img
                    src="COLE_O_LINK_DA_FOTO_DA_FEIRA_3_AQUI"
                    alt="Alunos apresentando um projeto"
                    class="h-64 w-full rounded-2xl object-cover"
                >


                <img
                    src="COLE_O_LINK_DA_FOTO_DO_PATIO_AQUI"
                    alt="Pátio da escola"
                    class="mt-8 h-64 w-full rounded-2xl object-cover"
                >

            </div>

        </div>

    </div>

</section>


<!-- ================================================= -->
<!-- CLUBES -->
<!-- ================================================= -->

<section id="clubes" class="bg-fundo px-5 py-20">

    <div class="mx-auto max-w-7xl">

        <div class="text-center">

            <span class="text-sm font-bold uppercase tracking-wider text-laranja">

                Vida escolar

            </span>


            <h2 class="mt-3 text-4xl font-black text-azul">

                Clubes e atividades

            </h2>


            <p class="mx-auto mt-4 max-w-2xl text-slate-500">

                Espaços para os estudantes desenvolverem interesses,
                talentos e novas habilidades.

            </p>

        </div>


        <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-4">

            <div class="border-l-4 border-laranja bg-white p-7 shadow-sm">

                <h3 class="font-black text-azul">
                    Tecnologia
                </h3>

                <p class="mt-3 text-sm leading-6 text-slate-500">

                    Programação, inovação e desenvolvimento de projetos.

                </p>

            </div>


            <div class="border-l-4 border-laranja bg-white p-7 shadow-sm">

                <h3 class="font-black text-azul">
                    Artes
                </h3>

                <p class="mt-3 text-sm leading-6 text-slate-500">

                    Música, desenho, teatro e diferentes formas de expressão.

                </p>

            </div>


            <div class="border-l-4 border-laranja bg-white p-7 shadow-sm">

                <h3 class="font-black text-azul">
                    Leitura
                </h3>

                <p class="mt-3 text-sm leading-6 text-slate-500">

                    Literatura, debates e desenvolvimento da comunicação.

                </p>

            </div>


            <div class="border-l-4 border-laranja bg-white p-7 shadow-sm">

                <h3 class="font-black text-azul">
                    Esportes
                </h3>

                <p class="mt-3 text-sm leading-6 text-slate-500">

                    Atividades esportivas, cooperação e trabalho em equipe.

                </p>

            </div>

        </div>

    </div>

</section>


<!-- ================================================= -->
<!-- ACESSIBILIDADE -->
<!-- ================================================= -->

<section id="acessibilidade" class="bg-laranja px-5 py-20 text-white">

    <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-8 md:flex-row">

        <div class="max-w-2xl">

            <span class="text-sm font-bold uppercase tracking-wider text-orange-100">

                Inclusão

            </span>


            <h2 class="mt-3 text-4xl font-black">

                Educação para todos

            </h2>


            <p class="mt-5 leading-8 text-orange-50">

                A EscolaTech busca oferecer um ambiente acolhedor,
                acessível e respeitoso, valorizando a diversidade e
                garantindo que todos possam participar da experiência escolar.

            </p>

        </div>


        <button
            onclick="lerTexto()"
            class="shrink-0 rounded-xl bg-white px-6 py-4 font-bold text-laranjaEscuro transition hover:bg-orange-50"
        >

            Ouvir conteúdo

        </button>

    </div>

</section>


<!-- ================================================= -->
<!-- AVALIAÇÃO -->
<!-- ================================================= -->

<section class="bg-azul px-5 py-20 text-white">

    <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-8 md:flex-row">

        <div class="max-w-2xl">

            <span class="text-sm font-bold uppercase tracking-wider text-orange-300">

                Processo de ingresso

            </span>


            <h2 class="mt-3 text-4xl font-black">

                Faça parte da EscolaTech

            </h2>


            <p class="mt-5 leading-8 text-blue-100">

                Quer estudar conosco? Acesse a página de avaliação
                e participe do processo de ingresso.

            </p>

        </div>


        <a
            href="prova.php"
            class="shrink-0 rounded-xl bg-laranja px-7 py-4 font-bold transition hover:bg-laranjaEscuro"
        >

            Fazer Avaliação

        </a>

    </div>

</section>


<!-- ================================================= -->
<!-- FOOTER -->
<!-- ================================================= -->

<footer class="bg-[#002D45] px-5 py-12 text-blue-100">

    <div class="mx-auto max-w-7xl">

        <div class="grid gap-10 md:grid-cols-3">

            <!-- ESCOLA -->

            <div>

                <div class="flex items-center gap-3 text-white">

                    <span class="grid h-9 w-9 place-items-center rounded-lg bg-laranja font-black">
                        E
                    </span>

                    <strong>
                        EscolaTech
                    </strong>

                </div>


                <p class="mt-4 max-w-sm text-sm leading-7">

                    Educação, tecnologia e inclusão para preparar estudantes
                    para os desafios do futuro.

                </p>

            </div>


            <!-- NAVEGAÇÃO -->

            <div>

                <h3 class="font-bold text-white">
                    Navegação
                </h3>


                <div class="mt-4 flex flex-col gap-2 text-sm">

                    <a href="#escola" class="transition hover:text-laranja">
                        A Escola
                    </a>

                    <a href="#ensino" class="transition hover:text-laranja">
                        Ensino
                    </a>

                    <a href="#cursos" class="transition hover:text-laranja">
                        Cursos
                    </a>

                    <a href="#feiras" class="transition hover:text-laranja">
                        Feiras
                    </a>

                    <a href="#clubes" class="transition hover:text-laranja">
                        Clubes
                    </a>

                    <a href="login.php" class="transition hover:text-laranja">
                        Área do estudante
                    </a>

                </div>

            </div>


            <!-- CONTATO -->

            <div>

                <h3 class="font-bold text-white">
                    Contato
                </h3>


                <p class="mt-4 text-sm">
                    contato@escolatech.edu.br
                </p>


                <p class="mt-2 text-sm">
                    Ensino Médio
                </p>

            </div>

        </div>


        <div class="mt-10 border-t border-white/10 pt-5 text-center text-xs">

            © 2026 EscolaTech — Ensino Médio

        </div>

    </div>

</footer>


<!-- ================================================= -->
<!-- VLIBRAS -->
<!-- ================================================= -->

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


    function lerTexto() {

        if (!('speechSynthesis' in window)) {

            alert('Seu navegador não suporta leitura de texto.');

            return;

        }

        const texto = document.body.innerText;

        const fala = new SpeechSynthesisUtterance(texto);

        fala.lang = 'pt-BR';

        speechSynthesis.cancel();

        speechSynthesis.speak(fala);

    }

</script>


</body>

</html> 
