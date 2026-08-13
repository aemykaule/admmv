
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
<body>
    lets goo


<body class="bg-white text-[#263238]">


    <!-- ================= HEADER ================= -->

    <header class="sticky top-0 z-50 bg-azul text-white shadow-md">

        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4">

            <!-- LOGO -->

            <a href="index.php" class="flex items-center gap-3">

                <span class="grid h-10 w-10 place-items-center rounded-lg bg-laranja font-black">
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

            <nav class="hidden gap-6 text-sm font-medium lg:flex">

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

                <a href="#acessibilidade" class="transition hover:text-laranja">
                    Inclusão
                </a>

            </nav>


            <!-- BOTÃO -->

            <a href="prova.php"
               class="rounded-lg bg-laranja px-5 py-2.5 text-sm font-bold transition hover:bg-laranjaEscuro">

                Fazer Avaliação

            </a>

        </div>

    </header>



    <!-- ================= HERO ================= -->

    <section class="relative overflow-hidden bg-azul px-5 py-24 text-white">

        <!-- Elementos decorativos -->

        <div class="absolute -right-20 -top-20 h-72 w-72 rounded-full bg-laranja/10"></div>

        <div class="absolute -bottom-32 -left-20 h-80 w-80 rounded-full bg-blue-400/10"></div>


        <div class="relative mx-auto grid max-w-7xl items-center gap-14 lg:grid-cols-2">


            <!-- TEXTO -->

            <div>

                <span class="inline-block rounded-full bg-white/10 px-4 py-2 text-sm font-bold text-orange-300">
                    Educação que prepara para o futuro
                </span>


                <h1 class="mt-6 text-5xl font-black leading-tight md:text-6xl">

                    Onde o futuro

                    <span class="text-laranja">
                        começa agora.
                    </span>

                </h1>


                <p class="mt-6 max-w-xl text-lg leading-8 text-blue-100">

                    Uma escola de Ensino Médio que une educação,
                    tecnologia, criatividade e desenvolvimento humano
                    para preparar estudantes para os desafios do futuro.

                </p>


                <div class="mt-8 flex flex-wrap gap-3">

                    <a href="prova.php"
                       class="rounded-xl bg-laranja px-6 py-3 font-bold transition hover:bg-laranjaEscuro">

                        📝 Fazer Avaliação de Ingresso

                    </a>


                    <a href="#escola"
                       class="rounded-xl border border-white/30 px-6 py-3 font-bold transition hover:bg-white/10">

                        Conheça a escola

                    </a>

                </div>


                <!-- ESTATÍSTICAS -->

                <div class="mt-12 grid grid-cols-3 gap-5 border-t border-white/20 pt-6">

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



            <!-- CARD -->

            <div class="rounded-3xl bg-white p-2 shadow-2xl">

                <div class="flex aspect-video flex-col items-center justify-center rounded-2xl bg-azul2 text-white">

                    <div class="grid h-20 w-20 place-items-center rounded-full bg-laranja text-3xl shadow-lg">

                        ▶

                    </div>


                    <p class="mt-5 font-bold">
                        VÍDEO INSTITUCIONAL
                    </p>


                    <p class="mt-2 text-sm text-blue-200">
                        Conheça a EscolaTech
                    </p>

                </div>

            </div>

        </div>

    </section>



    <!-- ================= SOBRE A ESCOLA ================= -->

    <section id="escola" class="px-5 py-20">

        <div class="mx-auto max-w-7xl">


            <div class="grid items-center gap-12 lg:grid-cols-2">


                <!-- TEXTO -->

                <div>

                    <span class="text-sm font-bold uppercase tracking-wider text-laranja">
                        Sobre nós
                    </span>


                    <h2 class="mt-3 text-4xl font-black text-azul">
                        Uma escola preparada para o mundo de hoje
                    </h2>


                    <p class="mt-6 leading-8 text-slate-500">

                        A EscolaTech é uma instituição de Ensino Médio
                        que acredita que a educação deve preparar os
                        estudantes não apenas para provas, mas também
                        para a vida.

                    </p>


                    <p class="mt-4 leading-8 text-slate-500">

                        Por isso, combinamos a formação tradicional com
                        tecnologia, projetos, atividades culturais,
                        empreendedorismo e experiências práticas.

                    </p>


                    <p class="mt-4 leading-8 text-slate-500">

                        Nosso objetivo é formar jovens críticos,
                        responsáveis, criativos e preparados para
                        continuar aprendendo ao longo da vida.

                    </p>

                </div>



                <!-- CARDS -->

                <div class="grid grid-cols-2 gap-4">


                    <div class="rounded-3xl bg-azul p-7 text-white">

                        <div class="text-4xl">
                            🎓
                        </div>

                        <h3 class="mt-5 text-xl font-black">
                            Ensino Médio
                        </h3>

                        <p class="mt-2 text-sm text-blue-100">
                            Formação completa para o futuro acadêmico e profissional.
                        </p>

                    </div>


                    <div class="rounded-3xl bg-laranja p-7 text-white">

                        <div class="text-4xl">
                            💻
                        </div>

                        <h3 class="mt-5 text-xl font-black">
                            Tecnologia
                        </h3>

                        <p class="mt-2 text-sm text-orange-50">
                            Tecnologia integrada ao aprendizado.
                        </p>

                    </div>


                    <div class="rounded-3xl bg-blue-50 p-7">

                        <div class="text-4xl">
                            🤝
                        </div>

                        <h3 class="mt-5 text-xl font-black text-azul">
                            Comunidade
                        </h3>

                        <p class="mt-2 text-sm text-slate-500">
                            Respeito, colaboração e convivência.
                        </p>

                    </div>


                    <div class="rounded-3xl bg-orange-50 p-7">

                        <div class="text-4xl">
                            🚀
                        </div>

                        <h3 class="mt-5 text-xl font-black text-azul">
                            Futuro
                        </h3>

                        <p class="mt-2 text-sm text-slate-500">
                            Preparação para novos desafios.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- ================= MISSÃO ================= -->

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
                    Os princípios que orientam nossa comunidade escolar.
                </p>

            </div>



            <div class="mt-12 grid gap-6 lg:grid-cols-2">


                <!-- MISSÃO -->

                <div class="rounded-3xl bg-azul p-8 text-white">

                    <div class="text-5xl">
                        🎯
                    </div>


                    <h3 class="mt-6 text-2xl font-black text-laranja">
                        Nossa Missão
                    </h3>


                    <p class="mt-4 leading-8 text-blue-100">

                        Oferecer uma educação integral de excelência,
                        formando jovens protagonistas, capazes de pensar
                        criticamente, trabalhar em equipe e transformar
                        a realidade ao seu redor.

                    </p>

                </div>



                <!-- VALORES -->

                <div class="grid grid-cols-2 gap-4">


                    <div class="rounded-2xl bg-white p-6 shadow-sm">

                        <div class="text-3xl">
                            🌱
                        </div>

                        <h3 class="mt-3 font-bold text-azul">
                            Inovação
                        </h3>

                        <p class="mt-2 text-sm text-slate-500">
                            Incentivo à curiosidade e criatividade.
                        </p>

                    </div>


                    <div class="rounded-2xl bg-white p-6 shadow-sm">

                        <div class="text-3xl">
                            🤝
                        </div>

                        <h3 class="mt-3 font-bold text-azul">
                            Respeito
                        </h3>

                        <p class="mt-2 text-sm text-slate-500">
                            Valorização das diferenças.
                        </p>

                    </div>


                    <div class="rounded-2xl bg-white p-6 shadow-sm">

                        <div class="text-3xl">
                            ⚖️
                        </div>

                        <h3 class="mt-3 font-bold text-azul">
                            Ética
                        </h3>

                        <p class="mt-2 text-sm text-slate-500">
                            Responsabilidade em nossas escolhas.
                        </p>

                    </div>


                    <div class="rounded-2xl bg-white p-6 shadow-sm">

                        <div class="text-3xl">
                            ⭐
                        </div>

                        <h3 class="mt-3 font-bold text-azul">
                            Excelência
                        </h3>

                        <p class="mt-2 text-sm text-slate-500">
                            Busca constante pelo aprendizado.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- ================= ENSINO ================= -->

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

                    Na EscolaTech, o estudante participa ativamente
                    do processo de aprendizagem. As aulas combinam
                    teoria, prática, projetos e trabalho colaborativo.

                </p>

            </div>



            <div class="mt-12 grid gap-6 md:grid-cols-3">


                <div class="rounded-3xl border border-slate-100 bg-white p-8 shadow-sm">

                    <div class="grid h-14 w-14 place-items-center rounded-xl bg-blue-50 text-3xl">
                        📚
                    </div>

                    <h3 class="mt-6 text-xl font-black text-azul">
                        Aulas
                    </h3>

                    <p class="mt-3 leading-7 text-slate-500">
                        Conteúdos curriculares aliados a atividades
                        práticas e tecnologia.
                    </p>

                </div>


                <div class="rounded-3xl border border-slate-100 bg-white p-8 shadow-sm">

                    <div class="grid h-14 w-14 place-items-center rounded-xl bg-orange-100 text-3xl">
                        🔬
                    </div>

                    <h3 class="mt-6 text-xl font-black text-azul">
                        Projetos
                    </h3>

                    <p class="mt-3 leading-7 text-slate-500">
                        Os alunos aplicam seus conhecimentos em projetos
                        individuais e coletivos.
                    </p>

                </div>


                <div class="rounded-3xl border border-slate-100 bg-white p-8 shadow-sm">

                    <div class="grid h-14 w-14 place-items-center rounded-xl bg-blue-50 text-3xl">
                        💡
                    </div>

                    <h3 class="mt-6 text-xl font-black text-azul">
                        Criatividade
                    </h3>

                    <p class="mt-3 leading-7 text-slate-500">
                        Incentivamos os estudantes a desenvolver suas
                        próprias ideias e soluções.
                    </p>

                </div>

            </div>

        </div>

    </section>



    <!-- ================= CURSOS ================= -->

    <section id="cursos" class="bg-fundo px-5 py-20">

        <div class="mx-auto max-w-7xl">


            <div class="text-center">

                <span class="inline-block rounded-full bg-orange-100 px-4 py-2 text-xs font-bold text-laranjaEscuro">
                    Formação
                </span>


                <h2 class="mt-4 text-4xl font-black text-azul">
                    Trilhas de Tecnologia
                </h2>


                <p class="mt-4 text-slate-500">
                    Conhecimentos que complementam a formação do estudante.
                </p>

            </div>



            <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">


                <div class="rounded-2xl bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                    <div class="text-4xl">
                        💻
                    </div>

                    <h3 class="mt-4 text-xl font-black text-azul">
                        Desenvolvimento Web
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        HTML, CSS, JavaScript, PHP e criação de projetos.
                    </p>

                </div>


                <div class="rounded-2xl bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                    <div class="text-4xl">
                        🤖
                    </div>

                    <h3 class="mt-4 text-xl font-black text-azul">
                        Inteligência Artificial
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        Fundamentos de IA, Python e novas tecnologias.
                    </p>

                </div>


                <div class="rounded-2xl bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                    <div class="text-4xl">
                        🔒
                    </div>

                    <h3 class="mt-4 text-xl font-black text-azul">
                        Cibersegurança
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        Segurança digital, redes e proteção de dados.
                    </p>

                </div>


                <div class="rounded-2xl bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                    <div class="text-4xl">
                        📱
                    </div>

                    <h3 class="mt-4 text-xl font-black text-azul">
                        Design e UX
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        Design de interfaces, criatividade e experiência do usuário.
                    </p>

                </div>

            </div>

        </div>

    </section>



    <!-- ================= FEIRAS ================= -->

    <section id="feiras" class="px-5 py-20">

        <div class="mx-auto max-w-7xl">


            <div class="grid items-center gap-12 lg:grid-cols-2">


                <div>

                    <span class="text-sm font-bold uppercase tracking-wider text-laranja">
                        Projetos
                    </span>


                    <h2 class="mt-3 text-4xl font-black text-azul">
                        Feiras e projetos
                    </h2>


                    <p class="mt-5 leading-8 text-slate-500">

                        As feiras são momentos em que os estudantes
                        apresentam aquilo que aprenderam e transformam
                        conhecimento em experiências reais.

                    </p>


                    <p class="mt-4 leading-8 text-slate-500">

                        Ciência, tecnologia, cultura e sustentabilidade
                        fazem parte dos projetos desenvolvidos durante
                        o ano letivo.

                    </p>

                </div>



                <div class="grid grid-cols-2 gap-4">


                    <div class="rounded-3xl bg-azul p-7 text-white">

                        <div class="text-4xl">
                            🔬
                        </div>

                        <h3 class="mt-5 font-black">
                            Feira de Ciências
                        </h3>

                    </div>


                    <div class="rounded-3xl bg-laranja p-7 text-white">

                        <div class="text-4xl">
                            💻
                        </div>

                        <h3 class="mt-5 font-black">
                            Feira de Tecnologia
                        </h3>

                    </div>


                    <div class="rounded-3xl bg-blue-50 p-7">

                        <div class="text-4xl">
                            🌎
                        </div>

                        <h3 class="mt-5 font-black text-azul">
                            Sustentabilidade
                        </h3>

                    </div>


                    <div class="rounded-3xl bg-orange-50 p-7">

                        <div class="text-4xl">
                            🎨
                        </div>

                        <h3 class="mt-5 font-black text-azul">
                            Cultura
                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- ================= CLUBES ================= -->

    <section id="clubes" class="bg-fundo px-5 py-20">

        <div class="mx-auto max-w-7xl">


            <div class="text-center">

                <span class="inline-block rounded-full bg-orange-100 px-4 py-2 text-xs font-bold text-laranjaEscuro">
                    Atividades
                </span>


                <h2 class="mt-4 text-4xl font-black text-azul">
                    Clubes e atividades
                </h2>


                <p class="mt-4 text-slate-500">
                    Espaços para desenvolver talentos e interesses.
                </p>

            </div>



            <div class="mt-12 grid gap-6 md:grid-cols-4">


                <div class="rounded-2xl bg-white p-6 text-center shadow-sm">

                    <div class="text-4xl">
                        🎮
                    </div>

                    <h3 class="mt-4 font-black text-azul">
                        Games
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Tecnologia e jogos.
                    </p>

                </div>


                <div class="rounded-2xl bg-white p-6 text-center shadow-sm">

                    <div class="text-4xl">
                        🎨
                    </div>

                    <h3 class="mt-4 font-black text-azul">
                        Arte
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Expressão e criatividade.
                    </p>

                </div>


                <div class="rounded-2xl bg-white p-6 text-center shadow-sm">

                    <div class="text-4xl">
                        📖
                    </div>

                    <h3 class="mt-4 font-black text-azul">
                        Leitura
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Literatura e conhecimento.
                    </p>

                </div>


                <div class="rounded-2xl bg-white p-6 text-center shadow-sm">

                    <div class="text-4xl">
                        ⚽
                    </div>

                    <h3 class="mt-4 font-black text-azul">
                        Esportes
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Saúde e trabalho em equipe.
                    </p>

                </div>

            </div>

        </div>

    </section>



    <!-- ================= ACESSIBILIDADE ================= -->

    <section id="acessibilidade" class="bg-laranja px-5 py-20 text-center text-white">

        <div class="mx-auto max-w-3xl">


            <div class="text-5xl">
                🤝
            </div>


            <h2 class="mt-5 text-4xl font-black">
                Acessibilidade e Inclusão
            </h2>


            <p class="mt-5 leading-8 text-orange-50">

                A EscolaTech acredita que todos devem ter acesso
                à educação. Por isso, buscamos oferecer um ambiente
                acolhedor, acessível e inclusivo.

            </p>


            <div class="mt-8 flex flex-wrap justify-center gap-3">

                <button
                    onclick="lerTexto()"
                    class="rounded-xl bg-white px-5 py-3 font-bold text-laranjaEscuro transition hover:bg-orange-50">

                    🔊 Ouvir conteúdo

                </button>


                <span class="rounded-xl border border-white/40 px-5 py-3 font-bold">

                    🤟 VLibras

                </span>

            </div>

        </div>

    </section>



    <!-- ================= AVALIAÇÃO ================= -->

    <section class="bg-azul px-5 py-20 text-white">

        <div class="mx-auto flex max-w-5xl flex-col items-center justify-between gap-8 text-center md:flex-row md:text-left">


            <div>

                <span class="text-sm font-bold uppercase tracking-wider text-orange-300">
                    Faça parte da EscolaTech
                </span>


                <h2 class="mt-3 text-3xl font-black md:text-4xl">
                    Quer estudar conosco?
                </h2>


                <p class="mt-4 max-w-xl leading-7 text-blue-100">

                    Faça nossa avaliação de ingresso e participe
                    do processo de seleção de novos estudantes.

                </p>

            </div>


            <a href="prova.php"
               class="shrink-0 rounded-xl bg-laranja px-7 py-4 font-bold transition hover:bg-laranjaEscuro">

                📝 Fazer Avaliação

            </a>

        </div>

    </section>



    <!-- ================= FOOTER ================= -->

    <footer class="bg-[#002D45] px-5 py-12 text-blue-100">

        <div class="mx-auto max-w-7xl">


            <div class="flex flex-col justify-between gap-8 md:flex-row">


                <div>

                    <div class="flex items-center gap-3 text-white">

                        <span class="grid h-9 w-9 place-items-center rounded-lg bg-laranja font-black">
                            E
                        </span>

                        <strong>
                            EscolaTech
                        </strong>

                    </div>


                    <p class="mt-3 max-w-sm text-sm leading-6">

                        Educação, tecnologia e inclusão para preparar
                        alunos para os desafios do futuro.

                    </p>

                </div>



                <div>

                    <h3 class="font-bold text-white">
                        Contato
                    </h3>

                    <p class="mt-2 text-sm">
                        contato@escolatech.edu.br
                    </p>

                </div>



                <div>

                    <h3 class="font-bold text-white">
                        Navegação
                    </h3>

                    <div class="mt-2 flex flex-col gap-2 text-sm">

                        <a href="#escola" class="hover:text-laranja">
                            A Escola
                        </a>

                        <a href="#ensino" class="hover:text-laranja">
                            Ensino
                        </a>

                        <a href="#cursos" class="hover:text-laranja">
                            Cursos
                        </a>

                        <a href="#feiras" class="hover:text-laranja">
                            Feiras
                        </a>

                    </div>

                </div>

            </div>


            <div class="mt-10 border-t border-white/10 pt-5 text-center text-xs">

                © 2026 EscolaTech — Ensino Médio

            </div>

        </div>

    </footer>



    <!-- ================= VLibras ================= -->

    <div vw class="enabled">

        <div
            vw-access-button
            class="active">
        </div>

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
```
