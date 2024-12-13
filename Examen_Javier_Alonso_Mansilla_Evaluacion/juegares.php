<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juegos con más de 3 Jugadores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #444;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        tr {
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            color: #555;
        }

        @media (max-width: 600px) {
            table {
                width: 100%;
            }

            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <?php
    require_once 'DBUTILS1.PHP';

    $con = conectarDB();

    $query = "SELECT nombre, tematica, duracion, edad, numeroJugadores FROM JUEGOS WHERE numeroJugadores > 3";
    $stmt = $con->prepare($query);
    $stmt->execute();

    echo "<h1>Juegos con más de 3 Jugadores</h1>";
    echo "<table border='1'>
            <tr>
                <th>Nombre</th>
                <th>Temática</th>
                <th>Duración (minutos)</th>
                <th>Edad mínima</th>
                <th>Número de Jugadores</th>
            </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$row['nombre']}</td>
                <td>{$row['tematica']}</td>
                <td>{$row['duracion']}</td>
                <td>{$row['edad']}</td>
                <td>{$row['numeroJugadores']}</td>
              </tr>";
    }

    echo "</table>";
    ?>
</body>
</html>
