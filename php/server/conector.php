<?php

  class ConectorBD{
    private $host = 'localhost';
    private $user = 'ld_nextu';
    private $password = '&798,-Abf97*';
    private $nombre_db = 'db_agenda';
    private $conexion;


    function iniciarConexion(){
      $this->conexion = new mysqli($this->host, $this->user, $this->password, $this->nombre_db);
      if ($this->conexion->connect_error) {
        return "PHP Error:".$this->conexion->connect_error;
      }else {
        return "OK";
      }
    }


    function consultarDatos($tablas, $campos, $condicion = ""){
      $sqlConsulta = 'SELECT ';

      foreach ($campos as $indice => $value) {
        $sqlConsulta .= $value;
        if ($indice < count($campos)-1) {
          $sqlConsulta .= ', ';
        }else{
         $sqlConsulta .=" FROM ";
        }
      }

      foreach ($tablas as $indice => $value){
        $sqlConsulta .= $value;
        if ($indice < count($tablas)-1) {
          $sqlConsulta .= ', ';
        }else{
          $sqlConsulta .= " ";
        }
      }

      if ($condicion == ""){
        $sqlConsulta .= ";";
      }else{
        $sqlConsulta .= $condicion.";";
      }
      return $this->conexion->query($sqlConsulta);
    }


    function insertarRegistro($tabla, $datos){
      $sqlInsert = 'INSERT INTO '.$tabla;

      $sqlCampo = ' (';
      $sqlValor = ') VALUES (';
      $contador = 1;
      foreach ($datos as $indice => $value) {
        $sqlCampo .= $indice;
        $sqlValor .= '"'.$value.'"';
        if ($contador!=count($datos)) {
          $sqlCampo .= ', ';
          $sqlValor .= ', ';
        }else{
         $sqlValor .=');';
        }
        $contador += 1;
      }
      $sqlInsert .= $sqlCampo.$sqlValor;
      return $this->conexion->query($sqlInsert);
    }


    function eliminarRegistro($tabla, $condicion){
      $sqlDelete = 'DELETE FROM '.$tabla.' WHERE '.$condicion.';';
      return $this->conexion->query($sqlDelete);
    }


    function actualizarRegistro($tabla, $datos, $condicion){
      $sqlUpdate = 'UPDATE '.$tabla.' SET ';

      $sqlCampo = '';
      $contador = 1;
      foreach ($datos as $indice => $value) {
        $sqlCampo .= $indice.'="'.$value.'"';
        if ($contador<count($datos)) {
          $sqlCampo .= ', ';
        }else{
          $sqlCampo .=' WHERE ';
        }
        $contador += 1;
      }
      $sqlUpdate .= $sqlCampo.$condicion.';';
      return $this->conexion->query($sqlUpdate);
    }


    function cerrarConexion(){
      $this->conexion->close();
    }
  }
 ?>
