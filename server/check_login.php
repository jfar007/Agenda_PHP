<?php

  require('./conector.php');

  $con = new ConectorBD('localhost','miuserweb','*Campos19');

  $response['conexion'] = $con->initConexion('agenda');
//   print($_REQUEST['usuario']);
//   print($_REQUEST['contrasena']);
  if ($response['conexion']=='OK') {
    $resultado_consulta = $con->consultar(['usuarios'],
    ['id','usuario', 'contrasena', 'activo'], 'WHERE usuario="'.$_POST['usuario'].'"');

    if ($resultado_consulta->num_rows != 0) {
      $fila = $resultado_consulta->fetch_assoc();
      $resultr  = true;
//       $resultr =  password_verify($_POST['contrasena'], $fila['contrasena']);
//       print('Resultado: '. $resultr  .  ' Verify: ' . $_POST['usuario']);
      if (password_verify($_POST['contrasena'], $fila['contrasena'])) {
        $response['msg'] = 'OK';
        session_start();
        $_SESSION['usuario']=$fila['id'];
      }else {
        $response['msg'] = 'rechazado, Contraseña incorrecta';
      }
    }else{
      $response['msg'] = 'rechazado, Usuario incorrecto';
    }
  }

  echo json_encode($response);

  $con->cerrarConexion();






 ?>
