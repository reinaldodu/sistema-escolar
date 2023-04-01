<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idevaluacion = $_POST['idevaluacion'];

    $sql = "SELECT * FROM evaluaciones WHERE evaluacion_id = ?";
    $query = $pdo->prepare(($sql));
    $query->execute(array($idevaluacion));
    $data = $query->fetch(PDO::FETCH_ASSOC);

    if(!empty($data)){
        $sql_update = "DELETE FROM evaluaciones WHERE evaluacion_id = ?";
        $query_update = $pdo->prepare($sql_update);
        $result = $query_update->execute(array($idevaluacion));

        if($result){
            $arrResponse = array('status' => true,'msg' => 'Eliminado Correctamente');
        } else {
            $arrResponse = array('status' => false,'msg' => 'Error al eliminar');
        }
    } else {
        $arrResponse = array('status' => false,'msg' => 'No se puede eliminar una evaluacion que no existe');
    }

    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
}