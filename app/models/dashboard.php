<?php
// include '../config/conexion.php';
include dirname(dirname(__FILE__)) . '/config/conexion.php';
class Dashboard extends Conexion
{

    //todo::optencion de los datos por usuario y por dia
    public static function totalFacturas($datos, $emisor_id)
    {
        try {
            $dia = '%' . date('Y-m-d') . '%';
            $sql =
                "SELECT COUNT(f.factura_id)as total FROM tbl_factura  as f WHERE f.emisor_id=:emisor_id AND
                f.factura_usuario_id=:usuario_id AND f.factura_estado !='X' AND f.factura_fecha_i LIKE '" .
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
    public static function totalVendidos($datos, $emisor_id)
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

    public static function totalVendidosGraficos()
    {
        try {
            $sql =
                "SET lc_time_names = 'es_ES'; SELECT sum(f.factura_total)as total, MONTHNAME(f.factura_fecha_i) as Mes FROM tbl_factura as f WHERE f.factura_estado !='X' and YEAR(f.factura_fecha_i) = YEAR(NOW()) GROUP BY
                Mes
            ORDER BY
                MONTH(f.factura_fecha_i);";

            $query = Conexion::obtenerConexion()->prepare($sql);
           
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }

    public static function totalNotaVenta($datos, $emisor_id)
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
    public static function totalReserva($datos, $emisor_id)
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
    public static function totalClientes()
    {
        try {
            $sql = 'SELECT count(c.cliente_id)as total FROM tbl_cliente as c';
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function totalProductos()
    {
        try {
            $sql =
                "SELECT COUNT(producto_id) as total FROM tbl_producto WHERE producto_tipo='P'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }

    //todo:fin optencion de los datos por usuario y por dia

    //todo::inicio de la optencion de datos para Administrador
    public static function totalFacturasAd($datos, $emisor_id)
    {
        try {
            $dia = '%' . date('Y-m-d') . '%';
            $sql =
                "SELECT COUNT(f.factura_id)as total FROM tbl_factura  as f WHERE f.emisor_id=:emisor_id
                AND f.factura_estado !='X' AND f.factura_fecha_i LIKE '" .
                $dia .
                "'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);

            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function totalVendidosAd($datos, $emisor_id)
    {
        try {
            $dia = '%' . date('Y-m-d') . '%';
            $sql =
                "SELECT sum(f.factura_total)as total FROM tbl_factura as f WHERE f.emisor_id=:emisor_id AND
                f.factura_estado !='X' AND f.factura_fecha_i LIKE '" .
                $dia .
                "'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }

    public static function totalNotaVentaAd($datos, $emisor_id)
    {
        try {
            $dia = '%' . date('Y-m-d') . '%';
            $sql =
                "SELECT sum(notaventa_total) as total, count(notaventa_id)  as totaln FROM tbl_notaventa
                WHERE emisor_id=:emisor_id AND  notaventa_fecha_i LIKE '" .
                $dia .
                "'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function totalReservaAd($datos, $emisor_id)
    {
        try {
            $dia = '%' . date('Y-m-d') . '%';
            $sql =
                "SELECT sum(reserva_total) as total,count(reserva_id)  as totalr FROM tbl_reserva
                WHERE  emisor_id=:emisor_id AND reserva_fecha_u LIKE '" .
                $dia .
                "'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::fin de la optencion de datos par administrador
    //todo::obtencion de los datos del mes para gastos compras y  utilidades y ganancias
    public static function total_compra()
    {
        try {
            $dia = '%' . date('Y-m') . '%';
            $sql =
                "SELECT sum(gastos_total)as total FROM `tbl_gastos` WHERE gasto_tipo='COMPRA' AND  gastos_fecha_i LIKE  '" .
                $dia .
                "'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            //$query->bindParam(":usuario_id", $datos);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function totalGastos()
    {
        try {
            $dia = '%' . date('Y-m') . '%';
            $sql =
                "SELECT sum(gastos_total)as total FROM `tbl_gastos` WHERE gasto_tipo='GASTO' AND  gastos_fecha_i LIKE  '" .
                $dia .
                "'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            //$query->bindParam(":usuario_id", $datos);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function totalFacturastmes()
    {
        try {
            $dia = '%' . date('Y-m') . '%';
            $sql =
                "SELECT SUM(f.factura_total)as total FROM tbl_factura as f
                WHERE f.factura_estado !='X' AND f.emisor_id='1' AND f.factura_fecha_i  LIKE  '" .
                $dia .
                "'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':usuario_id', $datos);

            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }

    //todo::obtencion de los datos del mes para gastos compras y utilidades

    //todo::sin el sistema financiero
    public static function totalsinSistemaFacturas($datos, $forma_pago)
    {
        try {
            $dia = '%' . date('Y-m-d') . '%';
            $sql =
                "SELECT SUM(f.factura_total)as total FROM tbl_factura  as f WHERE
                f.factura_usuario_id=:usuario_id AND f.formpago_id=:forma_pago AND f.factura_estado !='X' AND f.factura_fecha_i LIKE '" .
                $dia .
                "'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':usuario_id', $datos);
            $query->bindParam(':forma_pago', $forma_pago);

            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function totalNotaVentaxSinsisFinanciero($datos, $forma_pago)
    {
        try {
            $dia = '%' . date('Y-m-d') . '%';
            $sql =
                "SELECT sum(notaventa_total) as total, count(notaventa_id)  as totaln FROM tbl_notaventa WHERE
                formpago_id=:forma_pago AND notaventa_usuario_id=:usuario_id AND notaventa_fecha_i LIKE '" .
                $dia .
                "'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':usuario_id', $datos);
            $query->bindParam(':forma_pago', $forma_pago);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function totalReservasinSinsistefi($datos, $forma_pago)
    {
        try {
            $dia = '%' . date('Y-m-d') . '%';
            $sql =
                "SELECT sum(reserva_total) as total,count(reserva_id)  as totalr FROM tbl_reserva WHERE
                formpago_id=:forma_pago AND reserva_usuario_id=:usuario_id AND reserva_fecha_u LIKE '" .
                $dia .
                "'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':usuario_id', $datos);
            $query->bindParam(':forma_pago', $forma_pago);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::fin sin sistema financiero se suma todo en nota venta y reserva
    //todo::sin el sistema financiero para Administrador
    public static function totalsinSistemaFacturasAd($datos, $forma_pago, $emisor_id)
    {
        try {
            $dia = '%' . date('Y-m-d') . '%';
            $sql =
                "SELECT SUM(f.factura_total)as total FROM tbl_factura  as f WHERE f.emisor_id=:emisor_id AND
                    f.formpago_id=:forma_pago AND f.factura_estado !='X' AND f.factura_fecha_i LIKE '" .
                $dia .
                "'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':forma_pago', $forma_pago);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function totalNotaVentaxSinsisFinancieroAd($datos, $forma_pago, $emisor_id)
    {
        try {
            $dia = '%' . date('Y-m-d') . '%';
            $sql =
                "SELECT sum(notaventa_total) as total, count(notaventa_id)  as totaln FROM tbl_notaventa
                    WHERE emisor_id=:emisor_id AND formpago_id=:forma_pago  AND notaventa_fecha_i LIKE '" .
                $dia .
                "'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':forma_pago', $forma_pago);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function totalReservasinSinsistefiAd($datos, $forma_pago, $emisor_id)
    {
        try {
            $dia = '%' . date('Y-m-d') . '%';
            $sql =
                "SELECT sum(reserva_total) as total,count(reserva_id)  as totalr FROM tbl_reserva WHERE
                    emisor_id=:emisor_id AND formpago_id=:forma_pago  AND reserva_fecha_u LIKE '" .
                $dia .
                "'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':forma_pago', $forma_pago);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::fin sin sistema financiero se suma todo en nota venta y reserva para administrador
    //todo::realizar la modificacion de las consultas para que entregue datos por emisor
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
    //todo::obtencion de datos para el dia de cada sucursal
    public static function obtenerTotalgastosDia($emisor_id)
    {
        try {
            $dia = '%' . date('Y-m-d') . '%';
            $sql = "SELECT SUM(gastos_total)as gastos FROM tbl_gastos WHERE gastos_emisor_id=:emisor_id AND gasto_tipo='GASTO'
       AND gastos_fecha_i LIKE '" .
                $dia .
                "'";

            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(":emisor_id", $emisor_id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalComprasDia($emisor_id)
    {
        try {
            $dia = '%' . date('Y-m-d') . '%';
            $sql = "SELECT SUM(gastos_total) as compras FROM tbl_gastos WHERE gastos_emisor_id=:emisor_id AND gasto_tipo='COMPRA'
        AND gastos_fecha_i LIKE '" . $dia .
                "'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(":emisor_id", $emisor_id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalVentasDia($emisor_id)
    {
        try {
            try {
                $dia = '%' . date('Y-m-d') . '%';
                $sql =
                    "SELECT sum(f.factura_total)as ventas FROM tbl_factura as f WHERE f.emisor_id=:emisor_id AND
                f.factura_estado !='X' AND f.factura_fecha_i LIKE '" . $dia . "'";
                $query = Conexion::obtenerConexion()->prepare($sql);
                $query->bindParam(':emisor_id', $emisor_id);
                $query->execute();
                $facturas = $query->fetch(PDO::FETCH_ASSOC);
                $sql1 =
                    "SELECT sum(notaventa_total) as total, count(notaventa_id)  as totaln
                FROM tbl_notaventa WHERE emisor_id=:emisor_id AND notaventa_fecha_i LIKE '" .
                    $dia .
                    "'";
                $query = Conexion::obtenerConexion()->prepare($sql1);
                $query->bindParam(':emisor_id', $emisor_id);
                $query->execute();
                $notasVenta = $query->fetch(PDO::FETCH_ASSOC);
                if ($notasVenta['total'] == NULL) {
                    $notasVenta['total'] = 0;
                }
                $sql2 =
                    "SELECT sum(reserva_total) as total,count(reserva_id)  as totalr FROM tbl_reserva
                WHERE  emisor_id=:emisor_id AND reserva_fecha_i LIKE '" .
                    $dia .
                    "'";
                $query = Conexion::obtenerConexion()->prepare($sql2);
                $query->bindParam(':emisor_id', $emisor_id);
                $query->execute();
                $reserva = $query->fetch(PDO::FETCH_ASSOC);
                if ($reserva['total'] == NULL) {
                    $reserva['total'] = 0;
                }
                $factura['ventas'] = round(($facturas['ventas'] + $notasVenta['total'] + $reserva['total']), 2);
                return $factura;
            } catch (\Throwable $ex) {
                return $ex->getMessage();
            }
        } catch (\throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::obtencion de datos por el mes de acuerdo a sucursal
    public static function obtenerTotalgastosMes($emisor_id)
    {
        try {
            $dia = '%' . date('Y-m') . '%';
            $sql = "SELECT SUM(gastos_total)as gastos FROM tbl_gastos WHERE gastos_emisor_id=:emisor_id AND gasto_tipo='GASTO'
       AND gastos_fecha_i LIKE '" .
                $dia .
                "'";

            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(":emisor_id", $emisor_id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalComprasMes($emisor_id)
    {
        try {
            $dia = '%' . date('Y-m') . '-%';
            $sql = "SELECT SUM(gastos_total) as compras FROM tbl_gastos WHERE gastos_emisor_id=:emisor_id AND gasto_tipo='COMPRA'
        AND gastos_fecha_i LIKE '" . $dia .
                "'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(":emisor_id", $emisor_id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalVentasMes($emisor_id)
    {
        try {
            try {
                $dia = '%' . date('Y-m') . '%';
                $sql =
                    "SELECT sum(f.factura_total)as ventas FROM tbl_factura as f WHERE f.emisor_id=:emisor_id AND
                f.factura_estado !='X' AND f.factura_fecha_i LIKE '" . $dia . "'";
                $query = Conexion::obtenerConexion()->prepare($sql);
                $query->bindParam(':emisor_id', $emisor_id);
                $query->execute();
                return $query->fetch(PDO::FETCH_ASSOC);
            } catch (\Throwable $ex) {
                return $ex->getMessage();
            }
        } catch (\throwable $ex) {
            return $ex->getMessage();
        }
    }
}
