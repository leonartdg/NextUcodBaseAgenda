<?php
	
  	require_once('conector.php');

    $datos = array(
    'date_home' => $_POST['start_date'],
    'hour_home' => $_POST['start_hour'],
    'date_end' => $_POST['end_date'],
    'hour_end' => $_POST['end_hour']);

    $con = new ConectorBD();
	  $respuesta['msg'] = $con->iniciarConexion();

  	if ($respuesta['msg'] == 'OK') {
      $condicion = 'id="'.$_POST['id'].'"';
      if($con->actualizarRegistro('eventos', $datos, $condicion)){
          $respuesta['estado'] = "El evento se ha actualizado exitosamente";
      }else {
          $respuesta['estado'] = "Hubo un error y los datos no se han actualizado";
      }
   	}
    $con->cerrarConexion();
  	echo json_encode($respuesta);
?>