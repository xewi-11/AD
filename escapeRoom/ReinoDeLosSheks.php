<?php
$orden="colmillos,telequinesis,venenosas,ojos que hielan,voladoras";
$mensaje="";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los valores de los select
    $s1 = $_POST['palabras'];
    
    if ($orden == $s1) {
        $mensaje = "Has acertado. ¡Enhorabuena! Ahora puedes pasar al siguiente reino.";
        $mostrarBotonPasar = true; // Permitir mostrar el botón para pasar
    } else {
        $mensaje = "Has fallado. Vuelve a intentarlo.";
        $mostrarBotonPasar = false; // Esconder el botón para pasar
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
       background-image: url('sheks.webp'); /* Cambia la ruta a tu imagen */
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
            <h1>Bienvenidos al Reino de los Sheks. Estais preparados para afrontar el siguiente enigma?</h1>
        </center>
      <div>
        <p>En una era muy lejana los sheks controlaban el reino.Tal era su poder que muy pocos consiguieron sobrevir y lo que lo hicieron se convirtieron en medio sheks.
            Estos medio sheks se carecetizaban por poder cambiar la forma de su alma a voluntad y les permitian convertise tanto en shek como en humano.
            Sus armas eran las siguientes: Son unas serpientes voladoras,la cual sus ojos son de un color tan frio que te hielan, capaces de adentrarse en tu cabeza para ver cada uno de tus recuerdos,
            unos colmillos gigantescos, además tambien son venenosos.


 <!-- Mensaje del resultado -->
 <p><?php echo $mensaje; ?></p>

<!-- Formulario de orden de palabras -->
<form action="ReinoDeLosSheks.php" method="POST">
    <p>
        <label>Ordene las siguientes palabras: voladoras, ojos que hielan, telequinesis, colmillos, venenosas</label><br><br>
    </p>
    <input type="text" id="palabras" name="palabras" placeholder="ej: ojos que hielan, voladoras,..."><br><br>
    <input type="submit" value="Enviar">
</form>

<!-- Botón para pasar al siguiente reino -->
<?php if (!empty($mensaje) && $mostrarBotonPasar): ?>
    <form action="ReinoDeLosHipogrifos.php" method="POST">
        <input type="submit" name="botonPasar" value="Ir al Reino de los Hipogrifos">
    </form>
<?php endif; ?>
</div>
</div>
</body>
</html>