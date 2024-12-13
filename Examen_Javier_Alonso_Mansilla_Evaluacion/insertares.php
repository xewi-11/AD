<?php
require_once ("dbUtils1.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Juegos y Editorial</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f9;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            color: #555;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }
        input[type="text"],
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h1>Insertar Juegos y Editorial</h1>
<form action="" method="POST">
    <div class="section">
        <h2>Editorial</h2>
        <label for="nombreEditorial">Nombre Editorial:</label>
        <input type="text" id="nombreEditorial" name="nombreEditorial" required>

        <label for="nacionalidad">Nacionalidad:</label>
        <input type="text" id="nacionalidad" name="nacionalidad" required>
    </div>

    <div class="section">
        <h2>Juego 1</h2>
        <label for="nombreJuego1">Nombre Juego:</label>
        <input type="text" id="nombreJuego1" name="nombreJuego1" required>

        <label for="tematicaJuego1">Temática:</label>
        <input type="text" id="tematicaJuego1" name="tematicaJuego1" required>

        <label for="duracionJuego1">Duración (minutos):</label>
        <input type="number" id="duracionJuego1" name="duracionJuego1" required>

        <label for="edadJuego1">Edad mínima:</label>
        <input type="number" id="edadJuego1" name="edadJuego1" required>

        <label for="njugadoresJuego1">Número de jugadores:</label>
        <input type="number" id="njugadoresJuego1" name="njugadoresJuego1" required>

        <label for="ideditorial1">ID Editorial:</label>
        <input type="number" id="ideditorial1" name="ideditorial1" required>
    </div>

    <div class="section">
        <h2>Juego 2</h2>
        <label for="nombreJuego2">Nombre Juego:</label>
        <input type="text" id="nombreJuego2" name="nombreJuego2" required>

        <label for="tematicaJuego2">Temática:</label>
        <input type="text" id="tematicaJuego2" name="tematicaJuego2" required>

        <label for="duracionJuego2">Duración (minutos):</label>
        <input type="number" id="duracionJuego2" name="duracionJuego2" required>

        <label for="edadJuego2">Edad mínima:</label>
        <input type="number" id="edadJuego2" name="edadJuego2" required>

        <label for="njugadoresJuego2">Número de jugadores:</label>
        <input type="number" id="njugadoresJuego2" name="njugadoresJuego2" required>

        <label for="ideditorial2">ID Editorial:</label>
        <input type="number" id="ideditorial2" name="ideditorial2" required>
    </div>

    <button type="submit">Insertar</button>
</form>
</body>
</html>

<?php
require_once ("dbUtils1.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $con = conectarDB();

    if ($con) {
        try {
            // Insertar editorial
            $nombreEditorial = $_POST['nombreEditorial'];
            $nacionalidad = $_POST['nacionalidad'];
            insertarEditorial($con, $nombreEditorial, $nacionalidad);

            // Obtener ID de la editorial
            $editorialId =$_POST['ideditorial1'];

            // Insertar juegos
            insertarJuego($con, $_POST['nombreJuego1'], $_POST['tematicaJuego1'], $_POST['edadJuego1'], $_POST['njugadoresJuego1'], $_POST['duracionJuego1'], ultimaEditorial($con));
            insertarJuego($con, $_POST['nombreJuego2'], $_POST['tematicaJuego2'], $_POST['edadJuego2'], $_POST['njugadoresJuego2'], $_POST['duracionJuego2'], ultimaEditorial($con));

            echo "<script>
                    Swal.fire({
                        title: '¡Éxitoooo!',
                        text: 'Datos insertados correctamente.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                </script>";
        } catch (PDOException $e) {
            echo "<script>
                    Swal.fire({
                        title: 'Errooor',
                        text: 'Error al insertar datos: " . $e->getMessage() . "',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                </script>";
        }
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudo conectar a la base de datos.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
    }
}
?>
</body>
</html>