<?php
/**
 * Realiza la conexion con la base de datos
 **/
function connectDB(){
   $conexion = mysqli_connect("mdb-test.c6vunyturrl6.us-west-1.rds.amazonaws.com", "bsale_test", "bsale_test", "bsale_test");
    if($conexion){
        echo "La conexión de la base de datos se ha hecho satisfactoriamente";
    }else{
        echo "Ha sucedido un error inesperado en la conexión de la base de datos";
    }   
    return $conexion;
}
/**
 * Realiza la desconexion con la base de datos
 **/
function disconnectDB($conexion){

    $close = mysqli_close($conexion);

    if($close){
        echo "La desconexión de la base de datos se ha hecho satisfactoriamente";
    }else{
        echo "Ha sucedido un error inesperado en la desconexión de la base de datos";
    }   

    return $close;
}
/**
 * Realiza la consulta a la base de datos
 **/
function getArraySQL($sql){
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8");
    if(!$result = mysqli_query($conexion, $sql)) die();
    $rawdata = array();
    $i=0;
    while($row = mysqli_fetch_array($result))
    {
        $rawdata[$i] = $row;
        $i++;
    }
    disconnectDB($conexion);
    return $rawdata;
}

/**
 * Guarda el JSON para ser utilizado
 **/
    $myArray = getArraySQL('SELECT product.name as name_product, url_image as image_product, product.price, category.name as name_category  FROM product INNER JOIN category ON  product.category = category.id ORDER BY category');
    $json_string = json_encode($myArray);
    $file = 'api.json';
    file_put_contents($file, $json_string);
?>