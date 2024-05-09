<script>
    $(document).on('show.bs.modal', '#confirm-delete', function(e) {
        var data = $(e.relatedTarget).data();
        $("#form-eliminar").attr('action', data.bsAction);
        $('#id').val(data.bsRecordId);
        $('.title', this).text(data.bsRecordTitle);
        $('.btn-ok', this).data('recordId', data.bsRecordId);
    });

    $(document).ready(function() {
        $(window).scroll(function() {
            if ($(window).scrollTop() > 300) {
                $('#scrolltop').fadeIn(); // Usa fadeIn para animar la aparición
            } else {
                $('#scrolltop').fadeOut(); // Usa fadeOut para animar la desaparición
            }
        });

        $('#scrolltop').click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, 3000); // Anima el scroll durante 500 milisegundos
        });
    });

    const intro = introJs().setOptions({
        steps: [{
                title: 'Bienvenido',
                intro: 'Bienvenido al sistema Salud Integral 360'
            },
            {
                title: "Barra informativa",
                element: document.querySelector('.first'),
                intro: 'Muestra información para acceso rápido'
            },
            {
                title: "Menu",
                element: document.querySelector('.second'),
                intro: 'Panel de navegación del sistema'
            }
        ],
    });

    document.getElementById('iniciarIntroBtn').addEventListener('click', () => {
        intro.start();
    });

    introJs().addHints();
</script>
