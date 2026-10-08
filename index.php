
<?php
session_start();

require_once __DIR__ . '/conexao.php';

/*
|--------------------------------------------------------------------------
| Conteúdo editável
|--------------------------------------------------------------------------
*/

$conteudosSite = [];

$resultadoConteudos = $conexao->query(
    "SELECT chave, valor FROM conteudos_site"
);

if ($resultadoConteudos) {
    while ($linha = $resultadoConteudos->fetch_assoc()) {
        $conteudosSite[$linha['chave']] = $linha['valor'];
    }
}

/*
|--------------------------------------------------------------------------
| Textos e imagens
|--------------------------------------------------------------------------
*/

function conteudoSite(string $chave, string $padrao = ''): string
{
    global $conteudosSite;

    return $conteudosSite[$chave] ?? $padrao;
}

function imagemSite(string $chave, string $padrao): string
{
    $imagem = conteudoSite($chave, $padrao);

    // Aceita somente caminhos relativos de imagens do próprio site.
    if (
        !preg_match(
            '~^\.?/img/[a-zA-Z0-9_./-]+\.(jpg|jpeg|png|webp|gif)$~i',
            $imagem
        ) ||
        str_contains($imagem, '..')
    ) {
        return $padrao;
    }

    return $imagem;
}

/*
|--------------------------------------------------------------------------
| Exibição segura de texto com cores personalizadas
|--------------------------------------------------------------------------
| O editor pode salvar formatação como:
| <span style="color:#F58220">Texto colorido</span>
*/

function textoSite(string $chave, string $padrao = ''): string
{
    $texto = conteudoSite($chave, $padrao);

    // Escapa todo o conteúdo antes de permitir formatação segura.
    $texto = htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');

    // Permite somente a formatação de cor criada pelo editor.
    $texto = preg_replace_callback(
        '~&lt;span\s+style=&quot;color:\s*(#[0-9a-fA-F]{6});?&quot;&gt;(.*?)&lt;/span&gt;~is',
        static function ($match) {
            return '<span style="color:' .
                $match[1] .
                '">' .
                $match[2] .
                '</span>';
        },
        $texto
    );

    // Permite quebras de linha sem permitir HTML arbitrário.
    return nl2br($texto, false);
}

function hSite(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

/*
|--------------------------------------------------------------------------
| Envio de feedback
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $texto = trim($_POST['texto'] ?? '');

    $categoriasPermitidas = [
        'Ensino',
        'Estrutura',
        'Projetos',
        'Convivência',
        'Sugestão'
    ];

    if (
        $titulo !== '' &&
        $texto !== '' &&
        in_array($categoria, $categoriasPermitidas, true) &&
        mb_strlen($titulo, 'UTF-8') <= 70 &&
        mb_strlen($texto, 'UTF-8') <= 500
    ) {
        $stmt = $conexao->prepare(
            "INSERT INTO feedbacks
                (titulo, categoria, texto, status, arquivado)
             VALUES (?, ?, ?, 'pendente', 0)"
        );

        $stmt->bind_param('sss', $titulo, $categoria, $texto);

        if ($stmt->execute()) {
            $stmt->close();

            header('Location: index.php#feedbacks');
            exit;
        }

        $stmt->close();
    }

    header('Location: index.php#feedbacks');
    exit;
}

/*
|--------------------------------------------------------------------------
| Feedbacks aprovados
|--------------------------------------------------------------------------
*/

$resultado_feedbacks = $conexao->query(
    "SELECT *
     FROM feedbacks
     WHERE status = 'aprovado'
       AND arquivado = 0
     ORDER BY data_criacao DESC"
);

$feedbacksCarrossel = [];

if ($resultado_feedbacks) {
    while ($linha = $resultado_feedbacks->fetch_assoc()) {
        $feedbacksCarrossel[] = $linha;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ensino Médio Integrado - Sesc Senac Caiobá</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/tailwind.config.js"></script>

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >
</head>

<?php include './includes/header.php'; ?>

<body class="bg-white text-slate-800">

<!-- INÍCIO -->
<section class="relative flex min-h-[calc(100vh-73px)] flex-col justify-center overflow-hidden bg-azul px-5 py-24 text-white">

    <div class="absolute -right-24 -top-24 h-80 w-80 rounded-full bg-laranja/10"></div>
    <div class="absolute -bottom-40 -left-20 h-96 w-96 rounded-full bg-blue-300/10"></div>

    <div class="relative mx-auto grid max-w-7xl items-center gap-14 lg:grid-cols-2">

        <div>
            <span class="inline-block rounded-full border border-white/10 bg-white/10 px-4 py-2 text-sm font-semibold text-orange-200">
                <?= textoSite('inicio_etiqueta', 'Ensino Médio Integrado ao Técnico') ?>
            </span>

            <h1 class="mt-6 text-5xl font-black leading-tight md:text-6xl">
                <?= textoSite('inicio_titulo', 'Formação completa em Caiobá.') ?>
            </h1>

            <p class="mt-6 max-w-xl text-lg leading-8 text-blue-100">
                <?= textoSite(
                    'inicio_descricao',
                    'No Sesc Senac Caiobá, o Ensino Médio é integrado ao curso Técnico em Informática para Internet, unindo formação geral, tecnologia e preparação para o mundo do trabalho.'
                ) ?>
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
                <a
                    href="#escola"
                    class="rounded-xl bg-laranja px-6 py-3 font-bold transition hover:bg-laranjaEscuro"
                >
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
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen
                ></iframe>
            </div>
        </div>

    </div>
</section>

<!-- ESCOLA -->
<section id="escola" class="flex min-h-[calc(100vh-73px)] scroll-mt-[73px] flex-col justify-center px-5 py-20">

    <div class="mx-auto grid max-w-7xl items-center gap-12 lg:grid-cols-2">

        <div id="carousel-escola" class="group relative overflow-hidden rounded-2xl shadow-xl">
            <div class="relative h-[420px]">

                <?php
                $imagensEscola = [
                    ['imagem_escola_1', './img/iscola.png', 'Unidade Sesc Senac Caiobá'],
                    ['imagem_escola_2', './img/volei-sesc.png', 'Atividade esportiva no ginásio'],
                    ['imagem_escola_3', './img/formatura-sesc.png', 'Formatura dos estudantes'],
                    ['imagem_escola_4', './img/fachada-sesc.png', 'Fachada da unidade']
                ];
                ?>

                <?php foreach ($imagensEscola as $i => $imagem): ?>
                    <img
                        src="<?= hSite(imagemSite($imagem[0], $imagem[1])) ?>"
                        alt="<?= hSite($imagem[2]) ?>"
                        class="carousel-slide absolute inset-0 h-full w-full object-cover transition-opacity duration-700 <?= $i === 0 ? 'opacity-100' : 'opacity-0' ?>"
                    >
                <?php endforeach; ?>

            </div>

            <button
                type="button"
                id="carousel-prev"
                aria-label="Imagem anterior"
                class="absolute left-4 top-1/2 grid h-11 w-11 -translate-y-1/2 place-items-center rounded-full bg-black/35 text-2xl text-white opacity-0 transition hover:bg-black/55 group-hover:opacity-100"
            >
                <i class="bi bi-chevron-left"></i>
            </button>

            <button
                type="button"
                id="carousel-next"
                aria-label="Próxima imagem"
                class="absolute right-4 top-1/2 grid h-11 w-11 -translate-y-1/2 place-items-center rounded-full bg-black/35 text-2xl text-white opacity-0 transition hover:bg-black/55 group-hover:opacity-100"
            >
                <i class="bi bi-chevron-right"></i>
            </button>

            <div class="absolute bottom-4 left-1/2 flex -translate-x-1/2 gap-2">
                <?php for ($i = 0; $i < 4; $i++): ?>
                    <button
                        type="button"
                        aria-label="Ir para imagem <?= $i + 1 ?>"
                        class="carousel-dot h-2.5 rounded-full transition <?= $i === 0 ? 'w-8 bg-white' : 'w-2.5 bg-white/50' ?>"
                    ></button>
                <?php endfor; ?>
            </div>
        </div>

        <div>
            <span class="text-sm font-bold uppercase tracking-wider text-laranja">
                Sesc Senac Caiobá
            </span>

            <h2 class="mt-3 text-4xl font-black text-azul">
                <?= textoSite(
                    'escola_titulo',
                    'Ensino Médio e formação técnica no mesmo percurso'
                ) ?>
            </h2>

            <p class="mt-6 leading-8 text-slate-500">
                <?= textoSite(
                    'escola_descricao',
                    'A unidade de Caiobá, em Matinhos, oferece o Técnico em Informática para Internet integrado ao Ensino Médio. Ao longo dos três anos, o estudante desenvolve a formação da Educação Básica junto com competências profissionais da área de tecnologia.'
                ) ?>
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
                class="mt-7 inline-block rounded-lg bg-azul px-6 py-3 font-bold text-white transition hover:bg-azul2"
            >
                Veja como funciona
            </a>
        </div>

    </div>
</section>

<!-- OBJETIVO E DIFERENCIAIS -->
<section class="flex min-h-[calc(100vh-73px)] flex-col justify-center bg-fundo px-5 py-20">

    <div class="mx-auto max-w-7xl">

        <div class="text-center">
            <span class="inline-block rounded-full bg-orange-100 px-4 py-2 text-xs font-bold text-laranjaEscuro">
                Proposta educacional
            </span>

            <h2 class="mt-4 text-4xl font-black text-azul">
                <?= textoSite('objetivo_titulo', 'Objetivo do programa') ?>
            </h2>

            <p class="mx-auto mt-4 max-w-3xl leading-7 text-slate-500">
                <?= textoSite(
                    'objetivo_descricao',
                    'A formação busca desenvolver cidadania, acesso à cultura, crescimento pessoal e preparação profissional, fortalecendo competências socioemocionais e o protagonismo juvenil.'
                ) ?>
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
                <?php
                $diferenciais = [
                    ['Protagonismo', 'O estudante participa ativamente do próprio processo de aprendizagem.'],
                    ['Cidadania', 'Formação humana conectada à cultura, ao senso coletivo e à sociedade.'],
                    ['Prática', 'Contato direto com atividades e conhecimentos da formação profissional.'],
                    ['Futuro', 'Preparação para vestibulares, Enem e possibilidades no mercado de trabalho.']
                ];
                ?>

                <?php foreach ($diferenciais as $diferencial): ?>
                    <div class="rounded-2xl bg-white p-7 shadow-sm">
                        <div class="h-1 w-10 bg-laranja"></div>
                        <h3 class="mt-5 font-black text-azul">
                            <?= hSite($diferencial[0]) ?>
                        </h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            <?= hSite($diferencial[1]) ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>

<!-- ENSINO -->
<section id="ensino" class="flex min-h-[calc(100vh-73px)] scroll-mt-[73px] flex-col justify-center px-5 py-20">

    <div class="mx-auto max-w-7xl">

        <div class="max-w-3xl">
            <span class="text-sm font-bold uppercase tracking-wider text-laranja">
                Como funciona
            </span>

            <h2 class="mt-3 text-4xl font-black text-azul">
                <?= textoSite(
                    'ensino_titulo',
                    'Ensino integrado e aprendizagem na prática'
                ) ?>
            </h2>

            <p class="mt-5 leading-8 text-slate-500">
                O programa combina o currículo do Ensino Médio com a formação técnica e utiliza
                estratégias que aproximam teoria, projetos, pesquisa e situações profissionais.
            </p>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-3">

            <?php
            $cardsEnsino = [
                [
                    'imagem_ensino_1',
                    './img/ensino-medio-integrado-sesc-pr.jpg',
                    '01',
                    'Ensino Médio',
                    'Formação geral com os componentes da Educação Básica e preparação para os principais vestibulares e Enem.'
                ],
                [
                    'imagem_ensino_2',
                    './img/informaticaaa.png',
                    '02',
                    'Formação técnica',
                    'Conteúdos profissionais de Informática para Internet desenvolvidos junto ao percurso do Ensino Médio.'
                ],
                [
                    'imagem_ensino_3',
                    './img/ZOOLITO.jpg',
                    '03',
                    'Metodologias ativas',
                    'Projetos, atividades interdisciplinares e experiências que colocam o aluno como participante do processo de aprendizagem.'
                ]
            ];
            ?>

            <?php foreach ($cardsEnsino as $card): ?>
                <article class="group overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="overflow-hidden">
                        <img
                            src="<?= hSite(imagemSite($card[0], $card[1])) ?>"
                            alt="<?= hSite($card[3]) ?>"
                            class="h-52 w-full object-cover transition duration-300 group-hover:scale-105"
                        >
                    </div>

                    <div class="p-8">
                        <span class="text-xs font-bold uppercase tracking-wider text-laranja">
                            <?= hSite($card[2]) ?>
                        </span>

                        <h3 class="mt-3 text-xl font-black text-azul">
                            <?= hSite($card[3]) ?>
                        </h3>

                        <p class="mt-3 text-sm leading-7 text-slate-500">
                            <?= hSite($card[4]) ?>
                        </p>
                    </div>
                </article>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<!-- CURSO TÉCNICO -->
<section id="cursos" class="flex min-h-[calc(100vh-73px)] scroll-mt-[73px] flex-col justify-center bg-fundo px-5 py-20">

    <div class="mx-auto max-w-7xl">

        <div class="text-center">
            <span class="text-sm font-bold uppercase tracking-wider text-laranja">
                Formação profissional em Caiobá
            </span>

            <h2 class="mt-3 text-4xl font-black text-azul">
                <?= textoSite(
                    'curso_titulo',
                    'Técnico em Informática para Internet'
                ) ?>
            </h2>

            <p class="mx-auto mt-4 max-w-3xl leading-7 text-slate-500">
                Em Caiobá, esta é a formação técnica integrada ao Ensino Médio. O curso desenvolve
                competências para criar e colocar aplicações para internet em funcionamento.
            </p>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-4">

            <?php
            $etapasCurso = [
                ['Planejamento', 'Estruturar', 'Organizar a estrutura e os elementos necessários para aplicações web.'],
                ['Desenvolvimento', 'Codificar', 'Desenvolver soluções para internet utilizando conhecimentos de programação.'],
                ['Web', 'Publicar', 'Preparar e disponibilizar aplicações para uso em ambientes de internet.'],
                ['Qualidade', 'Testar', 'Verificar o funcionamento das aplicações e identificar possíveis melhorias.']
            ];
            ?>

            <?php foreach ($etapasCurso as $etapa): ?>
                <article class="rounded-2xl bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <span class="text-xs font-bold uppercase tracking-wider text-laranja">
                        <?= hSite($etapa[0]) ?>
                    </span>

                    <h3 class="mt-3 text-xl font-black text-azul">
                        <?= hSite($etapa[1]) ?>
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        <?= hSite($etapa[2]) ?>
                    </p>
                </article>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<!-- PROJETOS -->
<section id="feiras" class="flex min-h-[calc(100vh-73px)] scroll-mt-[73px] flex-col justify-center px-5 py-20">

    <div class="mx-auto max-w-7xl">

        <div class="grid items-center gap-12 lg:grid-cols-2">

            <div>
                <span class="text-sm font-bold uppercase tracking-wider text-laranja">
                    Projetos reais de Caiobá
                </span>

                <h2 class="mt-3 text-4xl font-black text-azul">
                    <?= textoSite(
                        'projetos_titulo',
                        'Ciência, tecnologia e realidade local'
                    ) ?>
                </h2>

                <p class="mt-5 leading-8 text-slate-500">
                    Em 2025, estudantes do Sesc Senac Caiobá/Matinhos participaram de feiras e
                    eventos científicos com trabalhos ligados à tecnologia, história, inclusão,
                    meio ambiente e cultura regional.
                </p>

                <?php
                $projetos = [
                    [
                        'Inovação e Inclusão',
                        'Projeto de modelagem e impressão 3D para acessibilidade em museus, vencedor do 1º lugar em Tecnologia no Concurso Sementes do Futuro.'
                    ],
                    [
                        'Terra Indígena Yanomami',
                        'Pesquisa sobre os impactos do garimpo ilegal, reconhecida com Menção Honrosa da Funai na FECCI.'
                    ],
                    [
                        'Arqueologia Digital',
                        'Trabalho com modelagem e impressão 3D de zoólitos, conectado à história e ao patrimônio do litoral paranaense.'
                    ],
                    [
                        'Cinema de Matinhos',
                        'Pesquisa sobre a história do cinema na cidade, com registro de filmes, cartazes e entrevistas.'
                    ]
                ];
                ?>

                <div class="mt-7 space-y-4">
                    <?php foreach ($projetos as $projeto): ?>
                        <div class="border-l-4 border-laranja pl-4">
                            <h3 class="font-bold text-azul">
                                <?= hSite($projeto[0]) ?>
                            </h3>
                            <p class="mt-1 text-sm leading-6 text-slate-500">
                                <?= hSite($projeto[1]) ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <img
                    src="<?= hSite(imagemSite('imagem_projetos_1', './img/feira-cientifica-sesc-senac.jpg')) ?>"
                    alt="Participantes do Sesc Senac em evento científico"
                    class="h-80 w-full rounded-2xl object-cover"
                >

                <img
                    src="<?= hSite(imagemSite('imagem_projetos_2', './img/sesc-senac-evento-cientifico.jpeg')) ?>"
                    alt="Representantes do Sesc e Senac em evento científico"
                    class="mt-10 h-80 w-full rounded-2xl object-cover"
                >
            </div>

        </div>
    </div>
</section>

<!-- ESPAÇOS ESCOLARES -->
<section id="clubes" class="flex min-h-[calc(100vh-73px)] scroll-mt-[73px] flex-col justify-center bg-fundo px-5 py-20">

    <div class="mx-auto max-w-7xl">

        <div class="text-center">
            <span class="text-sm font-bold uppercase tracking-wider text-laranja">
                Estrutura e vida escolar
            </span>

            <h2 class="mt-3 text-4xl font-black text-azul">
                <?= textoSite(
                    'espacos_titulo',
                    'Espaços para aprender além da sala de aula'
                ) ?>
            </h2>

            <p class="mx-auto mt-4 max-w-2xl text-slate-500">
                O programa conta com estrutura educacional e os estudantes também convivem com
                diferentes espaços e serviços da unidade Sesc Caiobá.
            </p>
        </div>

        <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-4">

            <?php
            $espacos = [
                ['Clube de Literatura', 'Acesso a acervo físico e digital para estudo, pesquisa e leitura.'],
                ['Clube de Ciências', 'Ambiente de informática voltado às atividades e à formação técnica.'],
                ['Esportes', 'Prática de esportes como futsal e vôlei no ginásio.'],
                ['Cine Sereia', 'Espaço cultural da unidade Sesc Caiobá, ampliando o contato com arte e cultura.']
            ];
            ?>

            <?php foreach ($espacos as $espaco): ?>
                <div class="border-l-4 border-laranja bg-white p-7 shadow-sm">
                    <h3 class="font-black text-azul">
                        <?= hSite($espaco[0]) ?>
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        <?= hSite($espaco[1]) ?>
                    </p>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<!-- FEEDBACKS -->
<section id="feedbacks" class="flex min-h-[calc(100vh-73px)] scroll-mt-[73px] flex-col justify-center bg-fundo px-5 py-20">

    <div class="mx-auto w-full max-w-7xl">

        <div class="max-w-3xl">
            <span class="text-sm font-bold uppercase tracking-wider text-laranja">
                Voz dos estudantes
            </span>

            <h2 class="mt-3 text-4xl font-black leading-tight text-azul md:text-5xl">
                O que os estudantes estão dizendo
            </h2>

            <p class="mt-5 leading-8 text-slate-500">
                Confira opiniões, sugestões e experiências compartilhadas pelos estudantes.
                Os feedbacks publicados são exibidos de forma anônima.
            </p>
        </div>

        <div class="relative mt-10">

            <div id="feedbackViewport" class="overflow-hidden">
                <div id="feedbackTrack" class="flex gap-4 transition-transform duration-500 ease-out">

                    <?php if (count($feedbacksCarrossel) > 0): ?>

                        <?php foreach ($feedbacksCarrossel as $row): ?>

                            <?php
                            $dataFormatada = date(
                                'd/m/Y H:i',
                                strtotime($row['data_criacao'])
                            );

                            $corTag = 'bg-orange-100 text-laranjaEscuro';

                            if ($row['categoria'] === 'Ensino') {
                                $corTag = 'bg-blue-50 text-azul';
                            } elseif ($row['categoria'] === 'Estrutura') {
                                $corTag = 'bg-emerald-50 text-emerald-700';
                            }
                            ?>

                            <article class="feedback-card min-w-0 flex-[0_0_100%] rounded-2xl border border-slate-200 border-t-4 border-t-laranja bg-white p-7 text-slate-700 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg sm:flex-[0_0_calc(50%-0.5rem)] xl:flex-[0_0_calc(25%-0.75rem)]">

                                <div class="flex h-full min-h-[310px] flex-col">

                                    <div class="flex items-center justify-between gap-3">
                                        <span class="rounded-full px-3 py-1 text-xs font-bold <?= $corTag ?>">
                                            <?= hSite($row['categoria']) ?>
                                        </span>

                                        <span class="text-xs font-medium text-slate-400">
                                            Anônimo
                                        </span>
                                    </div>

                                    <h3 class="mt-7 text-xl font-black text-azul">
                                        <?= hSite($row['titulo']) ?>
                                    </h3>

                                    <p class="mt-4 flex-1 whitespace-pre-line leading-7 text-slate-600">
                                        <?= hSite($row['texto']) ?>
                                    </p>

                                    <div class="mt-6 border-t border-slate-100 pt-4 text-xs font-semibold text-slate-400">
                                        Comunidade escolar • <?= hSite($dataFormatada) ?>
                                    </div>

                                </div>
                            </article>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <article class="w-full rounded-2xl border border-dashed border-slate-200 bg-white p-10 text-center">
                            <p class="text-sm italic text-slate-400">
                                Nenhum feedback publicado ainda. Seja o primeiro a compartilhar sua experiência!
                            </p>
                        </article>

                    <?php endif; ?>

                </div>
            </div>

            <?php if (count($feedbacksCarrossel) > 1): ?>
                <div id="controlesFeedback" class="mt-7 flex items-center justify-end gap-3">

                    <button
                        type="button"
                        id="feedbackAnterior"
                        aria-label="Feedback anterior"
                        class="grid h-11 w-11 place-items-center rounded-full border border-slate-200 bg-white text-xl text-azul shadow-sm transition hover:border-laranja hover:bg-orange-50 hover:text-laranja"
                    >
                        <i class="bi bi-chevron-left"></i>
                    </button>

                    <button
                        type="button"
                        id="feedbackProximo"
                        aria-label="Próximo feedback"
                        class="grid h-11 w-11 place-items-center rounded-full bg-azul text-xl text-white shadow-sm transition hover:bg-azul2"
                    >
                        <i class="bi bi-chevron-right"></i>
                    </button>

                </div>
            <?php endif; ?>

            <div class="mt-8 flex justify-center">
                <button
                    type="button"
                    id="abrirFormularioFeedback"
                    class="inline-flex items-center gap-3 rounded-xl bg-laranja px-7 py-4 font-bold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-laranjaEscuro hover:shadow-lg"
                >
                    Adicionar feedback
                    <i class="bi bi-plus-lg text-xl"></i>
                </button>
            </div>

        </div>
    </div>

    <!-- MODAL -->
    <div
        id="modalFeedback"
        class="fixed inset-0 z-[100] hidden items-center justify-center bg-azul/50 px-5 py-8 backdrop-blur-sm"
    >
        <div
            id="caixaFeedback"
            class="relative max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-3xl bg-fundo p-6 shadow-2xl md:p-8"
        >

            <button
                type="button"
                id="fecharFormularioFeedback"
                aria-label="Fechar formulário"
                class="absolute right-5 top-5 grid h-10 w-10 place-items-center rounded-full text-2xl text-slate-400 transition hover:bg-white hover:text-azul"
            >
                <i class="bi bi-x-lg"></i>
            </button>

            <div class="pr-10">
                <span class="text-xs font-bold uppercase tracking-[0.18em] text-laranja">
                    Voz dos estudantes
                </span>

                <h3 class="mt-2 text-3xl font-black text-azul">
                    Envie seu feedback
                </h3>

                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Compartilhe uma opinião, sugestão ou experiência sobre a escola.
                </p>
            </div>

            <form action="index.php" method="POST" class="mt-7">

                <div>
                    <label for="feedback-titulo" class="text-sm font-bold text-azul">
                        Título do feedback
                    </label>

                    <input
                        id="feedback-titulo"
                        name="titulo"
                        type="text"
                        maxlength="70"
                        required
                        placeholder="Ex.: Uma sugestão para os intervalos"
                        class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-laranja focus:ring-4 focus:ring-orange-100"
                    >
                </div>

                <div class="mt-5">
                    <label for="feedback-categoria" class="text-sm font-bold text-azul">
                        Categoria
                    </label>

                    <select
                        id="feedback-categoria"
                        name="categoria"
                        required
                        class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-laranja focus:ring-4 focus:ring-orange-100"
                    >
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

                    <textarea
                        id="feedback-texto"
                        name="texto"
                        rows="5"
                        maxlength="500"
                        required
                        placeholder="Escreva sua opinião, sugestão ou experiência..."
                        class="mt-2 w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm leading-6 outline-none transition focus:border-laranja focus:ring-4 focus:ring-orange-100"
                    ></textarea>
                </div>

                <div class="mt-5 flex items-start gap-3 rounded-xl bg-white p-4">
                    <div class="mt-0.5 grid h-8 w-8 shrink-0 place-items-center rounded-full bg-orange-100 text-laranja">
                        <i class="bi bi-shield-lock text-lg"></i>
                    </div>

                    <p class="text-xs leading-5 text-slate-500">
                        Sua identidade não será exibida junto ao feedback. Evite colocar dados pessoais na mensagem.
                    </p>
                </div>

                <button
                    type="submit"
                    class="mt-6 w-full rounded-xl bg-azul px-6 py-3.5 font-bold text-white transition hover:bg-azul2"
                >
                    Enviar feedback anônimo
                </button>

            </form>
        </div>
    </div>
</section>

<?php include './includes/footer.php'; ?>

<!-- VLibras -->
<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
    </div>
</div>

<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script src="./js/libras.js"></script>

<!-- CARROSSEL DOS FEEDBACKS E MODAL -->
<script>
    const feedbackViewport = document.getElementById('feedbackViewport');
    const feedbackTrack = document.getElementById('feedbackTrack');
    const feedbackCards = document.querySelectorAll('.feedback-card');
    const feedbackAnterior = document.getElementById('feedbackAnterior');
    const feedbackProximo = document.getElementById('feedbackProximo');

    let feedbackAtual = 0;
    let feedbackAutoplay = null;

    function quantidadeVisivel() {
        if (window.innerWidth >= 1280) return 4;
        if (window.innerWidth >= 640) return 2;
        return 1;
    }

    function atualizarControles() {
        const controles = document.getElementById('controlesFeedback');

        if (!controles) return;

        controles.classList.toggle(
            'hidden',
            feedbackCards.length <= quantidadeVisivel()
        );
    }

    function atualizarCarrossel() {
        if (!feedbackTrack || feedbackCards.length === 0) {
            atualizarControles();
            return;
        }

        const visiveis = quantidadeVisivel();
        const ultimoIndice = Math.max(0, feedbackCards.length - visiveis);

        feedbackAtual = Math.min(feedbackAtual, ultimoIndice);

        const larguraCard = feedbackCards[0].getBoundingClientRect().width;
        const estilo = window.getComputedStyle(feedbackTrack);
        const espacamento = parseFloat(estilo.columnGap || estilo.gap) || 0;

        feedbackTrack.style.transform =
            `translateX(-${feedbackAtual * (larguraCard + espacamento)}px)`;

        atualizarControles();
    }

    function proximoFeedback() {
        const ultimoIndice = Math.max(
            0,
            feedbackCards.length - quantidadeVisivel()
        );

        feedbackAtual = feedbackAtual >= ultimoIndice
            ? 0
            : feedbackAtual + 1;

        atualizarCarrossel();
    }

    function feedbackAnteriorAcao() {
        const ultimoIndice = Math.max(
            0,
            feedbackCards.length - quantidadeVisivel()
        );

        feedbackAtual = feedbackAtual <= 0
            ? ultimoIndice
            : feedbackAtual - 1;

        atualizarCarrossel();
    }

    function iniciarFeedbackAutoplay() {
        clearInterval(feedbackAutoplay);

        if (feedbackCards.length <= quantidadeVisivel()) return;

        feedbackAutoplay = setInterval(proximoFeedback, 5000);
    }

    feedbackAnterior?.addEventListener('click', () => {
        feedbackAnteriorAcao();
        iniciarFeedbackAutoplay();
    });

    feedbackProximo?.addEventListener('click', () => {
        proximoFeedback();
        iniciarFeedbackAutoplay();
    });

    window.addEventListener('resize', () => {
        atualizarCarrossel();
        iniciarFeedbackAutoplay();
    });

    feedbackViewport?.addEventListener('mouseenter', () => {
        clearInterval(feedbackAutoplay);
    });

    feedbackViewport?.addEventListener('mouseleave', iniciarFeedbackAutoplay);

    atualizarCarrossel();
    iniciarFeedbackAutoplay();

    // Modal do formulário
    const modalFeedback = document.getElementById('modalFeedback');
    const abrirFormularioFeedback = document.getElementById('abrirFormularioFeedback');
    const fecharFormularioFeedback = document.getElementById('fecharFormularioFeedback');

    function abrirFormulario() {
        modalFeedback.classList.remove('hidden');
        modalFeedback.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function fecharFormulario() {
        modalFeedback.classList.add('hidden');
        modalFeedback.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    abrirFormularioFeedback?.addEventListener('click', abrirFormulario);
    fecharFormularioFeedback?.addEventListener('click', fecharFormulario);

    modalFeedback?.addEventListener('click', (event) => {
        if (event.target === modalFeedback) {
            fecharFormulario();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !modalFeedback.classList.contains('hidden')) {
            fecharFormulario();
        }
    });
</script>

<!-- CARROSSEL DA ESCOLA -->
<script>
    const carousel = document.getElementById('carousel-escola');

    if (carousel) {
        const slides = carousel.querySelectorAll('.carousel-slide');
        const dots = carousel.querySelectorAll('.carousel-dot');
        const prevButton = document.getElementById('carousel-prev');
        const nextButton = document.getElementById('carousel-next');

        let slideAtual = 0;
        let autoplay = null;

        function mostrarSlide(indice) {
            slideAtual = (indice + slides.length) % slides.length;

            slides.forEach((slide, i) => {
                slide.classList.toggle('opacity-100', i === slideAtual);
                slide.classList.toggle('opacity-0', i !== slideAtual);
            });

            dots.forEach((dot, i) => {
                dot.classList.toggle('w-8', i === slideAtual);
                dot.classList.toggle('w-2.5', i !== slideAtual);
                dot.classList.toggle('bg-white', i === slideAtual);
                dot.classList.toggle('bg-white/50', i !== slideAtual);
            });
        }

        function iniciarAutoplay() {
            clearInterval(autoplay);
            autoplay = setInterval(() => mostrarSlide(slideAtual + 1), 4500);
        }

        prevButton?.addEventListener('click', () => {
            mostrarSlide(slideAtual - 1);
            iniciarAutoplay();
        });

        nextButton?.addEventListener('click', () => {
            mostrarSlide(slideAtual + 1);
            iniciarAutoplay();
        });

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                mostrarSlide(i);
                iniciarAutoplay();
            });
        });

        carousel.addEventListener('mouseenter', () => clearInterval(autoplay));
        carousel.addEventListener('mouseleave', iniciarAutoplay);

        iniciarAutoplay();
    }
</script>

</body>
</html>
