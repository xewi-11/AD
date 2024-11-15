<?php
// Inicializar variables
$mensaje = "";
$acierto = false;

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener la respuesta seleccionada por el usuario
    $respuesta = isset($_POST['respuesta']) ? $_POST['respuesta'] : '';

    // Comprobar la respuesta correcta (en este caso, la respuesta correcta es "piedra")
    if ($respuesta === 'calavera') {
        $acierto = true;
        $mensaje = "¡Correcto! Has roto la maldición del castillo y ahora puedes salir.";
    } else {
        $mensaje = "Respuesta incorrecta... La maldición sigue acechando el castillo. ¡Intenta de nuevo!";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Escape Room: Reino Fantasma</title>
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
        background-image: url('reinoFantasma.webp'); /* Cambia la ruta a tu imagen */
        background-color: black;
        background-size: cover;
        background-position: center;
        background-repeat: repeat;
        height: 100vh;
        margin: 0;
    }
    h1, p, label {
        font-size: 27px;
        color: gold;
        background-color: rgba(128, 128, 128, 0.319);
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
            minutos.toString().padStart(2, '0') + " : " + segundos.toString().padStart(2, '0');
        
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

<div class="container-fluid">
    <h1>Escape Room: Reino Fantasma</h1>
    <p>Para romper la maldición y escapar del castillo, elige la respuesta correcta:</p>
    
    <form method="POST">
        <div class="input-container">
            <label>¿Cuál es la clave para romper la maldición?</label><br>
            <input type="radio" id="opcion1" name="respuesta" value="espada">
            <label for="opcion1">Espada</label><br>
            
            <input type="radio" id="opcion2" name="respuesta" value="piedra">
            <label for="opcion2">Piedra</label><br>
            
            <input type="radio" id="opcion3" name="respuesta" value="anillo">
            <label for="opcion3">Anillo</label><br>
            
            <input type="radio" id="opcion4" name="respuesta" value="llave">
            <label for="opcion4">Llave</label><br>

            <input type="radio" id="opcion5" name="respuesta" value="calavera">
            <label for="opcion5">Calavera Patronus</label>
        </div>
        <input type="submit" value="Enviar">
    </form>
    
    <?php if (!empty($mensaje) &$acierto): ?>
            <div class="mensaje">
                <?php echo $mensaje; ?>
                <form action="ElReinoDeAracvida.php" method=POST>
              <div class="escondido">
                <input type="submit" name="pasarPagina" value="Ir al Reino de Aracvida!">
              </div>
              </form>
            </div>
        <?php endif; ?>
</div>

<div id="temporizador"></div>

</body>
</html>
