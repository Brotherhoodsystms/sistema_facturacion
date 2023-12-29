<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Cierrecaja extends Conexion
{
  public static function obtenerCajachica()
  {
    try {
      $sql = "SELECT * FROM tbl_cajachica l
      INNER JOIN tbl_detallecajachica dch ON l.cajachica_id =dch.cajachica_id
      INNER JOIN tbl_gasto g on g.gasto_id=dch.gasto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function actualizarCaja($data)
  {
    try {
      $sql = "UPDATE tbl_cierrecaja SET sucursal_id=:sucursal_id,cierrecaja_serie=:cierrecaja_serie,cierrecaja_usuarioid=:tipo_usuario_id,cierrecaja_fecha_asignacion=:cierrecaja_fecha_asignacion,cierrecaja_efectivo_asignacion=:cierrecaja_efectivo_asignacion WHERE cierrecaja_id=:cierrecaja_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":sucursal_id", $data["sucursal_id"]);
      $query->bindParam(":cierrecaja_serie", $data["cierrecaja_serie"]);
      $query->bindParam(":tipo_usuario_id", $data["tipo_usuario_id"]);
      $query->bindParam(":cierrecaja_fecha_asignacion", $data["cierrecaja_fecha_asignacion"]);
      $query->bindParam(":cierrecaja_efectivo_asignacion", $data["cierrecaja_efectivo_asignacion"]);
      $query->bindParam(":cierrecaja_id", $data["cierrecaja_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function actualizarCajaEntrega($data)
  {
    try {
      $sql = "UPDATE tbl_cierrecaja SET cierrecaja_efectivo_faltante=:cierrecaja_efectivo_faltante,cierrecaja_total_movimientos=:cierrecaja_total_movimientos,cierrecaja_total_ventas=:cierrecaja_total_ventas,cierrecaja_fecha_liquidacion=:cierrecaja_fecha_liquidacion,cierrecaja_efectivo_entregado=:cierrecaja_efectivo_entregado,cierrecaja_usuario_entregado=:cierrecaja_usuario_entregado,cierrecaja_observacion=:cierrecaja_observacion,cierrecaja_estado='X'  WHERE cierrecaja_id=:cierrecaja_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cierrecaja_fecha_liquidacion", $data["cierrecaja_fecha_liquidacion"]);
      $query->bindParam(":cierrecaja_usuario_entregado", $data["cierrecaja_usuario_entregado"]);
      $query->bindParam(":cierrecaja_efectivo_entregado", $data["cierrecaja_efectivo_entregado"]);
      $query->bindParam(":cierrecaja_total_ventas", $data["cierrecaja_total_ventas"]);
      $query->bindParam(":cierrecaja_total_movimientos", $data["cierrecaja_total_movimientos"]);
      $query->bindParam(":cierrecaja_efectivo_faltante", $data["cierrecaja_efectivo_faltante"]);
      $query->bindParam(":cierrecaja_observacion", $data["cierrecaja_observacion"]);
      $query->bindParam(":cierrecaja_id", $data["cierrecaja_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function actualizarMovimientosCierreCaja($data)
  {
    try {
      $sql = "UPDATE tbl_movimientocaja SET movimiento_estado='X' WHERE usuario_id=:usuario_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":usuario_id", $data);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function actualizarMovimientoCaja($data)
  {
    try {
      $sql = "UPDATE tbl_movimientocaja SET sucursal_id=:sucursal_id,movimiento_tipo=:tipo_movimiento,movimiento_descripcion=:movimiento_descripcion,movimiento_total=:movimiento_total WHERE movimiento_id=:movimiento_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":sucursal_id", $data["sucursal_id"]);
      $query->bindParam(":tipo_movimiento", $data["tipo_movimiento"]);
      $query->bindParam(":movimiento_descripcion", $data["movimiento_descripcion"]);
      $query->bindParam(":movimiento_total", $data["movimiento_total"]);
      $query->bindParam(":movimiento_id", $data["movimiento_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function obtenerCajaId($id)
  {
    try {
      $sql = "SELECT * FROM tbl_cierrecaja 
      WHERE cierrecaja_id=:cierrecaja_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cierrecaja_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function validarCajaIdUsuario($id)
  {
    try {
      $sql = "SELECT COUNT(*) FROM tbl_cierrecaja 
      WHERE cierrecaja_usuarioid=:usuario_id AND cierrecaja_estado='A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":usuario_id", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function obtenerCajaIdUsuario($id)
  {
    try {
      $sql = "SELECT cierrecaja_id,cierrecaja_efectivo_asignacion FROM tbl_cierrecaja 
      WHERE cierrecaja_usuarioid=:usuario_id AND cierrecaja_estado='A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":usuario_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function obtenerMovimientoId($id)
  {
    try {
      $sql = "SELECT * FROM tbl_movimientocaja 
      WHERE movimiento_id=:movimiento_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":movimiento_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function obtenerMovimientoTotal($id)
  {
    try {
      $sql = "SELECT SUM(movimiento_total) AS movimientos FROM tbl_movimientocaja 
      WHERE usuario_id=:usuario_id AND movimiento_estado='A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":usuario_id", $id);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function totalVendidos($datos,$emisor_id)
  {
      try {
          $dia = '%' . date('Y-m-d') . '%';
          $sql =
              "SELECT sum(f.factura_total)as total FROM tbl_factura as f WHERE f.emisor_id=:emisor_id AND
              f.factura_usuario_id=:usuario_id  AND f.factura_estado !='X' AND f.factura_fecha_i LIKE '" .
              $dia .
              "'";
          $query = Conexion::obtenerConexion()->prepare($sql);
          $query->bindParam(':usuario_id', $datos);
          $query->bindParam(':emisor_id', $emisor_id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);
      } catch (\Throwable $ex) {
          return $ex->getMessage();
      }
  }

  public static function totalNotaVenta($datos,$emisor_id)
  {
      try {
          $dia = '%' . date('Y-m-d') . '%';
          $sql =
              "SELECT sum(notaventa_total) as total, count(notaventa_id)  as totaln
              FROM tbl_notaventa WHERE emisor_id=:emisor_id AND notaventa_usuario_id=:usuario_id AND notaventa_fecha_i LIKE '" .
              $dia .
              "'";
          $query = Conexion::obtenerConexion()->prepare($sql);
          $query->bindParam(':emisor_id', $emisor_id);
          $query->bindParam(':usuario_id', $datos);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);
      } catch (\Throwable $ex) {
          return $ex->getMessage();
      }
  }
  public static function totalReserva($datos,$emisor_id)
  {
      try {
          $dia = '%' . date('Y-m-d') . '%';
          $sql =
              "SELECT sum(reserva_total) as total,count(reserva_id)  as totalr FROM tbl_reserva
              WHERE  reserva_usuario_id=:usuario_id AND emisor_id=:emisor_id AND reserva_fecha_u LIKE '" .
              $dia .
              "'";
          $query = Conexion::obtenerConexion()->prepare($sql);
          $query->bindParam(':usuario_id', $datos);
          $query->bindParam(':emisor_id', $emisor_id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);
      } catch (\Throwable $ex) {
          return $ex->getMessage();
      }
  }

  public static function obtenerCajas()
  {
    try {
      $sql = "SELECT * FROM tbl_cierrecaja c INNER JOIN tbl_usuario u ON c.cierrecaja_usuarioid = u.usuario_id INNER JOIN tbl_sucursal s ON c.sucursal_id = s.sucursal_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function validarActualizarCaja($usuario)
  {
    try {
      $sql = "SELECT COUNT(*) FROM tbl_cierrecaja WHERE cierrecaja_usuarioid=:usuario_id AND cierrecaja_estado= 'A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":usuario_id", $usuario);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function eliminarCaja($idcierrecaja)
  {
    try {
      $sql = "DELETE FROM tbl_cierrecaja WHERE cierrecaja_id=:cierrecaja_id AND cierrecaja_usuario_entregado = '' AND cierrecaja_estado = 'A' ";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cierrecaja_id", $idcierrecaja);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function eliminarMovimiento($idmovimiento)
  {
    try {
      $sql = "DELETE FROM tbl_movimientocaja WHERE movimiento_id=:movimiento_id AND movimiento_estado = 'A' ";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":movimiento_id", $idmovimiento);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function obtenerMovimientoCaja()
  {
    try {
      $sql = "SELECT * FROM tbl_movimientocaja c INNER JOIN tbl_sucursal s ON c.sucursal_id = s.sucursal_id INNER JOIN 
      tbl_usuario u ON c.usuario_id = u.usuario_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function obtenerMovimientoCajaUsuario($idUsuario)
  {
    try {
      $sql = "SELECT * FROM tbl_movimientocaja c INNER JOIN tbl_sucursal s ON c.sucursal_id = s.sucursal_id INNER JOIN 
      tbl_usuario u ON c.usuario_id = u.usuario_id WHERE c.usuario_id = :usuario_id AND c.movimiento_estado='A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":usuario_id", $idUsuario);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function guardarRegistroCaja($data)
  {
    try {
      $sql = "INSERT INTO tbl_cierrecaja(cierrecaja_serie,cierrecaja_fecha_asignacion,cierrecaja_efectivo_asignacion,cierrecaja_usuarioid,sucursal_id) VALUES
      (:cierrecaja_serie,:cierrecaja_fecha_asignacion,:cierrecaja_efectivo_asignacion,:usuario_id,:sucursal_id)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cierrecaja_serie", $data["cierrecaja_serie"]);
      $query->bindParam(":cierrecaja_fecha_asignacion", $data["cierrecaja_fecha_asignacion"]);
      $query->bindParam(":cierrecaja_efectivo_asignacion", $data["cierrecaja_efectivo_asignacion"]);
      $query->bindParam(":usuario_id", $data["usuario_id"]);
      $query->bindParam(":sucursal_id", $data["sucursal_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }



  public static function guardarMovimientoCaja($data)
  {
    try {
      $sql = "INSERT INTO tbl_movimientocaja(sucursal_id,movimiento_tipo,movimiento_descripcion,movimiento_total,usuario_id) VALUES
      (:sucursal_id,:tipo_movimiento,:movimiento_descripcion,:movimiento_total,:usuario_id)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":sucursal_id", $data["sucursal_id"]);
      $query->bindParam(":tipo_movimiento", $data["tipo_movimiento"]);
      $query->bindParam(":movimiento_descripcion", $data["movimiento_descripcion"]);
      $query->bindParam(":movimiento_total", $data["movimiento_total"]);
      $query->bindParam(":usuario_id", $data["usuario_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }


  public static function guardarCajachica($data)
  {
    try {
      $sql = "INSERT INTO tbl_cajachica(cajachica_serie,cajachica_area,cajachica_fechaasignacion,cajachica_fechaliquidacion,cajachica_asignacion,cajachica_egreso,cajachica_reposicion,cajachica_diasjustificados,sucursal_id) VALUES(:cajachica_serie,:cajachica_area,:cajachica_fechaasignacion,:cajachica_fechaliquidacion,:cajachica_asignacion,:cajachica_egreso,:cajachica_reposicion,:cajachica_diasjustificados,:sucursal_id)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cajachica_serie", $data["cajachica_serie"]);
      $query->bindParam(":cajachica_area", $data["cajachica_area"]);
      $query->bindParam(":cajachica_fechaasignacion", $data["cajachica_fechaasignacion"]);
      $query->bindParam(":cajachica_fechaliquidacion", $data["cajachica_fechaliquidacion"]);
      $query->bindParam(":cajachica_asignacion", $data["cajachica_asignacion"]);
      $query->bindParam(":cajachica_egreso", $data["cajachica_egreso"]);
      $query->bindParam(":cajachica_reposicion", $data["cajachica_reposicion"]);
      $query->bindParam(":cajachica_diasjustificados", $data["cajachica_diasjustificados"]);
      $query->bindParam(":sucursal_id", $data["sucursal_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function maximoCajachica()
  {
    try {
      $sql = "SELECT MAX(cajachica_id) AS cajachica_id FROM tbl_cajachica";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
