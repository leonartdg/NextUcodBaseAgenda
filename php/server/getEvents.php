<?php
  
  session_start();
  require_once('conector.php');

	$con = new ConectorBD();
	$respuesta['msg'] = $con->iniciarConexion();

  	if ($respuesta['msg']=='OK') {
      $consulta = $con->consultarDatos(['eventos'], ['eventos.*'], 'INNER JOIN usuarios ON usuarios.id=eventos.id_user AND usuarios.id='.$_SESSION['user_id']);

      if ($consulta->num_rows <= 0) {
      	$respuesta['eventos'] = [];
    	}else{
	  		$eventos = array();
	  		while ($fila = $consulta->fetch_assoc()) {
	  			$evento = array(
            'id'=>$fila['id'],
            'user_id'=>$fila['id_user'],
            'title'=>$fila['header'],
            'start'=>$fila['date_home'].' '.$fila['hour_home'],
            'end'=>$fila['date_end'].' '.$fila['hour_end'],
            'allday'=>$fila['day_complete']);
	      	array_push($eventos, $evento);
	  		}
	  		$respuesta['eventos'] = $eventos;
    	}
    }else{
      $respuesta['estado'] = "Error PHP-004 en la comunicación con el servidor";
    }

  $con->cerrarConexion();
	echo json_encode($respuesta);
?>