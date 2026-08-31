<header class="sticky top-0 z-50 border-b border-white/10 bg-azul text-white">

    <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4">

        <!-- LOGO -->
        <a href="index.php" class="flex items-center gap-3">

            <span class="grid h-10 w-10 place-items-center rounded-lg bg-white text-lg font-black">
                <img src="./img/logo.png" alt="">
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


        <!-- ÍCONE DO USUÁRIO -->
        <div class="flex items-center gap-3">

            <button
                type="button"
                onclick="abrirLogin()"
                title="Entrar ou cadastrar"
                aria-label="Entrar ou cadastrar"
                class="grid h-11 w-11 place-items-center rounded-lg border border-white/20 bg-white/10 text-white transition hover:border-laranja hover:bg-laranja">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="h-6 w-6">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.118a7.5 7.5 0 0 1 15 0A17.933 17.933 0 0 0 12 21.75a17.933 17.933 0 0 0-7.5-1.632Z" />
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
        class="fixed inset-0 z-40 hidden bg-black/20"></div>


    <!-- ================================================= -->
    <!-- PAINEL DE LOGIN -->
    <!-- ================================================= -->

    <aside
        id="painelLogin"
        class="fixed right-0 top-0 z-50 h-screen w-full max-w-[380px] translate-x-full bg-white text-gray-900 shadow-2xl transition-transform duration-300">

        <!-- CABEÇALHO DO PAINEL -->
        <div class="flex items-center justify-between px-6 pt-7">

            <h2 class="text-2xl font-normal">
                Minha Conta
            </h2>

            <!-- FECHAR -->
            <button
                type="button"
                onclick="fecharLogin()"
                class="text-3xl font-light text-gray-500 transition hover:text-black"
                aria-label="Fechar">
                &times;
            </button>

        </div>


        <!-- CONTEÚDO -->
        <div class="px-6 py-7">

            <h3 class="text-base font-bold">
                Log in
            </h3>


            <form action="login.php" method="POST" class="mt-5">


                <!-- EMAIL -->
                <div>

                    <label
                        for="email"
                        class="sr-only">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Email *"
                        required
                        class="h-[52px] w-full border border-gray-300 px-3 text-sm outline-none transition focus:border-gray-500">

                </div>


                <!-- SENHA -->
                <div class="relative mt-2">

                    <label
                        for="senha"
                        class="sr-only">
                        Senha
                    </label>

                    <input
                        type="password"
                        id="senha"
                        name="senha"
                        placeholder="Senha *"
                        required
                        class="h-[52px] w-full border border-gray-300 px-3 pr-12 text-sm outline-none transition focus:border-gray-500">


                    <!-- OLHO -->
                    <button
                        type="button"
                        onclick="mostrarSenha()"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-700 hover:text-black"
                        aria-label="Mostrar senha">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-6 w-6">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.423 7.51 7.36 5 12 5c4.64 0 8.577 2.51 9.964 6.678.03.105.03.22 0 .322C20.577 16.49 16.64 19 12 19c-4.64 0-8.577-2.51-9.964-6.678Z" />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />

                        </svg>

                    </button>

                </div>


                <!-- LEMBRAR + ESQUECI -->
                <div class="mt-3 flex items-center justify-between">

                    <label class="flex cursor-pointer items-center gap-2 text-sm font-semibold">

                        <input
                            type="checkbox"
                            name="lembrar"
                            class="h-5 w-5 border-gray-400">

                        <span>
                            Lembre de Mim
                        </span>

                    </label>


                    <a
                        href="#"
                        class="text-sm text-gray-800 underline transition hover:text-gray-500">
                        Esqueceu sua senha?
                    </a>

                </div>


                <!-- BOTÃO LOGIN -->
                <button
                    type="submit"
                    class="mt-5 h-11 w-full bg-neutral-900 text-sm font-semibold text-white transition hover:bg-neutral-700">
                    Log in
                </button>


            </form>



        </div>

    </aside>

</header>


<!-- ================================================= -->
<!-- JAVASCRIPT -->
<!-- ================================================= -->

<script>
    function abrirLogin() {

        const painel = document.getElementById("painelLogin");
        const fundo = document.getElementById("fundoLogin");

        fundo.classList.remove("hidden");

        setTimeout(() => {
            painel.classList.remove("translate-x-full");
        }, 10);

    }


    function fecharLogin() {

        const painel = document.getElementById("painelLogin");
        const fundo = document.getElementById("fundoLogin");

        painel.classList.add("translate-x-full");

        setTimeout(() => {
            fundo.classList.add("hidden");
        }, 300);

    }


    function mostrarSenha() {

        const senha = document.getElementById("senha");

        if (senha.type === "password") {

            senha.type = "text";

        } else {

            senha.type = "password";

        }

    }
</script>