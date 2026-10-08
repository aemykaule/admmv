// carrossel
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

            const visiveis = quantidadeVisivel();
            const precisaNavegar = feedbackCards.length > visiveis;

            controles.classList.toggle('hidden', !precisaNavegar);
        }

        function atualizarCarrossel() {
            if (!feedbackTrack || !feedbackCards.length) {
                atualizarControles();
                return;
            }

            const visiveis = quantidadeVisivel();
            const ultimoIndice = Math.max(0, feedbackCards.length - visiveis);

            if (feedbackAtual > ultimoIndice) {
                feedbackAtual = ultimoIndice;
            }

            const larguraCard = feedbackCards[0].getBoundingClientRect().width;
            const estiloTrack = window.getComputedStyle(feedbackTrack);
            const espacamento = parseFloat(estiloTrack.columnGap || estiloTrack.gap) || 0;
            const deslocamento = feedbackAtual * (larguraCard + espacamento);

            feedbackTrack.style.transform = `translateX(-${deslocamento}px)`;

            atualizarControles();
        }

        function proximoFeedback() {
            const visiveis = quantidadeVisivel();
            const ultimoIndice = Math.max(0, feedbackCards.length - visiveis);

            if (feedbackAtual >= ultimoIndice) {
                feedbackAtual = 0;
            } else {
                feedbackAtual++;
            }

            atualizarCarrossel();
        }

        function feedbackAnteriorAcao() {
            const visiveis = quantidadeVisivel();
            const ultimoIndice = Math.max(0, feedbackCards.length - visiveis);

            if (feedbackAtual <= 0) {
                feedbackAtual = ultimoIndice;
            } else {
                feedbackAtual--;
            }

            atualizarCarrossel();
        }

        function iniciarFeedbackAutoplay() {
            clearInterval(feedbackAutoplay);

            if (feedbackCards.length <= quantidadeVisivel()) return;

            feedbackAutoplay = setInterval(proximoFeedback, 5000);
        }

        if (feedbackAnterior) {
            feedbackAnterior.addEventListener('click', () => {
                feedbackAnteriorAcao();
                iniciarFeedbackAutoplay();
            });
        }

        if (feedbackProximo) {
            feedbackProximo.addEventListener('click', () => {
                proximoFeedback();
                iniciarFeedbackAutoplay();
            });
        }

        window.addEventListener('resize', () => {
            atualizarCarrossel();
            iniciarFeedbackAutoplay();
        });

        // O carrossel passa sozinho e pausa quando o mouse fica sobre os cards.
        if (feedbackViewport) {
            feedbackViewport.addEventListener('mouseenter', () => {
                clearInterval(feedbackAutoplay);
            });

            feedbackViewport.addEventListener('mouseleave', () => {
                iniciarFeedbackAutoplay();
            });
        }

        atualizarCarrossel();
        iniciarFeedbackAutoplay();


        // modal do formulário
        const modalFeedback = document.getElementById('modalFeedback');
        const abrirFormularioFeedback = document.getElementById('abrirFormularioFeedback');
        const fecharFormularioFeedback = document.getElementById('fecharFormularioFeedback');

        function abrirFormulario() {
            if (!modalFeedback) return;

            modalFeedback.classList.remove('hidden');
            modalFeedback.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function fecharFormulario() {
            if (!modalFeedback) return;

            modalFeedback.classList.add('hidden');
            modalFeedback.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        if (abrirFormularioFeedback) {
            abrirFormularioFeedback.addEventListener('click', abrirFormulario);
        }

        if (fecharFormularioFeedback) {
            fecharFormularioFeedback.addEventListener('click', fecharFormulario);
        }

        if (modalFeedback) {
            modalFeedback.addEventListener('click', (event) => {
                if (event.target === modalFeedback) {
                    fecharFormulario();
                }
            });
        }

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && modalFeedback && !modalFeedback.classList.contains('hidden')) {
                fecharFormulario();
            }
        });

// quantidade de items
        const carousel = document.getElementById('carousel-escola');
        const slides = carousel.querySelectorAll('.carousel-slide');
        const dots = carousel.querySelectorAll('.carousel-dot');
        const prevButton = document.getElementById('carousel-prev');
        const nextButton = document.getElementById('carousel-next');

        let slideAtual = 0;
        let autoplay;

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
            autoplay = setInterval(() => mostrarSlide(slideAtual + 1), 4500);
        }

        function reiniciarAutoplay() {
            clearInterval(autoplay);
            iniciarAutoplay();
        }

        prevButton.addEventListener('click', () => {
            mostrarSlide(slideAtual - 1);
            reiniciarAutoplay();
        });

        nextButton.addEventListener('click', () => {
            mostrarSlide(slideAtual + 1);
            reiniciarAutoplay();
        });

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                mostrarSlide(i);
                reiniciarAutoplay();
            });
        });

        carousel.addEventListener('mouseenter', () => clearInterval(autoplay));
        carousel.addEventListener('mouseleave', iniciarAutoplay);

        iniciarAutoplay();