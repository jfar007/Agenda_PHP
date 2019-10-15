<?php
  

require('./conector.php');


session_start();

if(isset($_SESSION['usuario'])){
    
    $con = new ConectorBD('localhost','miuserweb','*Campos19');
    


    if ($con->initConexion('agenda')=='OK') {

        $data['id_usuario'] = $_SESSION['usuario'];
        $data['título'] = "'".$_POST['titulo']."'";
        $data['fecha_inicio'] = "'".$_POST['start_date']."'";
        $data['hora_inicio'] = "'".$_POST['start_hour']."'";
        $data['fecha_fin'] = "'".$_POST['end_date']."'";
        $data['hora_fin'] = "'".$_POST['end_hour']."'";
        $data['dia_completo'] = $_POST['allDay'];
        $response['allDay']= $_POST['allDay'];
        if ($con->insertData('eventos', $data)) {
            $response['msg']= 'OK';
        }else {
            $response['msg']= 'No se pudo realizar la inserción de los datos';
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
