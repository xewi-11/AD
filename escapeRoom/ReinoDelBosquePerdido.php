<?php


// Verificar si el código ya ha sido asignado
$codigoBosque="27ch";
$_SESSION["codigo_bosque"]=$codigoBosque;

// Verificar si se han enviado datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los valores de los select
    $s1 = $_POST['sCandado1'];
    $s2 = $_POST['sCandado2'];
    $s3 = $_POST['sCandado3'];
    $s4 = $_POST['sCandado4'];

    // Verificar si se ha ingresado un código
    if ($s1 != null || $s2 != null || $s3 != null || $s4 != null) {
        $codigoIntroducido = $s1 . $s2 . $s3 . $s4;

        // Comprobar si el código introducido es correcto
        if ($codigoIntroducido == $_SESSION["codigo_bosque"]) {
            $mensaje = "Has acertado el código! Has matado al dragon.";
        } else {
            $mensaje = "Has fallado el código. Inténtalo de nuevo.";
        }
    }
}




?>


<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<style>
    body {
       background-image: url('bosquePerdido.webp'); /* Cambia la ruta a tu imagen */
       background-color: black;
        background-size: cover; /* Ajusta la imagen para cubrir todo el fondo */
        background-position: center; /* Centra la imagen */
        background-repeat: no-repeat; /* Evita que la imagen se repita */
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
            <h1>Bienvenidos al Reino del Bosque Perdido. Estais preparados para ayudar a matar al dragón nefrario.El dios de la muerte os espera</h1>
        </center>
      <div>
        <p>Para comenzar, lea estas instrucciones:</p>
          <ul>
            <li>Para matar al dragon deberan adivinar un codigo:</li>
            <li>El codigo se compone de 4 caracteres.</li>
            <li>Si adivinan correctamente el codigo, el dragon morira.</li>
            <li>El dragon cuenta con dos alas de oro, 7 garras de marfil de obsidiana.</li>
            <li>Le encanta quemar Cucarachas como vosotros.Ademas de beber H2o.</li>
            <li>El juego acabará cuando todos los dragones esten muertos o se acaben los intentos.</li>
          </ul>
      </div>
      <div>
  <form action="ReinoDelBosquePerdido.php" method="POST">
   <p>
    <label >Ingrese el codigo:</label><br><br>
    <select name="sCandado1">
    <option value=""></option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        </select>
        
    <select name="sCandado2">
        <option value=""></option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        
    </select>

    <select name="sCandado3">
        <option value="a">a</option>
        <option value="b">b</option>
        <option value="c">c</option>
        <option value="d">d</option>
        <option value="h">h</option>
        <option value="l">l</option>
        <option value="p">p</option>
    </select>

    <select name="sCandado4">
    <option value="a">a</option>
        <option value="b">b</option>
        <option value="c">c</option>
        <option value="d">d</option>
        <option value="h">h</option>
        <option value="l">l</option>
        <option value="p">p</option>
    </select>

</p>
    
         
        <input type="submit" value="Adivinar">
        <p id="result">
            <?php
            if (isset($mensaje)) {
                echo $mensaje;
            }
            ?>
        </p>
    </form>
 <form action="ReinoDeLosSheks.php" method=POST>
    <div class="escondido">
        <input type="submit" name="pasarPagina" value="damee!">
    </div>
    </form>
</body>
</html>
