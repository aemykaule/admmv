<?php

session_start();

require_once __DIR__ . '/conexao.php';

if (isset($_SESSION['aluno_id'])) {
    header('Location: orientacoes_matricula.php');
    exit;
}

if (empty($_SESSION['csrf_aluno'])) {
    $_SESSION['csrf_aluno'] = bin2hex(random_bytes(32));
}

$erro = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';
    $email = strtolower(trim($_POST['email'] ?? ''));
    $senha = $_POST['senha'] ?? '';

    if (
        !isset($_SESSION['csrf_aluno']) ||
        !hash_equals($_SESSION['csrf_aluno'], $token)
    ) {
        $erro = 'Sessão expirada. Atualize a página e tente novamente.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || $senha === '') {
        $erro = 'Informe um e-mail válido e sua senha.';
    } else {
        $stmt = $conexao->prepare(
            'SELECT id, nome, email, senha
             FROM contas_alunos
             WHERE email = ?
             LIMIT 1'
        );

        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();

            $resultado = $stmt->get_result();
            $aluno = $resultado->fetch_assoc();

            $stmt->close();

            if ($aluno && password_verify($senha, $aluno['senha'])) {
                session_regenerate_id(true);

                $_SESSION['aluno_id'] = (int) $aluno['id'];
                $_SESSION['aluno_nome'] = $aluno['nome'];
                $_SESSION['aluno_email'] = $aluno['email'];

                unset($_SESSION['csrf_aluno']);

                header('Location: orientacoes_matricula.php');
                exit;
            }

            $erro = 'E-mail ou senha incorretos.';
        } else {
            $erro = 'Não foi possível acessar sua conta.';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Ensino Médio Sesc Senac</title>

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

    <main class="min-h-screen lg:grid lg:grid-cols-2">

        <!-- Apresentação da escola -->
        <section class="relative flex flex-col justify-between overflow-hidden
                        bg-azul px-7 py-8 text-white
                        sm:px-12 lg:min-h-screen lg:px-16 lg:py-12">

            <div class="absolute -right-20 -top-20 h-72 w-72
                        rounded-full border-[36px] border-white/5"></div>

            <a href="index.php"
               class="relative flex w-fit items-center gap-3">

                <div class="grid h-12 w-12 place-items-center
                            rounded-xl bg-white text-azul">

                    <svg viewBox="0 0 24 24"
                         class="h-7 w-7"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8">

                        <path d="M3 10.5 12 3l9 7.5"></path>
                        <path d="M5.5 9.5V21h13V9.5"></path>
                        <path d="M9 21v-7h6v7"></path>

                    </svg>

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

            <div class="relative my-10 max-w-xl lg:my-auto lg:py-16">

                <span class="inline-block rounded-full border border-white/15
                             bg-white/10 px-4 py-2 text-xs font-bold
                             uppercase tracking-widest text-orange-200">
                    Sesc Senac Caiobá
                </span>

                <h1 class="mt-6 text-4xl font-black leading-tight
                           sm:text-5xl xl:text-6xl">

                    Seu próximo passo começa
                    <span class="text-laranja">aqui.</span>

                </h1>

                <p class="mt-6 max-w-lg text-base leading-7 text-blue-100 sm:text-lg">
                    Acesse sua conta para consultar informações e orientações
                    sobre o processo de matrícula do Ensino Médio Integrado ao Técnico.
                </p>

                <div class="mt-8 flex items-center gap-3 text-sm text-blue-100">
                    <span class="h-1 w-12 rounded-full bg-laranja"></span>
                    Formação, tecnologia e novas possibilidades.
                </div>

            </div>

            <p class="relative text-xs text-blue-200/80">
                Ensino Médio Integrado ao Técnico · Caiobá, Matinhos/PR
            </p>

        </section>

        <!-- Formulário de login -->
        <section class="flex items-center justify-center px-5 py-10
                        sm:px-10 lg:px-14">

            <div class="w-full max-w-md">

                <a href="index.php"
                   class="mb-8 inline-flex items-center gap-2
                          text-sm font-semibold text-slate-500 hover:text-azul">

                    <i class="bi bi-arrow-left"></i>
                    Voltar ao site

                </a>

                <div class="mb-8">

                    <p class="text-sm font-bold uppercase tracking-widest text-laranja">
                        Área do aluno
                    </p>

                    <h2 class="mt-2 text-3xl font-black text-azul sm:text-4xl">
                        Que bom ter você aqui!
                    </h2>

                    <p class="mt-3 leading-6 text-slate-500">
                        Entre com os dados cadastrados para continuar.
                    </p>

                </div>

                <?php if ($erro !== ''): ?>

                    <div role="alert"
                         class="mb-5 flex items-start gap-2 rounded-xl
                                border border-red-200 bg-red-50
                                px-4 py-3 text-sm text-red-700">

                        <i class="bi bi-exclamation-circle-fill mt-0.5"></i>

                        <span>
                            <?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?>
                        </span>

                    </div>

                <?php endif; ?>

                <form method="POST"
                      action="login_aluno.php"
                      class="space-y-5">

                    <input
                        type="hidden"
                        name="csrf_token"
                        value="<?= htmlspecialchars(
                            $_SESSION['csrf_aluno'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                    >

                    <div>

                        <label for="email"
                               class="mb-2 block text-sm font-bold text-azul">
                            E-mail
                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            maxlength="190"
                            required
                            value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"
                            placeholder="voce@exemplo.com"
                            class="w-full rounded-xl border border-slate-300
                                   bg-white px-4 py-3.5 outline-none
                                   transition placeholder:text-slate-400
                                   focus:border-azul focus:ring-4 focus:ring-azul/10"
                        >

                    </div>

                    <div>

                        <label for="senha"
                               class="mb-2 block text-sm font-bold text-azul">
                            Senha
                        </label>

                        <div class="relative">

                            <input
                                id="senha"
                                name="senha"
                                type="password"
                                autocomplete="current-password"
                                required
                                placeholder="Digite sua senha"
                                class="w-full rounded-xl border border-slate-300
                                       bg-white py-3.5 pl-4 pr-12 outline-none
                                       transition placeholder:text-slate-400
                                       focus:border-azul focus:ring-4 focus:ring-azul/10"
                            >

                            <!-- Botão para mostrar ou esconder a senha -->
                            <button
                                type="button"
                                id="mostrarSenha"
                                aria-label="Mostrar senha"
                                aria-pressed="false"
                                title="Mostrar senha"
                                class="absolute inset-y-0 right-0 flex
                                       items-center justify-center px-4
                                       text-lg text-slate-400 transition
                                       hover:text-azul focus:outline-none
                                       focus:text-azul"
                            >
                                <i id="iconeSenha"
                                   class="bi bi-eye"
                                   aria-hidden="true"></i>
                            </button>

                        </div>

                    </div>

                    <button
                        type="submit"
                        class="flex w-full items-center justify-center gap-2
                               rounded-xl bg-azul px-5 py-4 font-black
                               text-white transition hover:bg-azulEscuro
                               focus:outline-none focus:ring-4 focus:ring-azul/20"
                    >
                        <i class="bi bi-box-arrow-in-right"></i>
                        Entrar na minha conta
                    </button>

                </form>

                <div class="my-7 flex items-center gap-4">

                    <div class="h-px flex-1 bg-slate-200"></div>

                    <span class="text-xs font-semibold uppercase text-slate-400">
                        ou
                    </span>

                    <div class="h-px flex-1 bg-slate-200"></div>

                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 sm:p-6">

                    <h3 class="font-black text-azul">
                        Ainda não tem uma conta?
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Crie seu cadastro para consultar as orientações sobre a matrícula.
                    </p>

                    <a href="cadastro_aluno.php"
                       class="mt-4 inline-flex items-center gap-2
                              font-black text-laranja hover:text-orange-700">

                        Criar minha conta
                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>

                <p class="mt-8 text-center text-xs leading-5 text-slate-400">
                    Área destinada aos alunos interessados no processo de matrícula.
                </p>

            </div>

        </section>

    </main>

    <!-- Alternar visibilidade da senha -->
    <script>
        const campoSenha = document.getElementById('senha');
        const botaoSenha = document.getElementById('mostrarSenha');
        const iconeSenha = document.getElementById('iconeSenha');

        botaoSenha.addEventListener('click', () => {
            const mostrar = campoSenha.type === 'password';

            campoSenha.type = mostrar ? 'text' : 'password';

            iconeSenha.className = mostrar
                ? 'bi bi-eye-slash'
                : 'bi bi-eye';

            botaoSenha.setAttribute(
                'aria-label',
                mostrar ? 'Ocultar senha' : 'Mostrar senha'
            );

            botaoSenha.setAttribute(
                'title',
                mostrar ? 'Ocultar senha' : 'Mostrar senha'
            );

            botaoSenha.setAttribute('aria-pressed', String(mostrar));
        });
    </script>

</body>
</html>
