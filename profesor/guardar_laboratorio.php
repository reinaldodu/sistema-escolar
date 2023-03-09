<?php
require_once '../includes/conexion.php';

    //verificar si existe la se recibe la imagen y se guarda en la carpeta images/laboratorios
    // if (!empty($_FILES['imagen']['name'])) {
    //     $imagen = $_FILES['imagen']['name'];
    //     $ruta = $_FILES['imagen']['tmp_name'];
    //     $destino = "images/laboratorios/" . $imagen;
    //     copy($ruta, $destino);
    // }
    // else{
    //     $imagen = "images/laboratorios/default.png";
    // }

    //campos estaticos
    $titulo = $_POST['titulo'];
    $imagen = $_POST['imagen'];
    $descripcion = $_POST['descripcion'];
    $objetivos = $_POST['objetivos'];
    
   //campos dinamicos obligatorios
   if (isset($_POST['input_array_titulo']) && isset($_POST['input_array_imagen']) && isset($_POST['input_array_descripcion'])) {
    $input_array_titulo = $_POST['input_array_titulo'];
    $input_array_imagen = $_POST['input_array_imagen'];
    $input_array_descripcion = $_POST['input_array_descripcion'];
    }
    //campos dinamicos opcionales
    if (isset($_POST['input_array_codigo'])) {
        $input_array_codigo = $_POST['input_array_codigo'];
    }
    else{
        $input_array_codigo = "";
    }
    if (isset($_POST['input_array_codigou'])) {
        $input_array_codigou = $_POST['input_array_codigou'];
    }
    else{
        $input_array_codigou = "";
    }
    
    //Se insertan los campos estaticos en la tabla laboratorios
    $sql = "INSERT INTO laboratorios (titulo, imagen, descripcion, objetivos) VALUES ('$titulo', '$imagen', '$descripcion', '$objetivos')";
    $query = $pdo->prepare(($sql));
    $query->execute();
  
    //Se existen los campos dinamicos obligatorios se insertan en la tabla laboratorios
    if (isset($input_array_titulo) && isset($input_array_imagen) && isset($input_array_descripcion)) {
        for ($i = 0; $i < count($input_array_titulo); $i++) {
            $sql = "INSERT INTO laboratorios (titulo, imagen, descripcion, objetivos, codigo, codigou) VALUES ('$input_array_titulo[$i]', '$input_array_imagen[$i]', '$input_array_descripcion[$i]', '$objetivos', '$input_array_codigo[$i]', '$input_array_codigou[$i]')";
            $query = $pdo->prepare(($sql));
            $query->execute();
        }
    }
    //Se cierra la conexion
    $pdo = null;
?>