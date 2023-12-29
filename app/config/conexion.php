<?php
class Conexion
{

  const Url = "http://localhost/sistema_facturacion/app/";
  

  //const Url = "http://109.123.245.33//seli_logistics_inventario/app/";
  public static function obtenerConexion()
  {
    try {
      // todo: Conexión de la base de datos de forma hosting
      // $db = new PDO('mysql:host=54.39.19.97;dbname=inventario_cfi', 'cfi_user', 'cfi_user2022');
      // todo: Conexión de la base de datos de forma local
      //$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
      $db = new PDO('mysql:host=localhost;dbname=base_comercios', 'root', '');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $db;
    
      //echo "Conectado";
    } catch (PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
    }
  }

  public static function Conectar(){
    define('servidor','localhost');
    define('nombre_bd','base_comercios');
    define('usuario','root');
    define('password','');         
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    
    try{
       $conexion = new PDO("mysql:host=".servidor.";dbname=".nombre_bd, usuario, password, $opciones);             
       return $conexion; 
    }catch (Exception $e){
        die("El error de Conexión es :".$e->getMessage());
    }         
}
  const ENVIRONMENT = 1; // Local: 0, Produccón: 1;


  //Datos envio de correo
  const NOMBRE_REMITENTE = "CREPD-S";
  const EMAIL_REMITENTE = "no-reply@credp-s.net.ec";
  const NOMBRE_EMPESA = "CREPD-S";
  const WEB_EMPRESA = "www.credp-s.net.ec";
  /*telefono de contato: Richard Tipantuña 0987139033 correo info@credp-s.net.ec*/
}

