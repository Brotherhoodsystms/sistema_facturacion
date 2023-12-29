<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Emisor extends Conexion
{
  public static function obtenerEmisor()
  {
    try {
      $sql = "SELECT * FROM tbl_emisor";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerEmisorId($id_emisor)
  {
    try {
      $sql = "SELECT * FROM tbl_emisor wher
      WHERE id=:id_emisor";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(':id_emisor', $id_emisor);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarRucEmisor($ruc)
  {
    try {
      $sql = "SELECT * FROM tbl_emisor where ruc=:ruc";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ruc", $ruc);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarSucursal($id_sucursal)
  {
    try {
      $sql = "SELECT * FROM tbl_emisor where id_sucursal=:id_sucursal";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_sucursal", $id_sucursal);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarEmisor($data)
  {
    try {
      $sql = "INSERT INTO tbl_emisor(ruc,ambiente,tipoEmision,razonSocial,nombreComercial,direccionMatriz,contribuyenteEspecial,obligadoContabilidad,dirLogo,dirFirma,dirDocAutorizados,dirDocNoAutorizados,dirDocFirmados,dirDocPdf,passFirma,regimenMicroempresa,regimenRimpe,regimenRimpe1,resolucionAgenteRetencion,id_sucursal)VALUES(:ruc,:ambiente,:tipoEmision,:razonSocial,:nombreComercial,:direccionMatriz,:contribuyenteEspecial,:obligadoContabilidad,:dirLogo,:dirFirma,:dirDocAutorizados,:dirDocNoAutorizados,:dirDocFirmados,:dirDocPdf,:passFirma,:regimenMicroempresa,:regimenRimpe,:regimenRimpe1,:resolucionAgenteRetencion,:id_sucursal);";

      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ruc", $data["emisor_ruc"]);
      $query->bindParam(":ambiente", $data["emisor_ambiente"]);
      $query->bindParam(":tipoEmision", $data["emisor_tipoEmision"]);
      $query->bindParam(":razonSocial", $data["emisor_razon_social"]);
      $query->bindParam(":nombreComercial", $data["emisor_ncomercial"]);
      $query->bindParam(":direccionMatriz", $data["emisor_direcion"]);
      $query->bindParam(":contribuyenteEspecial", $data["emisor_contribuyenteEspecial"]);
      $query->bindParam(":obligadoContabilidad", $data["emisor_obligadoContabilidad"]);
      $query->bindParam(":dirLogo", $data["emisor_logo"]);
      $query->bindParam(":dirFirma", $data["emisor_firma"]);
      $query->bindParam(":dirDocAutorizados", $data["rutaautorizados"]);
      $query->bindParam(":dirDocNoAutorizados", $data["dirDocNoAutorizados"]);
      $query->bindParam(":dirDocFirmados", $data["dirsi_firmado"]);
      $query->bindParam(":dirDocPdf", $data["dirPdf"]);
      $query->bindParam(":passFirma", $data["emisor_passFirma_first"]);
      $query->bindParam(":regimenMicroempresa", $data["regimenRimpe2"]);
      $query->bindParam(":regimenRimpe", $data["emisor_regimenRimpe"]);
      $query->bindParam(":regimenRimpe1", $data["emisor_regimenRimpe1"]);
      $query->bindParam(":resolucionAgenteRetencion", $data["emisor_resolucionAgenteRetencion"]);
      $query->bindParam(":id_sucursal", $data['id_sucursal']);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function eliminarEmisor($id_emisor)
  {
    try {
      $sql = "DELETE FROM tbl_emisor WHERE id=:id_emisor";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_emisor", $id_emisor);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
