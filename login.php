<?php

session_start();

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if ($usuario === 'admin' && $senha === '1234') {

        $_SESSION['admin'] = true;
        $_SESSION['usuario_admin'] = 'admin';

        session_regenerate_id(true);

        header('Location: moderacao.php');
        exit;

    } else {

        $erro = 'Usuário ou senha incorretos.';

    }

}

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
        Login Administrativo | Sesc Senac Caiobá
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


<body class="bg-fundo">


<div
    class="flex min-h-screen items-center justify-center px-5"
>

    <div
        class="w-full max-w-md"
    >


        <!-- título -->

        <div
            class="mb-8 text-center"
        >

            <div
                class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-azul text-white"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="h-8 w-8"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.118a7.5 7.5 0 0 1 15 0A17.933 17.933 0 0 0 12 21.75a17.933 17.933 0 0 0-7.5-1.632Z"
                    />

                </svg>

            </div>


            <p
                class="mt-5 text-xs font-bold uppercase tracking-[0.2em] text-laranja"
            >
                Área restrita
            </p>


            <h1
                class="mt-2 text-3xl font-black text-azul"
            >
                Painel Administrativo
            </h1>


            <p
                class="mt-3 text-sm leading-6 text-slate-500"
            >
                Entre com a conta de administrador para acessar
                a moderação dos feedbacks.
            </p>

        </div>



        <!-- caixa login -->

        <div
            class="rounded-3xl border border-slate-200 bg-white p-8 shadow-xl"
        >


            <?php if ($erro): ?>

                <div
                    class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-600"
                >

                    <?= htmlspecialchars($erro) ?>

                </div>

            <?php endif; ?>



            <form
                method="POST"
                action="login.php"
            >


                <!-- usuário -->

                <div>

                    <label
                        for="usuario"
                        class="text-sm font-bold text-azul"
                    >
                        Usuário
                    </label>


                    <input
                        type="text"
                        id="usuario"
                        name="usuario"
                        placeholder="Digite seu usuário"
                        required
                        autocomplete="username"
                        class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-laranja focus:ring-4 focus:ring-orange-100"
                    >

                </div>



                <!-- senha -->

                <div
                    class="mt-5"
                >

                    <label
                        for="senha"
                        class="text-sm font-bold text-azul"
                    >
                        Senha
                    </label>


                    <input
                        type="password"
                        id="senha"
                        name="senha"
                        placeholder="Digite sua senha"
                        required
                        autocomplete="current-password"
                        class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-laranja focus:ring-4 focus:ring-orange-100"
                    >

                </div>



                <!-- botão -->

                <button
                    type="submit"
                    class="mt-7 w-full rounded-xl bg-azul px-5 py-3.5 font-bold text-white transition hover:bg-azul2"
                >
                    Entrar como administrador
                </button>


            </form>



            <div
                class="mt-6 border-t border-slate-100 pt-6"
            >

                <a
                    href="index.php"
                    class="block text-center text-sm font-semibold text-slate-500 transition hover:text-azul"
                >
                    ← Voltar para o site
                </a>

            </div>


        </div>


        <p
            class="mt-6 text-center text-xs text-slate-400"
        >
            Ensino Médio Integrado ao Técnico • Sesc Senac Caiobá
        </p>


    </div>

</div>


</body>

</html>