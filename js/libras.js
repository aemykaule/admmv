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