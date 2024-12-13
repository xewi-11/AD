<?php
require_once("dbutils1.php");

$con = conectarDB();
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["actualizar_juego"])) {
        $id_juego = $_POST["id_juego"] ?? "";
        $nombre_juego = $_POST["nombre_juego"] ?? "";
        $tematica = $_POST["tematica"] ?? "";
        $edad = $_POST["edad"] ?? "";
        $numero = $_POST["numero"] ?? "";
        $duracion = $_POST["duracion"] ?? "";
        $editorial=$_POST["EDITORIAL"] ?? "";

        if (!empty($id_juego) && !empty($nombre_juego) && !empty($tematica) && !empty($edad) && !empty($numero) && !empty($duracion)) {
            actualizarJuego($con, $id_juego, $nombre_juego, $tematica, $edad, $numero,$editorial, $duracion);
            $mensaje = "Juego actualizado correctamente.";
        } else {
            $mensaje = "Por favor, completa todos los campos.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Datos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 30px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h1 {
            color: #007BFF;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            color: green;
            margin-bottom: 20px;
        }

        .error-message {
            color: red;
            margin-bottom: 20px;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestión de Datos</h1>
        <?php if (!empty($mensaje)): ?>
            <p class="<?php echo strpos($mensaje, 'correctamente') ? 'message' : 'error-message'; ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </p>
        <?php endif; ?>
        <form method="POST" action="" class="footer">
            <h2>Actualizar Juego</h2>
            <label for="id_juego">ID del Juego</label>
            <input type="text" id="id_juego" name="id_juego" required>

            <label for="nombre_juego">Nombre del Juego</label>
            <input type="text" id="nombre_juego" name="nombre_juego" required>

            <label for="tematica">Temática</label>
            <input type="text" id="tematica" name="tematica" required>

            <label for="edad">Edad Recomendada</label>
            <input type="text" id="edad" name="edad" required>

            <label for="numero">Número de Jugadores</label>
            <input type="text" id="numero" name="numero" required>

            <label for="duracion">id EDITORIAL</label>
            <input type="text" id="EDITORIAL" name="EDITORIAL" required>

            <label for="duracion">Duración (min)</label>
            <input type="text" id="duracion" name="duracion" required>

            <button type="submit" name="actualizar_juego">Actualizar Juego</button>
        </form>
    </div>
</body>
</html>
