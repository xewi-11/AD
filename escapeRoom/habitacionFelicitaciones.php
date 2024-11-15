<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Felicidades, Héroe del Reino de las Sombras!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(120deg, #000000, #1a1a2e);
            color: #ffffff;
            text-align: center;
            padding: 50px;
            margin: 0;
        }
        h1 {
            font-size: 3em;
            color: #f4e04d;
            text-shadow: 2px 2px 10px #ff0000;
        }
        p {
            font-size: 1.5em;
            margin: 20px auto;
            width: 80%;
        }
        .congrats-container {
            padding: 20px;
            border: 2px solid #f4e04d;
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.8);
            box-shadow: 0px 0px 20px 5px #ff0000;
        }
        .spider-animation {
            width: 150px;
            height: 150px;
            margin: 20px auto;
            background: url('fotoArañaFinal.webp') no-repeat center;
            background-size: contain;
            animation: spider-move 4s infinite ease-in-out;
        }
        @keyframes spider-move {
            0% { transform: translateY(-20px); }
            50% { transform: translateY(20px); }
            100% { transform: translateY(-20px); }
        }
        .button {
            text-decoration: none;
            padding: 15px 30px;
            margin: 20px;
            color: #ffffff;
            background-color: #d00000;
            border-radius: 5px;
            font-size: 1.2em;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #ff4500;
        }
    </style>
</head>
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
    <div class="congrats-container">
        <h1>¡Felicidades!</h1>
        <div class="spider-animation"></div>
        <p>
            Has logrado superar todas las pruebas del <strong>Reino de las Sombras</strong>. 
            Has demostrado valentía, ingenio y determinación. ¡Eres un verdadero héroe!
        </p>
        <p>
            Este es el final de tu aventura... por ahora. 
            ¿Estás listo para enfrentar nuevos desafíos?
        </p>
        <a href="paginaIncio.php" class="button">Volver al inicio</a>
    </div>
</body>
</html>