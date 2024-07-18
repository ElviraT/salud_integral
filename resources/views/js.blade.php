<script>
    const intro = introJs().setOptions({
        steps: [{
                title: 'Bienvenido',
                intro: 'Bienvenido al sistema Escuela Libre Chile'
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
            },
            {
                title: "Cartelera informativa",
                element: document.querySelector('.third'),
                intro: 'Mostrara información relevante sobre las actividades academicas, si le das click veras el detalle de cada una'
            }
        ],
    });

    document.getElementById('iniciarIntroBtn').addEventListener('click', () => {
        intro.start();
    });

    introJs().addHints();
</script>
