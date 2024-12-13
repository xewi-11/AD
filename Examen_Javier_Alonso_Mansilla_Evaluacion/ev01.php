<?php
session_start();

// Inicialización del juego
if (!isset($_SESSION['campo'])) {
    $_SESSION['campo'] = str_split("********O********"); // Campo inicial
    $_SESSION['posicion'] = 8; 
    $_SESSION['activo'] = true; 
}

// Función para renderizar el campo
function renderCampo($campo) {
    return implode("", $campo);
}

// Manejador de movimientos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $campo = $_SESSION['campo'];
    $posicion = $_SESSION['posicion'];
    $activo = $_SESSION['activo'];

    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        if ($accion === 'control') {
            // Cambiar el estado del comecocos (mayúscula/minúscula)
            if ($activo) {
                $campo[$posicion] = 'o';
            } else {
                $campo[$posicion] = 'O';
            }
            $activo = !$activo;
        } elseif ($activo) {
            if ($accion === 'izquierda' && $posicion > 0) {
               
                $nuevoPos = $posicion - 1;

                if ($campo[$nuevoPos] === '*') {
                    
                    $campo[$nuevoPos] = 'O';
                } else {
                  
                    $campo[$nuevoPos] = $campo[$posicion];
                }
                // Limpiar la posición anterior
                $campo[$posicion] = ' ';
                $posicion = $nuevoPos;
            } elseif ($accion === 'derecha' && $posicion < count($campo) - 1) {
                // Movimiento a la derecha
                $nuevoPos = $posicion + 1;

                if ($campo[$nuevoPos] === '*') {
                    // Comer asterisco
                    $campo[$nuevoPos] = 'O';
                } else {
                    // Simplemente moverse
                    $campo[$nuevoPos] = $campo[$posicion];
                }
                // Limpiar la posición anterior
                $campo[$posicion] = ' ';
                $posicion = $nuevoPos;
            }
        }
    }


    $_SESSION['campo'] = $campo;
    $_SESSION['posicion'] = $posicion;
    $_SESSION['activo'] = $activo;

 
    if (!in_array('*', $campo)) {
        $_SESSION['fin'] = true;
    }
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comecocos</title>
</head>
<body>
    <form method="post">
        <input type="text" value="<?php echo renderCampo($_SESSION['campo']); ?>" readonly size="17">
        <br>
        <?php if (!isset($_SESSION['fin'])): ?>
            <button type="submit" name="accion" value="izquierda">Izquierda</button>
            <button type="submit" name="accion" value="control">Control</button>
            <button type="submit" name="accion" value="derecha">Derecha</button>
        <?php else: ?>
            <p>FIN!</p>
        <?php endif; ?>
    </form>
</body>
</html>
