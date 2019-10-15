<?php


require('./conector.php');


session_start();

if(isset($_SESSION['usuario'])){
    
    $con = new ConectorBD('localhost','miuserweb','*Campos19');
    
    
    
    if ($con->initConexion('agenda')=='OK') {

        if ($con->eliminarRegistro('eventos', 'id='. $_POST['id'].'')) {
                $response['msg'] = 'OK';
            }else {
                $response['msg'] = 'rechazado, No actualizo ningun registro';
            }
            
    }else {
        $response['msg']= 'No se pudo conectar a la base de datos';
    }
    
    $con->cerrarConexion();
}else {
    $response['msg']= 'No se ha iniciado una sesión';
}

echo json_encode($response);


?>
