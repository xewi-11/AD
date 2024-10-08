<?php
//SE GUARDAN LAS COSAS QUE VAN VIAJANDO
var_export($_POST);
$nombre="";

if(count ($_POST)==0){
    echo 'primera vez'
    $nombre = "Jaimito"
}else{
    $nombre = $_POST['el_nombre'];
    'es la segunda o sucesivas'
}

echo "el noombre es".$nombre; 
?>

<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    <meta charset="UTF-8">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <form method="POST" action = "unico.php">
        <input type="hidden" name ="el_nombre" value="<?php echo $nombre  ?>"/>
        <input type="submit" name="boton1" value="dame!"/>
    </form>
</body>    
</html>