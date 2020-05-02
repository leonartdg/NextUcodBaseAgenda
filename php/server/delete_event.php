<?php
	
  	require_once('conector.php');

    $con = new ConectorBD();
	  $respuesta['msg'] = $con->iniciarConexion();

  	if ($respuesta['msg'] == 'OK') {
      $condicion = "id='".$_POST['id']."'";
      if($con->eliminarRegistro('eventos', $condicion)){
          $respuesta['estado'] = "El evento se ha eliminado exitosamente";
      }else {
          $respuesta['estado'] = "Hubo un error y los datos no se han eliminado";
      }
   	}else {
    	$respuesta['estado'] = "Error E-003 en la comunicación con el servidor";
  	}
    $con->cerrarConexion();
  	echo json_encode($respuesta);
?>