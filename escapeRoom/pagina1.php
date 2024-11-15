<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<style>
    body {
        background-image: url('foto1.jpg'); /* Cambia la ruta a tu imagen */
        background-size: cover; /* Ajusta la imagen para cubrir todo el fondo */
        background-position: center; /* Centra la imagen */
        background-size: cover;
        background-repeat: no-repeat; /* Evita que la imagen se repita */
        height: 150vh; /* Asegura que el body tenga al menos la altura de la ventana */
        margin: 0; /* Elimina el margen por defecto */
    }
    h1, p {
        font-size: 27px;
        color: gold;
        background-color: rgba(128, 128, 128, 0.319);
    }
    #contador {
      position: fixed;
      top: 10px;
      right: 10px;
      color: white;         /* Color del texto en blanco */
      font-size: 1em;     /* Tamaño del texto */
      background-color: rgba(0, 0, 0, 0.5); /* Fondo semitransparente */
      padding: 10px;        /* Espaciado interno */
      border-radius: 5px;   /* Bordes redondeados */
    }
</style>
<script>
        // Temporizador de 1 hora que persiste entre páginas
        let tiempo = localStorage.getItem('tiempoRestante') || 3600;

        function actualizarTemporizador() {
            const minutos = Math.floor(tiempo / 60);
            const segundos = tiempo % 60;
            document.getElementById('temporizador').innerText = 
                ${minutos.toString().padStart(2, '0')} : ${segundos.toString().padStart(2, '0')};
            
            if (tiempo > 0) {
                tiempo--;
                localStorage.setItem('tiempoRestante', tiempo); 
            } else {
                clearInterval(intervalo);
                alert("¡El tiempo ha terminado!");
                localStorage.removeItem('tiempoRestante');
            }
        }

        const intervalo = setInterval(actualizarTemporizador, 1000);
        actualizarTemporizador();
    </script>

<body>

    <div style="text-center" id="contador" ></div>

    <div class="container">
        <center>
            <h1>Bienvenidos al Reino de las Sombras:</h1>
        </center>
        <div class="row">
            <div class="col-md-6 textoIzquierda">
                <p><strong><u>Introducción:</u></strong><br><br>
                    En un mundo donde la luz y la oscuridad coexisten en un delicado equilibrio, existe un antiguo reino llamado Luminara, un lugar donde los habitantes viven en armonía con la magia y la naturaleza. Sin embargo, esta paz se ha visto amenazada por la aparición de un misterioso artefacto conocido como el Espejo de las Sombras. Se dice que este espejo tiene el poder de absorber la luz y sumergir el reino en una penumbra eterna.
                    Hace siglos, los Guardianes de la Luz, un grupo de valientes guerreros y sabios magos, lograron sellar el espejo en las profundidades de la Cripta de las Sombras, un laberinto lleno de trampas y enigmas.
                    <br><br><br>
                </p>
            </div>
            <div class="col-md-6 textoDerecha">
                <p>Sin embargo, la leyenda cuenta que un grupo de aventureros, atraídos por la promesa de poder, logró romper el sello y liberar al espejo. Desde entonces, Luminara ha caído en la desesperación, y criaturas oscuras han comenzado a acechar las aldeas.
                    Como miembros de la Orden de los Destellos, un grupo de héroes elegidos por el destino, su misión es recuperar el Espejo de las Sombras y restaurar la luz en el reino. Para ello, deberán infiltrarse en la Cripta, enfrentarse a sus propios miedos y resolver los antiguos acertijos que protegen el artefacto.
                    El tiempo es limitado, y la oscuridad se cierne sobre Luminara. ¿Tendrán el valor y la astucia necesarios para desentrañar los secretos de la Cripta de las Sombras y salvar su hogar antes de que sea demasiado tarde? La aventura comienza ahora. ¡Que la luz los guíe!</p>
            </div>
        </div>
        <!-- Contenedor de botones -->
        <div class="row">
            <div class="col text-start">
                <form method="POST">
                    <input type="submit" name="namee" value="Ir al Bosque Perdido!" formaction="ReinoDelBosquePerdido.php" class="btn btn-primary">
                </form>
            </div>
            <div class="col text-end">
                <form method="POST">
                    <input type="submit" name="namee" value="Ir al Castillo Oscuro!" formaction="ReinoDeLCastilloOscuro.php" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
</body>
</html>