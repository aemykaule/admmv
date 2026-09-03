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