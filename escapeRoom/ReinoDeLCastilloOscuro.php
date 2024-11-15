<?php
// Inicializar variables
$mensaje = "";
$acierto = false;

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener la respuesta del usuario
    $respuesta = isset($_POST['respuesta']) ? strtolower(trim($_POST['respuesta'])) : '';

    // Comprobar la respuesta (en este caso, la respuesta correcta es "piedra")
    if ($respuesta === 'piedra') {
        $acierto = true;
        $mensaje = "¡Correcto! Has roto la maldición del castillo y ahora puedes salir.";
    } else {
        $mensaje = "Respuesta incorrecta... La maldición sigue acechando el castillo. ¡Intenta de nuevo!";
    }
    
}
?>


<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<style>
        .container {
            background-color: #34495e;
            border-radius: 10px;
            padding: 20px;
            width: 400px;
            margin: 0 auto;
        }
    body {
       background-image: url('castilloOscuro.webp'); /* Cambia la ruta a tu imagen */
       background-color: black;
        background-size: cover; /* Ajusta la imagen para cubrir todo el fondo */
        background-position: center; /* Centra la imagen */
        background-repeat: repeat; /* Evita que la imagen se repita */
        height: 100vh; /* Asegura que el body tenga al menos la altura de la ventana */
        margin: 0; /* Elimina el margen por defecto */
    }
    h1, p,ul,label {
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
        .input-container {
            margin: 20px 0;
        }
        input[type="text"] {
            padding: 10px;
            width: 80%;
            border: none;
            border-radius: 5px;
            margin-right: 10px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #1abc9c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        h1 {
            color: #e74c3c;
        }
        .mensaje {
            font-size: 18px;
            margin-top: 20px;
            font-weight: bold;
        }
</style>
<script>
        // Recuperar el tiempo restante de localStorage
        let tiempo = localStorage.getItem('tiempoRestante');

        // Verifica si el temporizador está configurado
        if (!tiempo) {
            alert("Por favor, inicia el temporizador desde la página principal.");
            window.location.href = 'index.php';
        }

        function actualizarTemporizador() {
            const minutos = Math.floor(tiempo / 60);
            const segundos = tiempo % 60;
            document.getElementById('temporizador').innerText = 
                ${minutos.toString().padStart(2, '0')} : ${segundos.toString().padStart(2, '0')};
            
            if (tiempo > 0) {
                tiempo--;
                localStorage.setItem('tiempoRestante', tiempo); // Guardar el tiempo restante
            } else {
                clearInterval(intervalo);
                alert("¡El tiempo ha terminado!");
                localStorage.removeItem('tiempoRestante'); // Quitar tiempo al finalizar
            }
        }

        const intervalo = setInterval(actualizarTemporizador, 1000);
        actualizarTemporizador(); // Llamada inicial para mostrar el tiempo inmediatamente
    </script>
<body>
<div style="text-center" id="contador" ></div>

<div class="container">
        <center>
            <h1>Bienvenidos al Reino del Castillo Oscuro. Estais preparados?</h1>
        </center>
      <div>
        <p>"La Noche del Castillo Oscuro"

La tormenta ruge fuera de las antiguas murallas del castillo, haciendo crujir las maderas y resonar en cada rincón sombrío. Hace siglos, este lugar fue hogar de nobles y poderosos, pero hoy solo quedan sombras, secretos olvidados y una atmósfera que hiela hasta los huesos. Los ecos de los pasos resuenan en los pasillos vacíos, y cada rincón parece esconder una historia oscura.

Recientemente, un antiguo manuscrito ha llegado a tus manos, revelando una terrible verdad: una maldición que ha sido arrastrada por generaciones. Nadie ha osado adentrarse en el castillo en décadas, y aquellos que lo intentaron, nunca regresaron.

Ahora, en medio de la tormenta, os encontráis frente a sus imponentes puertas de hierro, con la llave que alguna vez se pensó perdida. Unos pocos os habéis reunido, dispuestos a descubrir qué sucedió en sus pasillos olvidados y romper la maldición que ha caído sobre este lugar.

Pero no estáis solos. Algo más se esconde entre sus paredes, y no todo lo que brilla es oro... ni lo que se ve es lo que parece. El reloj avanza, y el tiempo juega en vuestra contra. Solo una salida… pero ¿seréis capaces de encontrarla antes de que el castillo se cierre para siempre?


 <!-- Mensaje del resultado -->
 <p><?php echo $mensaje; ?></p>


    <h1>Escape Room: El Reino</h1>
    <div class="container">
        <p>En la oscuridad del castillo, te enfrentas a un acertijo antiguo. Responde correctamente para romper la maldición.</p>
        <p><strong>Pregunta:</strong> ¿Qué objeto debe ser colocado en el altar para romper la maldición del castillo?</p>

        <!-- Formulario de entrada -->
        <form method="POST" action="ReinoDeLCastilloOscuro.php">
            <div class="input-container">
                <input type="text" name="respuesta" placeholder="Escribe tu respuesta..." required>
            </div>
            <input type="submit" value="Comprobar Respuesta">
        </form>

        <!-- Mensaje según la respuesta -->
        <?php if (!empty($mensaje) &$acierto): ?>
            <div class="mensaje">
                <?php echo $mensaje; ?>
                <form action="ElReinoFantasma.php" method=POST>
              <div class="escondido">
                <input type="submit" name="pasarPagina" value="damee!">
              </div>
              </form>
            </div>
        <?php endif; ?>
    </div>
    </div>
    
    
</div>
</body>
</html>