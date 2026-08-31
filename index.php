<!DOCTYPE html>
<?php 
// 1. Conecta ao phpMyAdmin
include './conexao.php'; 

// 2. Processa o envio se o formulário for submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = mysqli_real_escape_string($conexao, $_POST['titulo']);
    $categoria = mysqli_real_escape_string($conexao, $_POST['categoria']);
    $texto = mysqli_real_escape_string($conexao, $_POST['texto']);

    if (!empty($titulo) && !empty($categoria) && !empty($texto)) {
        $sql = "INSERT INTO feedbacks (titulo, categoria, texto) VALUES ('$titulo', '$categoria', '$texto')";
        if ($conexao->query($sql) === TRUE) {
            header("Location: index.php#feedbacks");
            exit();
        }
    }
}

// 3. Puxa os feedbacks para renderizar na listagem lateral
$resultado_feedbacks = $conexao->query("SELECT * FROM feedbacks ORDER BY data_criacao DESC");
?>
<html lang="pt-BR" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ensino Médio Integrado - Sesc Senac Caiobá</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/tailwind.config.js"></script>
</head>

<?php include './includes/header.php'; ?>

<body class="bg-white text-slate-800">

    <!-- início -->
    <section class="min-h-[calc(100vh-73px)] flex flex-col justify-center relative overflow-hidden bg-azul px-5 py-24 text-white">

        <div class="absolute -right-24 -top-24 h-80 w-80 rounded-full bg-laranja/10"></div>
        <div class="absolute -bottom-40 -left-20 h-96 w-96 rounded-full bg-blue-300/10"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-14 lg:grid-cols-2">

            <div>
                <span class="inline-block rounded-full border border-white/10 bg-white/10 px-4 py-2 text-sm font-semibold text-orange-200">
                    Ensino Médio Integrado ao Técnico
                </span>

                <h1 class="mt-6 text-5xl font-black leading-tight md:text-6xl">
                    Formação completa em
                    <span class="text-laranja">Caiobá.</span>
                </h1>

                <p class="mt-6 max-w-xl text-lg leading-8 text-blue-100">
                    No Sesc Senac Caiobá, o Ensino Médio é integrado ao curso Técnico em
                    Informática para Internet, unindo formação geral, tecnologia e preparação
                    para o mundo do trabalho.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a
                        href="#escola"
                        class="rounded-xl bg-laranja px-6 py-3 font-bold transition hover:bg-laranjaEscuro">
                        Conheça a unidade
                    </a>

                </div>

                <div class="mt-12 grid max-w-xl grid-cols-3 gap-5 border-t border-white/15 pt-6">
                    <div>
                        <strong class="text-2xl text-laranja">3 anos</strong>
                        <p class="mt-1 text-xs text-blue-200">Duração do curso</p>
                    </div>

                    <div>
                        <strong class="text-2xl text-laranja">3.200 h</strong>
                        <p class="mt-1 text-xs text-blue-200">Carga horária total</p>
                    </div>

                    <div>
                        <strong class="text-2xl text-laranja">Presencial</strong>
                        <p class="mt-1 text-xs text-blue-200">Modalidade</p>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white p-2 shadow-2xl">
                <div class="aspect-video overflow-hidden rounded-xl">
                    <iframe
                        class="h-full w-full"
                        src="https://www.youtube.com/embed/5tvsNooQGDw"
                        title="Ensino Médio Integrado ao Técnico Sesc Senac PR"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>

        </div>
    </section>

    <!-- sobre -->
    <section id="escola" class="min-h-[calc(100vh-73px)] flex flex-col justify-center scroll-mt-[73px] px-5 py-20">

        <div class="mx-auto grid max-w-7xl items-center gap-12 lg:grid-cols-2">

            <div class="overflow-hidden rounded-2xl shadow-xl">
                <img
                    src="./img/iscola.png"
                    alt="Estudante do Ensino Médio Integrado Sesc Senac em laboratório de informática"
                    class="h-[420px] w-full object-cover">
            </div>

            <div>
                <span class="text-sm font-bold uppercase tracking-wider text-laranja">
                    Sesc Senac Caiobá
                </span>

                <h2 class="mt-3 text-4xl font-black text-azul">
                    Ensino Médio e formação técnica no mesmo percurso
                </h2>

                <p class="mt-6 leading-8 text-slate-500">
                    A unidade de Caiobá, em Matinhos, oferece o Técnico em Informática para Internet
                    integrado ao Ensino Médio. Ao longo dos três anos, o estudante desenvolve a
                    formação da Educação Básica junto com competências profissionais da área de tecnologia.
                </p>

                <p class="mt-4 leading-8 text-slate-500">
                    A proposta valoriza o protagonismo dos estudantes, o contato com a prática profissional,
                    o preparo para vestibulares e Enem e uma formação crítica, criativa e responsável.
                </p>

                <div class="mt-6 rounded-xl bg-fundo p-5">
                    <p class="text-sm font-bold text-azul">Unidade Sesc Caiobá</p>
                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        Rua Dr. José Pinto Rebelo Júnior, 91 — Caiobá, Matinhos/PR.
                    </p>
                </div>

                <a
                    href="#ensino"
                    class="mt-7 inline-block rounded-lg bg-azul px-6 py-3 font-bold text-white transition hover:bg-azul2">
                    Veja como funciona
                </a>
            </div>

        </div>
    </section>

    <!-- objetivo e diferenciais -->
    <section class="min-h-[calc(100vh-73px)] flex flex-col justify-center bg-fundo px-5 py-20">

        <div class="mx-auto max-w-7xl">

            <div class="text-center">
                <span class="inline-block rounded-full bg-orange-100 px-4 py-2 text-xs font-bold text-laranjaEscuro">
                    Proposta educacional
                </span>

                <h2 class="mt-4 text-4xl font-black text-azul">
                    Objetivo do programa
                </h2>

                <p class="mx-auto mt-4 max-w-3xl leading-7 text-slate-500">
                    A formação busca desenvolver cidadania, acesso à cultura, crescimento pessoal e
                    preparação profissional, fortalecendo competências socioemocionais e o protagonismo juvenil.
                </p>
            </div>

            <div class="mt-12 grid gap-6 lg:grid-cols-2">

                <div class="rounded-3xl bg-azul p-10 text-white">
                    <span class="text-sm font-bold uppercase tracking-wider text-orange-300">
                        Formação integral
                    </span>

                    <h3 class="mt-4 text-3xl font-black">
                        Aprender, participar e se preparar para novos caminhos.
                    </h3>

                    <p class="mt-5 leading-8 text-blue-100">
                        O currículo integra conhecimentos do Ensino Médio e da Educação Profissional,
                        estimulando uma participação ativa, crítica, criativa e responsável na sociedade.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="rounded-2xl bg-white p-7 shadow-sm">
                        <div class="h-1 w-10 bg-laranja"></div>
                        <h3 class="mt-5 font-black text-azul">Protagonismo</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            O estudante participa ativamente do próprio processo de aprendizagem.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white p-7 shadow-sm">
                        <div class="h-1 w-10 bg-laranja"></div>
                        <h3 class="mt-5 font-black text-azul">Cidadania</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Formação humana conectada à cultura, ao senso coletivo e à sociedade.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white p-7 shadow-sm">
                        <div class="h-1 w-10 bg-laranja"></div>
                        <h3 class="mt-5 font-black text-azul">Prática</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Contato direto com atividades e conhecimentos da formação profissional.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white p-7 shadow-sm">
                        <div class="h-1 w-10 bg-laranja"></div>
                        <h3 class="mt-5 font-black text-azul">Futuro</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Preparação para vestibulares, Enem e possibilidades no mercado de trabalho.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ensino -->
    <section id="ensino" class="min-h-[calc(100vh-73px)] flex flex-col justify-center scroll-mt-[73px] px-5 py-20">

        <div class="mx-auto max-w-7xl">

            <div class="max-w-3xl">
                <span class="text-sm font-bold uppercase tracking-wider text-laranja">
                    Como funciona
                </span>

                <h2 class="mt-3 text-4xl font-black text-azul">
                    Ensino integrado e aprendizagem na prática
                </h2>

                <p class="mt-5 leading-8 text-slate-500">
                    O programa combina o currículo do Ensino Médio com a formação técnica e utiliza
                    estratégias que aproximam teoria, projetos, pesquisa e situações profissionais.
                </p>
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-3">

                <article class="group overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="overflow-hidden">
                        <img src="./img/ensino-medio-integrado-sesc-pr.jpg" alt="" class="h-52 w-full object-cover transition duration-300 group-hover:scale-105">
                    </div>
                    <div class="p-8">
                        <span class="text-xs font-bold uppercase tracking-wider text-laranja"> 01</span>
                        <h3 class="mt-3 text-xl font-black text-azul"> Ensino Médio </h3>
                        <p class="mt-3 text-sm leading-7 text-slate-500">
                            Formação geral com os componentes da Educação Básica e preparação para osprincipais vestibulares e Enem.</p>
                    </div>
                </article>

                <article class="group overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="overflow-hidden">
                        <img src="./img/informaticaaa.png" alt="" class="h-52 w-full object-cover transition duration-300 group-hover:scale-105">
                    </div>
                    <div class="p-8">
                        <span class="text-xs font-bold uppercase tracking-wider text-laranja">02</span>
                        <h3 class="mt-3 text-xl font-black text-azul">Formação técnica</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-500">
                        Conteúdos profissionais de Informática para Internet desenvolvidos junto ao percurso do Ensino Médio.
                        </p>
                    </div>
                </article>

                <article class="group overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="overflow-hidden">
                        <img src="./img/ZOOLITO.jpg" alt="" class="h-52 w-full object-cover transition duration-300 group-hover:scale-105">
                    </div>
                    <div class="p-8">
                        <span class="text-xs font-bold uppercase tracking-wider text-laranja">03</span>
                        <h3 class="mt-3 text-xl font-black text-azul">Metodologias ativas</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-500">
                        Projetos, atividades interdisciplinares e experiências que colocam o aluno como participante do processo de aprendizagem.
                        </p>
                    </div>
                </article>

            </div>
        </div>
    </section>

    <!-- curso técnico -->
    <section id="cursos" class="min-h-[calc(100vh-73px)] flex flex-col justify-center scroll-mt-[73px] bg-fundo px-5 py-20">

        <div class="mx-auto max-w-7xl">

            <div class="text-center">
                <span class="text-sm font-bold uppercase tracking-wider text-laranja">
                    Formação profissional em Caiobá
                </span>

                <h2 class="mt-3 text-4xl font-black text-azul">
                    Técnico em Informática para Internet
                </h2>

                <p class="mx-auto mt-4 max-w-3xl leading-7 text-slate-500">
                    Em Caiobá, esta é a formação técnica integrada ao Ensino Médio. O curso desenvolve
                    competências para criar e colocar aplicações para internet em funcionamento.
                </p>
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-4">

                <article class="rounded-2xl bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <span class="text-xs font-bold uppercase tracking-wider text-laranja">Planejamento</span>
                    <h3 class="mt-3 text-xl font-black text-azul">Estruturar</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        Organizar a estrutura e os elementos necessários para aplicações web.
                    </p>
                </article>

                <article class="rounded-2xl bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <span class="text-xs font-bold uppercase tracking-wider text-laranja">Desenvolvimento</span>
                    <h3 class="mt-3 text-xl font-black text-azul">Codificar</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        Desenvolver soluções para internet utilizando conhecimentos de programação.
                    </p>
                </article>

                <article class="rounded-2xl bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <span class="text-xs font-bold uppercase tracking-wider text-laranja">Web</span>
                    <h3 class="mt-3 text-xl font-black text-azul">Publicar</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        Preparar e disponibilizar aplicações para uso em ambientes de internet.
                    </p>
                </article>

                <article class="rounded-2xl bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <span class="text-xs font-bold uppercase tracking-wider text-laranja">Qualidade</span>
                    <h3 class="mt-3 text-xl font-black text-azul">Testar</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        Verificar o funcionamento das aplicações e identificar possíveis melhorias.
                    </p>
                </article>

            </div>
        </div>
    </section>

    <!-- projetos -->
    <section id="feiras" class="min-h-[calc(100vh-73px)] flex flex-col justify-center scroll-mt-[73px] px-5 py-20">

        <div class="mx-auto max-w-7xl">


        <div class="mx-auto max-w-7xl">

            <div class="grid items-center gap-12 lg:grid-cols-2">

                <div>
                    <span class="text-sm font-bold uppercase tracking-wider text-laranja">
                        Projetos reais de Caiobá
                    </span>

                    <h2 class="mt-3 text-4xl font-black text-azul">
                        Ciência, tecnologia e realidade local
                    </h2>

                    <p class="mt-5 leading-8 text-slate-500">
                        Em 2025, estudantes do Sesc Senac Caiobá/Matinhos participaram de feiras e
                        eventos científicos com trabalhos ligados à tecnologia, história, inclusão,
                        meio ambiente e cultura regional.
                    </p>

                    <div class="mt-7 space-y-4">
                        <div class="border-l-4 border-laranja pl-4">
                            <h3 class="font-bold text-azul">Inovação e Inclusão</h3>
                            <p class="mt-1 text-sm leading-6 text-slate-500">
                                Projeto de modelagem e impressão 3D para acessibilidade em museus,
                                vencedor do 1º lugar em Tecnologia no Concurso Sementes do Futuro.
                            </p>
                        </div>

                        <div class="border-l-4 border-laranja pl-4">
                            <h3 class="font-bold text-azul">Terra Indígena Yanomami</h3>
                            <p class="mt-1 text-sm leading-6 text-slate-500">
                                Pesquisa sobre os impactos do garimpo ilegal, reconhecida com Menção
                                Honrosa da Funai na FECCI.
                            </p>
                        </div>

                        <div class="border-l-4 border-laranja pl-4">
                            <h3 class="font-bold text-azul">Arqueologia Digital</h3>
                            <p class="mt-1 text-sm leading-6 text-slate-500">
                                Trabalho com modelagem e impressão 3D de zoólitos, conectado à história
                                e ao patrimônio do litoral paranaense.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <img
                        src="./img/feira-cientifica-sesc-senac.jpg"
                        alt="Participantes do Sesc Senac em evento científico"
                        class="h-80 w-full rounded-2xl object-cover">

                    <img
                        src="./img/sesc-senac-evento-cientifico.jpeg"
                        alt="Representantes do Sesc e Senac em evento científico"
                        class="mt-10 h-80 w-full rounded-2xl object-cover">
                </div>

            </div>
        </div>
    </section>

    <!-- espaços e vivências -->
    <section id="clubes" class="min-h-[calc(100vh-73px)] flex flex-col justify-center scroll-mt-[73px] bg-fundo px-5 py-20">

        <div class="mx-auto max-w-7xl">

            <div class="text-center">
                <span class="text-sm font-bold uppercase tracking-wider text-laranja">
                    Estrutura e vida escolar
                </span>

                <h2 class="mt-3 text-4xl font-black text-azul">
                    Espaços para aprender além da sala de aula
                </h2>

                <p class="mx-auto mt-4 max-w-2xl text-slate-500">
                    O programa conta com estrutura educacional e os estudantes também convivem com
                    diferentes espaços e serviços da unidade Sesc Caiobá.
                </p>
            </div>

            <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-4">

                <div class="border-l-4 border-laranja bg-white p-7 shadow-sm">
                    <h3 class="font-black text-azul">Biblioteca</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        Acesso a acervo físico e digital para estudo, pesquisa e leitura.
                    </p>
                </div>

                <div class="border-l-4 border-laranja bg-white p-7 shadow-sm">
                    <h3 class="font-black text-azul">Laboratório</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        Ambiente de informática voltado às atividades e à formação técnica.
                    </p>
                </div>

                <div class="border-l-4 border-laranja bg-white p-7 shadow-sm">
                    <h3 class="font-black text-azul">Ginásio</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        Espaço esportivo utilizado em práticas, integração e eventos escolares.
                    </p>
                </div>

                <div class="border-l-4 border-laranja bg-white p-7 shadow-sm">
                    <h3 class="font-black text-azul">Cine Sereia</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        Espaço cultural da unidade Sesc Caiobá, ampliando o contato com arte e cultura.
                    </p>
                </div>

            </div>
        </div>
    </section>


        <!-- feedbacks anônimos -->
    <section id="feedbacks" class="min-h-[calc(100vh-73px)] flex flex-col justify-center scroll-mt-[73px] bg-white px-5 py-20">

        <div class="mx-auto w-full max-w-7xl">

            <div class="grid items-start gap-12 lg:grid-cols-[0.9fr_1.1fr]">

                <!-- apresentação e formulário -->
                <div class="lg:sticky lg:top-28">
                    <span class="text-sm font-bold uppercase tracking-wider text-laranja">
                        Voz dos estudantes
                    </span>

                    <h2 class="mt-3 text-4xl font-black leading-tight text-azul md:text-5xl">
                        Mural de feedbacks anônimos
                    </h2>

                    <p class="mt-5 max-w-xl leading-8 text-slate-500">
                        Um espaço para compartilhar opiniões, sugestões e experiências sobre a rotina escolar.
                        Os feedbacks são exibidos sem identificação do autor.
                    </p>

                    <!-- Alterado: método POST e destino para o próprio index.php -->
                    <form action="index.php" method="POST" class="mt-8 rounded-3xl bg-fundo p-6 shadow-sm ring-1 ring-slate-100 md:p-8">
                        <div>
                            <label for="feedback-titulo" class="text-sm font-bold text-azul">
                                Título do feedback
                            </label>
                            <!-- Alterado: adicionado o name="titulo" e validação required -->
                            <input
                                id="feedback-titulo"
                                name="titulo"
                                type="text"
                                maxlength="70"
                                required
                                placeholder="Ex.: Uma sugestão para os intervalos"
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-laranja focus:ring-4 focus:ring-orange-100">
                        </div>

                        <div class="mt-5">
                            <label for="feedback-categoria" class="text-sm font-bold text-azul">
                                Categoria
                            </label>
                            <!-- Alterado: adicionado o name="categoria" e os values em cada option -->
                            <select
                                id="feedback-categoria"
                                name="categoria"
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-laranja focus:ring-4 focus:ring-orange-100">
                                <option value="Ensino">Ensino</option>
                                <option value="Estrutura">Estrutura</option>
                                <option value="Projetos">Projetos</option>
                                <option value="Convivência">Convivência</option>
                                <option value="Sugestão">Sugestão</option>
                            </select>
                        </div>

                        <div class="mt-5">
                            <label for="feedback-texto" class="text-sm font-bold text-azul">
                                Seu feedback
                            </label>
                            <!-- Alterado: adicionado o name="texto" e validação required -->
                            <textarea
                                id="feedback-texto"
                                name="texto"
                                rows="5"
                                maxlength="500"
                                required
                                placeholder="Escreva sua opinião, sugestão ou experiência..."
                                class="mt-2 w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm leading-6 outline-none transition focus:border-laranja focus:ring-4 focus:ring-orange-100"></textarea>
                        </div>

                        <div class="mt-5 flex items-start gap-3 rounded-xl bg-white p-4">
                            <div class="mt-0.5 grid h-8 w-8 shrink-0 place-items-center rounded-full bg-orange-100 text-laranja">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>

                            </div>
                            <p class="text-xs leading-5 text-slate-500">
                                Sua identidade não será exibida junto ao feedback. Evite colocar dados pessoais na mensagem.
                            </p>
                        </div>

                        <!-- Alterado: tipo alterado para "submit" para disparar a requisição PHP -->
                        <button
                            type="submit"
                            class="mt-6 w-full rounded-xl bg-azul px-6 py-3.5 font-bold text-white transition hover:bg-azul2">
                            Enviar feedback anônimo
                        </button>
                    </form>
                </div>

                <!-- publicações dinâmicas vindas do phpMyAdmin -->
                <div>
                    <div class="flex flex-wrap items-end justify-between gap-4 border-b border-slate-200 pb-5">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">
                                Publicações recentes
                            </p>
                            <h3 class="mt-2 text-2xl font-black text-azul">
                                O que os estudantes estão dizendo
                            </h3>
                        </div>

                        <span class="rounded-full bg-fundo px-4 py-2 text-xs font-bold text-slate-500">
                            Feedbacks anônimos
                        </span>
                    </div>

                    <div class="mt-7 space-y-5">
                        <?php 
                        // Loop que percorre e renderiza os feedbacks salvos no banco de dados
                        if (isset($resultado_feedbacks) && $resultado_feedbacks->num_rows > 0): 
                            while($row = $resultado_feedbacks->fetch_assoc()): 
                                // Converte e formata a data armazenada pelo servidor MySQL
                                $data_formatada = date('d/m/Y H:i', strtotime($row['data_criacao']));
                                
                                // Define dinamicamente a cor da tag com base na categoria
                                $cor_tag = "bg-orange-100 text-laranjaEscuro";
                                if ($row['categoria'] === 'Ensino') { $cor_tag = "bg-blue-50 text-azul"; }
                                elseif ($row['categoria'] === 'Estrutura') { $cor_tag = "bg-emerald-50 text-emerald-700"; }
                        ?>
                            <article class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg md:p-7">
                                <div class="flex items-center justify-between gap-4">
                                    <span class="rounded-full px-3 py-1 text-xs font-bold <?php echo $cor_tag; ?>">
                                        <?php echo htmlspecialchars($row['categoria']); ?>
                                    </span>
                                    <span class="text-xs text-slate-400">Anônimo • <?php echo $data_formatada; ?></span>
                                </div>

                                <h4 class="mt-5 text-xl font-black text-azul">
                                    <?php echo htmlspecialchars($row['titulo']); ?>
                                </h4>

                                <p class="mt-3 leading-7 text-slate-500 whitespace-pre-line">
                                    <?php echo htmlspecialchars($row['texto']); ?>
                                </p>

                                <div class="mt-5 border-t border-slate-100 pt-4 text-xs font-semibold text-slate-400">
                                    Comunidade escolar
                                </div>
                            </article>
                        <?php 
                            endwhile; 
                        else: 
                        ?>
                            <!-- Card substituto exibido caso a tabela do banco esteja vazia -->
                            <div class="rounded-2xl border border-dashed border-slate-200 p-10 text-center">
                                <p class="text-sm italic text-slate-400">
                                    Nenhum feedback publicado ainda. Seja o primeiro a compartilhar sua experiência!
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <?php include './includes/footer.php'; ?>


    <!-- libras -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script src="./js/libras.js"></script>

</body>
</html>
