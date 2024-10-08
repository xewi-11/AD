<?php
  
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
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        
        .container {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .error {
            color: #f00;
            font-weight: bold;
        }
        
        .success {
            color: #0f0;
            font-weight: bold;
        }
        
        .message {
            font-size: 18px;
            font-style: italic;
        }
        
        .form-control {
            margin-bottom: 20px;
        }
        
        .btn-primary {
            background-color: #4CAF50;
            border-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 5px;
        }
        
        .btn-primary:hover {
            background-color: #3e8e41;
            border-color: #3e8e41;
        }
        
        .image-container {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .image-container img {
            width: 400px;
            height: 400px;
            border-radius: 10px;
        }
    </style>
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
        $aux=0;
        if (isset($_POST['numero'])) {
            $n = $_POST['numero'];
            $aux+=1;
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


            while($n==$numero){
                if ($aux<4) {
                    echo "<p> eres muy grande</p>";
                    
                    break;
                 # code...
                }elseif($aux<8){
                    echo "<p> eres bueno</p>";
                    
                    break;
                }
                elseif($aux<12){
                    echo "<p> eres del montón</p>";
                    break;
                }
                else {
                    echo "<p> dedicate a otra cosa </P>";
                    break;
                }
            }
        }
         
       

        ?> 
        
    </form>
    <div class="image-container">
            <img src="ricky.jpeg" alt="Rick and Morty">
        </div>
</body>
</html>

