<?php
  var_export($_POST);
    if (isset($_POST['numero'])){
       $numero=$_POST['aleatorio'];
    } else 
    {
    $numero = rand(1, 100);
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guess the Number</title>
</head>
<body>
    
    <form name="gy" action="ALTABAJA.php" method="POST">
   
        <div class="mb-3">
            <label class="form-label">Escribe un numero del 1 al 100</label>
            <input type="number" name="numero" class="form-control"  min="1" max="100">
            <input type="hidden" name="aleatorio" class="form-control" value="<?php echo $numero  ?>" min="1" max="100">
            <button type="submit" class="btn btn-primary">Boton</button>
        </div>
        <?php
        if (isset($_POST['numero'])) {
            $n = $_POST['numero'];
            if ($n > $numero) {
                echo "<p>El numero es menor</p>";
            } elseif ($n < $numero) {
                echo "<p>El numero es mayor</p>";
            } else {
                echo "<p>Enhorabuena, de la buena</p>";
            }
            if ($n != $numero) {
                echo "<p>Intente de nuevo</p>";
            }
        }
        ?> 
    </form>
</body>
</html>

