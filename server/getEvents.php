<?php


require('./conector.php');

$con = new ConectorBD('localhost','miuserweb','*Campos19');

$response['conexion'] = $con->initConexion('agenda');

session_start();

if(isset($_SESSION['usuario'])){
    $id_usuario =$_SESSION['usuario'];
    $response['usuario'] = $_SESSION['usuario'];
    
    $resultado_consulta = $con->consultar(['eventos'],
        ['id', 'id_usuario', 'título', 'fecha_inicio', 'hora_inicio', 'fecha_fin', 'hora_fin', 'dia_completo'], 'WHERE id_usuario="'. $id_usuario .'"');
    
    $i=0;
    while ($fila = $resultado_consulta->fetch_assoc()) {
        $response['eventos'][$i]['id']= (int) $fila['id'];
        $response['eventos'][$i]['title']=$fila['título'];
        
        if($fila['dia_completo'] == "1"){

//             $response['eventos'][$i]['start']=date("c",strtotime($fila['fecha_inicio'] .  $fila['hora_fin'] ));
            $response['eventos'][$i]['start']= $fila['fecha_inicio'] . ' ' .   $fila['hora_fin'];
            $response['eventos'][$i]['allDay']=true;
          }else{
//             $response['eventos'][$i]['start']=date("c",strtotime($fila['fecha_inicio'] .  $fila['hora_fin'] ));
            $response['eventos'][$i]['start']=$fila['fecha_inicio']  . ' ' .   $fila['hora_fin'];
//             $response['eventos'][$i]['end']=date("c",strtotime($fila['fecha_fin'] .  $fila['hora_fin'] ));   
            $response['eventos'][$i]['end']=$fila['fecha_fin']  . ' ' .  $fila['hora_fin'] ;   
        }
        $i++;
    }

    $response['msg'] = 'OK';    
    
    
    echo json_encode($response);
    $con->cerrarConexion();
    
    
    
}




 ?>
