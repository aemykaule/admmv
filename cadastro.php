\e<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Cadastro | Sesc Senac</title>


    <!-- TAILWIND -->

    <script src="https://cdn.tailwindcss.com"></script>


    <!-- CONFIGURAÇÃO DO TAILWIND -->

    <script>

        tailwind.config = {

            theme: {

                extend: {

                    colors: {

                        azul: '#003B5C',

                        laranja: '#F58220'

                    }

                }

            }

        }

    </script>

</head>


<body class="bg-white">


    <!-- ================================================= -->
    <!-- HEADER -->
    <!-- ================================================= -->

    <header class="sticky top-0 z-50 border-b border-white/10 bg-azul text-white">

        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4">


            <!-- LOGO -->

            <a
                href="index.php"
                class="flex items-center gap-3"
            >

                <span
                    class="grid h-10 w-10 place-items-center rounded-lg bg-white text-lg font-black"
                >

                    <img
                        src="./img/logo.png"
                        alt="Logo Sesc Senac"
                    >

                </span>


                <div>

                    <span class="block font-bold leading-none">
                        Sesc Senac
                    </span>

                    <span class="text-xs text-blue-200">
                        Ensino Médio
                    </span>

                </div>

            </a>


            <!-- ================================================= -->
            <!-- MENU -->
            <!-- ================================================= -->

            <nav class="hidden items-center gap-7 text-sm font-medium lg:flex">

                <a
                    href="index.php#escola"
                    class="transition hover:text-laranja"
                >
                    A Escola
                </a>


                <a
                    href="index.php#ensino"
                    class="transition hover:text-laranja"
                >
                    Ensino
                </a>


                <a
                    href="index.php#cursos"
                    class="transition hover:text-laranja"
                >
                    Cursos
                </a>


                <a
                    href="index.php#feiras"
                    class="transition hover:text-laranja"
                >
                    Feiras
                </a>


                <a
                    href="index.php#clubes"
                    class="transition hover:text-laranja"
                >
                    Clubes
                </a>

            </nav>


            <!-- ================================================= -->
            <!-- BOTÃO USUÁRIO -->
            <!-- ================================================= -->

            <div class="flex items-center gap-3">

                <button
                    type="button"
                    onclick="abrirLogin()"
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

                </button>

            </div>

        </div>


        <!-- ================================================= -->
        <!-- FUNDO ESCURO -->
        <!-- ================================================= -->

        <div
            id="fundoLogin"
            onclick="fecharLogin()"
            class="fixed inset-0 z-40 hidden bg-black/20"
        ></div>


        <!-- ================================================= -->
        <!-- PAINEL DE CADASTRO -->
        <!-- ================================================= -->

        <aside
            id="painelLogin"
            class="fixed right-0 top-0 z-50 h-screen w-full max-w-[500px] translate-x-full overflow-y-auto bg-white text-gray-900 shadow-2xl transition-transform duration-300"
        >

            <div class="px-8 py-7">


                <!-- ================================================= -->
                <!-- CABEÇALHO DO PAINEL -->
                <!-- ================================================= -->

                <div class="flex items-center justify-between">

                    <h2 class="text-2xl font-normal text-gray-900">
                        Minha Conta
                    </h2>


                    <!-- BOTÃO FECHAR -->

                    <button
                        type="button"
                        onclick="fecharLogin()"
                        class="text-3xl font-light text-gray-500 transition hover:text-black"
                        aria-label="Fechar"
                    >
                        &times;
                    </button>

                </div>


                <!-- ================================================= -->
                <!-- TÍTULO -->
                <!-- ================================================= -->

                <h3 class="mt-7 text-2xl font-normal text-gray-900">
                    Registro
                </h3>


                <!-- ================================================= -->
                <!-- FORMULÁRIO -->
                <!-- ================================================= -->

                <form
                    action="cadastro.php"
                    method="POST"
                    class="mt-6"
                >


                    <!-- ================================================= -->
                    <!-- NOME -->
                    <!-- ================================================= -->

                    <div>

                        <label
                            for="nome"
                            class="sr-only"
                        >
                            Nome
                        </label>

                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            placeholder="Nome *"
                            required
                            autocomplete="given-name"
                            class="h-[56px] w-full border border-gray-300 bg-white px-3 text-sm text-gray-800 outline-none transition focus:border-blue-400 focus:ring-1 focus:ring-blue-300"
                        >

                    </div>


                    <!-- ================================================= -->
                    <!-- CPF -->
                    <!-- ================================================= -->

                    <div class="mt-2">

                        <label
                            for="cpf"
                            class="sr-only"
                        >
                            CPF
                        </label>

                        <input
                            type="text"
                            id="cpf"
                            name="cpf"
                            placeholder="CPF"
                            maxlength="14"
                            inputmode="numeric"
                            autocomplete="off"
                            class="h-[56px] w-full border border-gray-300 bg-white px-3 text-sm text-gray-800 outline-none transition focus:border-blue-400 focus:ring-1 focus:ring-blue-300"
                        >

                    </div>


                    <!-- ================================================= -->
                    <!-- E-MAIL -->
                    <!-- ================================================= -->

                    <div class="mt-2">

                        <label
                            for="email"
                            class="sr-only"
                        >
                            E-mail
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Email *"
                            required
                            autocomplete="email"
                            class="h-[56px] w-full border border-gray-300 bg-white px-3 text-sm text-gray-800 outline-none transition focus:border-blue-400 focus:ring-1 focus:ring-blue-300"
                        >

                    </div>


                    <!-- ================================================= -->
                    <!-- AVISO DA SENHA -->
                    <!-- ================================================= -->

                    <p class="mt-4 text-[11px] leading-4 text-gray-600">

                        Senha deve ser 8+ caracteres e conter um número,
                        caractere especial, letras maiúsculas e minúsculas.

                    </p>


                    <!-- ================================================= -->
                    <!-- SENHA -->
                    <!-- ================================================= -->

                    <div class="relative mt-1">

                        <label
                            for="senhaCadastro"
                            class="sr-only"
                        >
                            Senha
                        </label>


                        <input
                            type="password"
                            id="senhaCadastro"
                            name="senha"
                            placeholder="SENHA *"
                            required
                            minlength="8"
                            autocomplete="new-password"
                            class="h-[60px] w-full border border-gray-300 bg-white px-3 pr-14 text-sm text-gray-800 outline-none transition focus:border-blue-400 focus:ring-1 focus:ring-blue-300"
                        >


                        <!-- OLHO -->

                        <button
                            type="button"
                            onclick="mostrarSenhaCadastro()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-800 transition hover:text-gray-500"
                            aria-label="Mostrar senha"
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
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.423 7.51 7.36 5 12 5c4.64 0 8.577 2.51 9.964 6.678.03.105.03.22 0 .322C20.577 16.49 16.64 19 12 19c-4.64 0-8.577-2.51-9.964-6.678Z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                />

                            </svg>

                        </button>

                    </div>


                    <!-- ================================================= -->
                    <!-- CONFIRMAR SENHA -->
                    <!-- ================================================= -->

                    <div class="relative mt-2">

                        <label
                            for="confirmarSenha"
                            class="sr-only"
                        >
                            Confirmar senha
                        </label>


                        <input
                            type="password"
                            id="confirmarSenha"
                            name="confirmar_senha"
                            placeholder="CONFIRMAR SENHA *"
                            required
                            minlength="8"
                            autocomplete="new-password"
                            class="h-[60px] w-full border border-gray-300 bg-white px-3 pr-14 text-sm text-gray-800 outline-none transition focus:border-blue-400 focus:ring-1 focus:ring-blue-300"
                        >


                        <!-- OLHO -->

                        <button
                            type="button"
                            onclick="mostrarConfirmarSenha()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-800 transition hover:text-gray-500"
                            aria-label="Mostrar confirmação de senha"
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
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.423 7.51 7.36 5 12 5c4.64 0 8.577 2.51 9.964 6.678.03.105.03.22 0 .322C20.577 16.49 16.64 19 12 19c-4.64 0-8.577-2.51-9.964-6.678Z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                />

                            </svg>

                        </button>

                    </div>


                    <!-- ================================================= -->
                    <!-- BOTÃO CADASTRAR -->
                    <!-- ================================================= -->

                    <button
                        type="submit"
                        class="mt-5 h-12 w-full bg-neutral-900 text-sm font-semibold text-white transition hover:bg-neutral-700"
                    >
                        Cadastrar
                    </button>


                </form>


                <!-- ================================================= -->
                <!-- VOLTAR PARA LOGIN -->
                <!-- ================================================= -->

                <p class="mt-5 text-sm text-gray-600">

                    Já possui uma conta?

                    <a
                        href="login.php"
                        class="text-gray-800 underline transition hover:text-gray-500"
                    >
                        Fazer login
                    </a>

                </p>


            </div>

        </aside>

    </header>


    <!-- ================================================= -->
    <!-- CONTEÚDO DA PÁGINA -->
    <!-- ================================================= -->

    <main class="min-h-screen bg-white">

        <div class="mx-auto max-w-7xl px-5 py-20">

            <h1 class="text-4xl font-black text-azul">
                Cadastro
            </h1>

        </div>

    </main>


    <!-- ================================================= -->
    <!-- JAVASCRIPT -->
    <!-- ================================================= -->

    <script>


        /* ============================================
           ABRIR PAINEL
        ============================================ */

        function abrirLogin() {

            const painel =
                document.getElementById("painelLogin");

            const fundo =
                document.getElementById("fundoLogin");


            fundo.classList.remove("hidden");


            setTimeout(() => {

                painel.classList.remove("translate-x-full");

            }, 10);

        }


        /* ============================================
           FECHAR PAINEL
        ============================================ */

        function fecharLogin() {

            const painel =
                document.getElementById("painelLogin");

            const fundo =
                document.getElementById("fundoLogin");


            painel.classList.add("translate-x-full");


            setTimeout(() => {

                fundo.classList.add("hidden");

            }, 300);

        }


        /* ============================================
           MOSTRAR / ESCONDER SENHA
        ============================================ */

        function mostrarSenhaCadastro() {

            const senha =
                document.getElementById("senhaCadastro");


            if (senha.type === "password") {

                senha.type = "text";

            } else {

                senha.type = "password";

            }

        }


        /* ============================================
           MOSTRAR / ESCONDER CONFIRMAÇÃO
        ============================================ */

        function mostrarConfirmarSenha() {

            const senha =
                document.getElementById("confirmarSenha");


            if (senha.type === "password") {

                senha.type = "text";

            } else {

                senha.type = "password";

            }

        }


        /* ============================================
           MÁSCARA DO CPF
        ============================================ */

        document
            .getElementById("cpf")
            .addEventListener("input", function () {


                let cpf =
                    this.value.replace(/\D/g, "");


                cpf =
                    cpf.substring(0, 11);


                if (cpf.length > 3) {

                    cpf =
                        cpf.replace(
                            /^(\d{3})(\d)/,
                            "$1.$2"
                        );

                }


                if (cpf.length > 7) {

                    cpf =
                        cpf.replace(
                            /^(\d{3})\.(\d{3})(\d)/,
                            "$1.$2.$3"
                        );

                }


                if (cpf.length > 11) {

                    cpf =
                        cpf.replace(
                            /^(\d{3})\.(\d{3})\.(\d{3})(\d)/,
                            "$1.$2.$3-$4"
                        );

                }


                this.value = cpf;

            });


    </script>


</body>

</html>