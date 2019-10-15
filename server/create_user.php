<?php

  include('conector.php');

print($_REQUEST['usuario']);
  $data['usuario'] = "'".$_POST['usuario']."'"; 
  $data['contrasena'] = "'".password_hash($_POST['contrasena'], PASSWORD_DEFAULT)."'";

  if ($_POST['activo']== true) {
    $data['activo']=1;
  }else {
    $data['activo']=0;
  }
print_r($data);
  $con = new ConectorBD('localhost','miuserweb','*Campos19');
  $response['conexion'] = $con->initConexion('agenda');

  if ($response['conexion']=='OK') {
    if($con->insertData('usuarios', $data)){
      $response['msg']="exito en la inserción";
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados";
    }
  }else {
    $response['msg']= "No se pudo conectar a la base de datos";
  }

  echo json_encode($response);
 ?>
