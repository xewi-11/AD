<?php
// Inicializar variables
$mensaje = "";
$acierto1 = false;
$acierto2 = false;

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener las respuestas seleccionadas por el usuario
    $respuesta1 = isset($_POST['respuesta1']) ? $_POST['respuesta1'] : '';
    $respuesta2 = isset($_POST['respuesta2']) ? $_POST['respuesta2'] : '';

    // Comprobar si ambas respuestas son correctas
    if ($respuesta1 === 'veneno') {
        $acierto1 = true;
    }
    if ($respuesta2 === 'luz') {
        $acierto2 = true;
    }

    // Determinar el mensaje a mostrar
    if ($acierto1 && $acierto2) {
        $mensaje = "¡Correcto! Has descubierto la habilidad y debilidad de las arañas. ¡Avanzas a la siguiente sala!";
    } else {
        $mensaje = "Respuesta incorrecta... Las arañas siguen acechándote. ¡Intenta de nuevo!";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Escape Room: El Reino de Arácvida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<style>
    .container {
        background-color: #2c3e50;
        border-radius: 10px;
        padding: 20px;
        width: 400px;
        margin: 0 auto;
    }
    body {
        background-image: url('reinoArañas.webp'); /* Cambia la ruta a tu imagen */
        background-color: black;
        background-size: cover;
        background-position: center;
        background-repeat: repeat;
        height: 100vh;
        margin: 0;
    }
    h1, p, label {
        font-size: 27px;
        color: orange;
        background-color: rgba(0, 0, 0, 0.5);
        padding: 5px;
        border-radius: 5px;
    }
    #temporizador {
        position: fixed;
        top: 10px;
        right: 10px;
        color: white;
        font-size: 1em;
        background-color: rgba(0, 0, 0, 0.5);
        padding: 10px;
        border-radius: 5px;
    }
    .input-container {
        margin: 20px 0;
    }
    input[type="radio"] {
        margin-right: 10px;
    }
    input[type="submit"] {
        padding: 10px 20px;
        background-color: #e74c3c;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    h1 {
        color: #e67e22;
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

<div class="container">
    <h1>Escape Room: El Reino de Arácvida</h1>
    <p>Para avanzar, responde correctamente ambas preguntas:</p>
    
    <form method="POST">
        <div class="input-container">
            <label>¿Cuál es la habilidad principal de las arañas venenosas?</label><br>
            <input type="radio" id="opcion1" name="respuesta1" value="telaraña">
            <label for="opcion1">Crear telarañas</label><br>
            
            <input type="radio" id="opcion2" name="respuesta1" value="veneno">
            <label for="opcion2">Veneno</label><br>
            
            <input type="radio" id="opcion3" name="respuesta1" value="salto">
            <label for="opcion3">Salto</label><br>
            
            <input type="radio" id="opcion4" name="respuesta1" value="camuflaje">
            <label for="opcion4">Camuflaje</label>
        </div>
        
        <div class="input-container">
            <label>¿Cuál es la principal debilidad de las arañas?</label><br>
            <input type="radio" id="opcion5" name="respuesta2" value="luz">
            <label for="opcion5">Luz</label><br>
            
            <input type="radio" id="opcion6" name="respuesta2" value="agua">
            <label for="opcion6">Agua</label><br>
            
            <input type="radio" id="opcion7" name="respuesta2" value="oscuridad">
            <label for="opcion7">Oscuridad</label><br>
            
            <input type="radio" id="opcion8" name="respuesta2" value="frio">
            <label for="opcion8">Frío</label>
        </div>

        <input type="submit" value="Enviar">
    </form>
    
    <?php if (!empty($mensaje) && $acierto1 && $acierto2): ?>
    <form action="habitacionFelicitaciones.php" method="POST">
        <input type="submit" name="botonPasar" value="Ir a la habitacion final">
    </form>
<?php endif; ?>
</div>

<div id="temporizador"></div>

</body>
</html>
