<?php
include dirname(dirname(__FILE__)) . "../../models/reserva.php";
$datosDetalleReserva=Reserva::ontenerDetalleReserva($_POST['id']);

foreach($datosDetalleReserva as $dato)
{
    if($dato['reserva_bodega_ori']!='NULL' && $dato['reserva_ubicacion_ori']!='NULL'){
        $obtenerUbicacion=Reserva::obtenerUbicacionReserva($dato);
        $cantidad=$obtenerUbicacion['ubicacion_cantidad']+$dato['detareserv_cantidad'];
        $cantidadNueva=array(
            'producto_id' =>$obtenerUbicacion['producto_id'],
            'ubicacion' =>$obtenerUbicacion['ubicacion_descripcion'],
            'bodega_id' =>$obtenerUbicacion['bodega_id'],
            'cantidad' =>$cantidad
        );
        if(Reserva::actualizarUbicacion($cantidadNueva)=='true'){
            Reserva::eliminarDetalleReserva($dato['detareserv_id']);
        }
    }else{
        Reserva::eliminarDetalleReserva($dato['detareserv_id']);
    }
}

echo json_encode(Reserva::eliminarReserva($_POST["id"]));
