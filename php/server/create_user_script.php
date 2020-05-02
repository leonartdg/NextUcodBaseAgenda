<?php

  	require_once('conector.php');

  	$datos = array(
      'nombre' => 'Luis Vera',
      'email' => 'lvera1992@gmail.com',
      'clave' => password_hash("lu1992", PASSWORD_DEFAULT),
      'nacimiento' => '1992-10-12');

    $con = new ConectorBD();
  	$respuesta = $con->iniciarConexion();

  	if ($respuesta == 'OK') {
    	if($con->insertarRegistro('usuarios', $datos)){
      		$respuesta = "exito en la inserción";
	    }else {
	      	$respuesta = "Hubo un error y los datos no han sido cargados";
	    }
  	}else {
    	$respuesta = "No se pudo conectar a la base de datos";
  	}
    $con->cerrarConexion();
?>
