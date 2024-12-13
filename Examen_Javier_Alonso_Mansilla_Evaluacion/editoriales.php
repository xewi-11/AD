<?php
require_once 'DBUTILS1.PHP';

$con = conectarDB();

$query = "SELECT ed.nombre AS NOMBREEDITORIAL, ju.nombre AS NOMBREJUEGO, ju.tematica AS TEMATICAJUEGO 
          FROM editoriales ed
          LEFT JOIN juegos ju ON ed.id = ju.id_editorial";
$stmt = $con->prepare($query);
$stmt->execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editoriales y Juegos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
            color: #555;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>Editoriales y sus Juegos</h1>
    <table>
        <tr>
            <th>Nombre Editorial</th>
            <th>Nombre Juego</th>
            <th>Temática Juego</th>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['NOMBREEDITORIAL']); ?></td>
            <td><?php echo htmlspecialchars($row['NOMBREJUEGO']); ?></td>
            <td><?php echo htmlspecialchars($row['TEMATICAJUEGO']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
