<?php
session_start();
require_once __DIR__ . '/conexao.php';

if (isset($_SESSION['aluno_id'])) {
    header('Location: orientacoes_matricula.php');
    exit;
}

if (empty($_SESSION['csrf_cadastro_aluno'])) {
    $_SESSION['csrf_cadastro_aluno'] = bin2hex(random_bytes(32));
}

$erro = '';
$nome = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';
    $nome = trim($_POST['nome'] ?? '');
    $email = strtolower(trim($_POST['email'] ?? ''));
    $senha = $_POST['senha'] ?? '';
    $confirmarSenha = $_POST['confirmar_senha'] ?? '';

    if (
        !isset($_SESSION['csrf_cadastro_aluno']) ||
        !hash_equals($_SESSION['csrf_cadastro_aluno'], $token)
    ) {
        $erro = 'Sessão expirada. Atualize a página e tente novamente.';
    } elseif (mb_strlen($nome, 'UTF-8') < 3 || mb_strlen($nome, 'UTF-8') > 120) {
        $erro = 'Informe seu nome completo.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 190) {
        $erro = 'Informe um e-mail válido.';
    } elseif (strlen($senha) < 8) {
        $erro = 'Sua senha precisa ter pelo menos 8 caracteres.';
    } elseif ($senha !== $confirmarSenha) {
        $erro = 'As senhas não coincidem.';
    } else {
        $stmt = $conexao->prepare(
            'SELECT id FROM contas_alunos WHERE email = ? LIMIT 1'
        );

        if (!$stmt) {
            $erro = 'Não foi possível verificar o cadastro.';
        } else {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $emailExiste = $resultado->num_rows > 0;
            $stmt->close();

            if ($emailExiste) {
                $erro = 'Esse e-mail já está cadastrado. Tente entrar na sua conta.';
            } else {
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                $stmt = $conexao->prepare(
                    'INSERT INTO contas_alunos (nome, email, senha)
                     VALUES (?, ?, ?)'
                );

                if (!$stmt) {
                    $erro = 'Não foi possível criar sua conta.';
                } else {
                    $stmt->bind_param('sss', $nome, $email, $senhaHash);

                    if ($stmt->execute()) {
                        $novoId = $conexao->insert_id;
                        $stmt->close();

                        session_regenerate_id(true);

                        $_SESSION['aluno_id'] = (int) $novoId;
                        $_SESSION['aluno_nome'] = $nome;
                        $_SESSION['aluno_email'] = $email;

                        unset($_SESSION['csrf_cadastro_aluno']);

                        header('Location: orientacoes_matricula.php?cadastro=sucesso');
                        exit;
                    }

                    $stmt->close();
                    $erro = 'Não foi possível concluir o cadastro. Tente novamente.';
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Criar conta | Sesc Senac</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        <!-- APRESENTAÇÃO -->
        <section class="flex flex-col justify-between bg-azul
                    px-7 py-8 text-white sm:px-12
                    lg:min-h-screen lg:px-16 lg:py-12">

            <a href="index.php" class="flex w-fit items-center gap-3">

                <div class="grid h-12 w-12 place-items-center
                        rounded-xl bg-white text-azul">

                    <span class="text-2xl font-black">S</span>

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

            <div class="my-10 max-w-xl lg:my-auto lg:py-16">

                <p class="text-sm font-bold uppercase tracking-widest text-orange-200">
                    Primeiro acesso
                </p>

                <h1 class="mt-5 text-4xl font-black leading-tight sm:text-5xl">
                    Comece a construir seu futuro
                    <span class="text-laranja">hoje.</span>
                </h1>

                <p class="mt-5 text-base leading-7 text-blue-100 sm:text-lg">
                    Crie sua conta e tenha acesso às orientações sobre o
                    processo de matrícula do Ensino Médio Integrado ao Técnico.
                </p>

            </div>

            <p class="text-xs text-blue-200/80">
                Sesc Senac Caiobá · Matinhos/PR
            </p>

        </section>

        <!-- CADASTRO -->
        <section class="flex items-center justify-center px-5 py-10
                    sm:px-10 lg:px-14">

            <div class="w-full max-w-md">

                <a href="login_aluno.php"
                    class="mb-7 inline-flex items-center gap-2
                      text-sm font-semibold text-slate-500 hover:text-azul">

                    <i class="bi bi-arrow-left"></i>
                    Voltar para o login

                </a>

                <p class="text-sm font-bold uppercase tracking-widest text-laranja">
                    Área do aluno
                </p>

                <h2 class="mt-2 text-3xl font-black text-azul sm:text-4xl">
                    Crie sua conta
                </h2>

                <p class="mt-3 leading-6 text-slate-500">
                    Preencha os dados abaixo para começar.
                </p>

                <?php if ($erro !== ''): ?>

                    <div role="alert"
                        class="mt-5 rounded-xl border border-red-200
                            bg-red-50 px-4 py-3 text-sm text-red-700">

                        <?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?>

                    </div>

                <?php endif; ?>

                <form method="POST" action="cadastro_aluno.php"
                    class="mt-7 space-y-5">

                    <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars(
                                    $_SESSION['csrf_cadastro_aluno'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>">

                    <!-- NOME -->
                    <div>

                        <label for="nome"
                            class="mb-2 block text-sm font-bold text-azul">
                            Nome completo
                        </label>

                        <input id="nome" name="nome" type="text"
                            autocomplete="name" required minlength="3"
                            maxlength="120"
                            value="<?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?>"
                            placeholder="Digite seu nome completo"
                            class="w-full rounded-xl border border-slate-300
                                  bg-white px-4 py-3.5 outline-none
                                  focus:border-azul focus:ring-4 focus:ring-azul/10">

                    </div>

                    <!-- E-MAIL -->
                    <div>

                        <label for="email"
                            class="mb-2 block text-sm font-bold text-azul">
                            E-mail
                        </label>

                        <input id="email" name="email" type="email"
                            autocomplete="email" required maxlength="190"
                            value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"
                            placeholder="voce@exemplo.com"
                            class="w-full rounded-xl border border-slate-300
                                  bg-white px-4 py-3.5 outline-none
                                  focus:border-azul focus:ring-4 focus:ring-azul/10">

                    </div>

                    <!-- SENHA -->
                    <div>

                        <label for="senha"
                            class="mb-2 block text-sm font-bold text-azul">
                            Senha
                        </label>

                        <div class="relative">

                            <input id="senha" name="senha" type="password"
                                autocomplete="new-password" required minlength="8"
                                placeholder="Mínimo de 8 caracteres"
                                class="w-full rounded-xl border border-slate-300
                                      bg-white px-4 py-3.5 pr-12 outline-none
                                      focus:border-azul focus:ring-4 focus:ring-azul/10">

                            <button type="button"
                                onclick="alternarSenha('senha', 'iconeSenha', this)"
                                aria-label="Mostrar senha"
                                aria-pressed="false"
                                class="absolute inset-y-0 right-0 flex items-center
                                       px-4 text-slate-500 transition hover:text-azul">

                                <i id="iconeSenha" class="bi bi-eye text-xl"></i>

                            </button>

                        </div>

                    </div>

                    <!-- CONFIRMAR SENHA -->
                    <div>

                        <label for="confirmar_senha"
                            class="mb-2 block text-sm font-bold text-azul">
                            Confirme sua senha
                        </label>

                        <div class="relative">

                            <input id="confirmar_senha" name="confirmar_senha"
                                type="password" autocomplete="new-password"
                                required minlength="8"
                                placeholder="Digite a senha novamente"
                                class="w-full rounded-xl border border-slate-300
                                      bg-white px-4 py-3.5 pr-12 outline-none
                                      focus:border-azul focus:ring-4 focus:ring-azul/10">

                            <button type="button"
                                onclick="alternarSenha('confirmar_senha', 'iconeConfirmarSenha', this)"
                                aria-label="Mostrar confirmação da senha"
                                aria-pressed="false"
                                class="absolute inset-y-0 right-0 flex items-center
                                       px-4 text-slate-500 transition hover:text-azul">

                                <i id="iconeConfirmarSenha" class="bi bi-eye text-xl"></i>

                            </button>

                        </div>

                    </div>

                    <!-- AVISO -->
                    <p class="text-xs leading-5 text-slate-500">
                        Ao criar sua conta, você poderá acessar as orientações
                        iniciais sobre o processo de matrícula.
                    </p>

                    <!-- BOTÃO CADASTRAR -->
                    <button type="submit"
                        class="flex w-full items-center justify-center gap-2
                            rounded-xl bg-azul px-5 py-4 font-black
                            text-white transition hover:bg-azulEscuro
                            focus:outline-none focus:ring-4 focus:ring-azul/20">

                        <i class="bi bi-person-plus-fill"></i>
                        Criar minha conta

                    </button>

                </form>

                <p class="mt-7 text-center text-sm text-slate-500">

                    Já tem cadastro?

                    <a href="login_aluno.php"
                        class="font-black text-laranja hover:text-orange-700">
                        Entrar
                    </a>

                </p>

            </div>

        </section>

    </main>

    <!-- MOSTRAR / ESCONDER SENHA -->
    <script>
        function alternarSenha(idCampo, idIcone, botao) {

            const campo = document.getElementById(idCampo);
            const icone = document.getElementById(idIcone);

            if (campo.type === 'password') {

                campo.type = 'text';

                icone.classList.remove('bi-eye');
                icone.classList.add('bi-eye-slash');

                botao.setAttribute('aria-label', 'Ocultar senha');
                botao.setAttribute('aria-pressed', 'true');

            } else {

                campo.type = 'password';

                icone.classList.remove('bi-eye-slash');
                icone.classList.add('bi-eye');

                botao.setAttribute('aria-label', 'Mostrar senha');
                botao.setAttribute('aria-pressed', 'false');

            }

        }
    </script>

</body>

</html>