<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Perfil extends Conexion
{
    public static function ObternetPerfil($id_usuario){
        try {
            $sql = "SELECT * FROM tbl_usuario WHERE  usuario_id=:id_usuario";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(":id_usuario", $id_usuario);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
          } catch (\Throwable $ex) {
            return $ex->getMessage();
          }
    }

}