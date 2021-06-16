<?php
function connectDB(){

   $conexion = mysqli_connect("mdb-test.c6vunyturrl6.us-west-1.rds.amazonaws.com", "bsale_test", "bsale_test", "bsale_test");
    if($conexion){
        echo "<script>console.log('La conexión de la base de datos se ha hecho satisfactoriamente');</script>";
    }else{
        echo "<script>console.log('Ha sucedido un error inesperado en la conexión de la base de datos');</script>";
    }   
    return $conexion;
}

function disconnectDB($conexion){

    $close = mysqli_close($conexion);

    if($close){
        echo "<script>console.log('La desconexión de la base de datos se ha hecho satisfactoriamente');</script>";
    }else{
        echo "<script>console.log('Ha sucedido un error inesperado en la desconexión de la base de datos');</script>";
    }   

    return $close;
}

function getArraySQL($sql){
    //Creamos la conexión con la función anterior
    $conexion = connectDB();

    //generamos la consulta
    

    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

    if(!$result = mysqli_query($conexion, $sql)) die(); //si la conexión cancelar programa

    $rawdata = array(); //creamos un array

    //guardamos en un array multidimensional todos los datos de la consulta
    $i=0;

    while($row = mysqli_fetch_array($result))
    {
        $rawdata[$i] = $row;
        $i++;
    }

    disconnectDB($conexion); //desconectamos la base de datos

    return $rawdata; //devolvemos el array
}

    $myArray = getArraySQL('Select * From product');
    $json_string = json_encode($myArray);
    $file = 'api.json';
    file_put_contents($file, $json_string);
    
?>