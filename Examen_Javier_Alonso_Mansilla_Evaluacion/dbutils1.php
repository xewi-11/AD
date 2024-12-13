<?php

function conectarDB()
{
  try
  {
    $cadenaConexion ="mysql:host=localhost;dbname=juegos_de_mesa";
    $usu = "root";
    $passW = "";

    $db = new PDO ($cadenaConexion,$usu,$passW);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $db;
  }
  catch (PDOException $ex)
  {
    echo "Hay error conectando ".$ex->getMessage();
  }
}

// funcion para insertar en la tabla de editorial la cual tiene de columnas el nombre y la nacionalidad
function insertarEditorial($con, $nombre, $nacionalidad)
{
  try
  {
    $query = "INSERT INTO editoriales (NOMBRE, NACIONALIDAD) VALUES (:NOMBRE,:NACIONALIDAD)";
    $argumentos = array(":NOMBRE"=>$nombre, ":NACIONALIDAD"=>$nacionalidad);
    $stm = $con->prepare($query);
    $stm->execute($argumentos);
  }
  catch (PDOException $e)
  {
     echo " Error en insertarEditorial ".$e->getMessage();
  }
}

//funcion para insertar en la tabla de juegos la cual tiene de columnas el nombre, la tematica,la edad,el numero de jugadores,el id de la editorial y la duracion
function insertarJuego($con, $nombre, $tematica, $edad, $num,$duracion,$id_editorial){
  try
  {
    $query = "INSERT INTO juegos (NOMBRE, Tematica, EDAD, NUMEROJUGADORES, DURACION, ID_EDITORIAL) VALUES (:NOMBRE, :TEMATICA, :EDAD, :NUM, :DURACION, :ID_EDITORIAL)";
    $argumentos = array(":NOMBRE"=>$nombre, ":TEMATICA"=>$tematica, ":EDAD"=>$edad, ":NUM"=>$num, ":DURACION"=>$duracion,":ID_EDITORIAL"=>$id_editorial);
    $stm = $con->prepare($query);
    $stm->execute($argumentos);
  }
  catch (PDOException $e)
  {
     echo " Error en insertarJuego ".$e->getMessage();
  }
}

  function ultimaEditorial($con){
    try{
        $query = "SELECT MAX(ID) FROM editoriales";
        $stm = $con->prepare($query);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return $result['MAX(ID)'];
        
    }catch(PDOException $e){
        echo "Error en ultimaEditorial ".$e->getMessage();
      
        return null;
        }
       

}






//creaar el metodo de arriba
function actualizarJuego($con, $id_juego, $nombre_juego, $tematica,$edad,$numero,$duracion,$num_editorial){
    try{
        $query = "UPDATE juegos SET  tematica = :TEMATICA, edad = :EDAD, numeroJugadores = :NUM, :id_editorial = :ID ,duracion = :DURACION WHERE NOMBRE = :NOMBRE";
        $argumentos = array( ":TEMATICA"=>$tematica, ":EDAD"=>$edad, ":NUM"=>$numero, ":ID"=>$num_editorial, ":DURACION"=>$duracion, ":ID"=>$id_juego,":NOMBRE"=>$nombre_juego);
        $stm = $con->prepare($query);
        $stm->execute($argumentos);
    }catch(PDOException $e){
        echo "Error en actualizarJuego ".$e->getMessage();
    
    }   
}


// consulta para coger la ultima editorial añadida a la base de datos y gyardarla en una variable que pueda usar en otros metodos
