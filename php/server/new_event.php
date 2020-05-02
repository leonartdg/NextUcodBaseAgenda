<?php
	
	session_start();
  require_once('conector.php');

	  $datos = array(
      'id_user' => $_SESSION['user_id'],
  	  'header' => $_POST['titulo'],
  	  'date_home' => $_POST['start_date'],
      'hour_home' => $_POST['start_hour'],
      'date_end' => $_POST['end_date'],
      'hour_end' => $_POST['end_hour'],
      'day_complete' => $_POST['allDay']);

    $con = new ConectorBD();
	  $respuesta['msg'] = $con->iniciarConexion();

  	if ($respuesta['msg'] == 'OK') {
    	if($con->insertarRegistro('eventos', $datos)){
        $respuesta['estado'] = "El evento se ha agregado exitosamente";
	    }else {
	      $respuesta['estado'] = "Hubo un error y los datos no han sido cargados";
	    }
  	}else {
      $respuesta['estado'] = "Error PHP-001 en la comunicación con el servidor";
    }

    $con->cerrarConexion();
  	echo json_encode($respuesta);
?>
