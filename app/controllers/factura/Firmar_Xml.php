<?php
session_start();
set_time_limit(300);
//include dirname(dirname(__FILE__)) . "../../models/factura.php";
include '../factura/Funciones.php';
include '../factura/Pdf_Factura.php';
include '../lib/nusoap.php';
$id_factura = $_REQUEST['id'];
$id_bodega = $_SESSION['bodega_id']; //todo::despues resolver el inconveniente validar en que bodega es sino dejarlo por defecto
$cla = $_REQUEST['cla'];
$datosEmisor = Factura::obtenerEmisor($id_factura);
//var_dump($prueba);
$datosEstaBod = Factura::obtenerBodegaEsta($id_bodega);
//todo:datos de ejecucion dirFirma url absoluta para la implementacion
$firma = $datosEmisor['dirFirma'];

//$firma = 'C:\\laragon\\www\\seli_logistics_inventario\\app\\controllers\\factura\\5805810_identity.p12';
$clave = $datosEmisor['passFirma'];
//s
$resultado = [
    'estado' => 'null',
    'mensaje' => 'null',
];

if (!($almacén_cert = file_get_contents($firma))) {
    //echo "Error: No se puede leer el fichero del certificado\n";
    $resultado['estado'] = 'false';
    $resultado['mensaje'] =
        "Error: No se puede leer el fichero del certificado\n";
    echo json_encode($resultado);
    exit();
}
if (openssl_pkcs12_read($almacén_cert, $info_cert, $clave)) {
    $func = new fac_ele();
    $vtipoambiente = $datosEmisor['ambiente']; //tipo ambiente
    $wsdls = $func->wsdl($vtipoambiente);
    $recepcion = $wsdls['recepcion'];
    $autorizacionws = $wsdls['autorizacion'];
    //todo::modificacion de las rutas para la instalacion de la misma e

    $ruta_no_firmados = $datosEmisor['dirDocNoAutorizados'] . $cla . '.xml';
    $ruta_si_firmados = $datosEmisor['dirDocFirmados'];
    $ruta_autorizados = $datosEmisor['dirDocAutorizados'];
    $pathPdf = $datosEmisor['dirDocPdf'];
    //$tipo='CR';
    $nuevo_xml = $cla . '.xml';

    $controlError = false;
    $m = '';
    $show = '';
    if (file_exists($ruta_no_firmados)) {
        $argumentos =
            $ruta_no_firmados .
            ' ' .
            $ruta_si_firmados .
            ' ' .
            $nuevo_xml .
            ' ' .
            $firma .
            ' ' .
            $clave;
        $comando =
            'java -jar C:\\Comprobantes\\firmaComprobanteElectronico\\dist\\firmaComprobanteElectronico.jar ' .
            $argumentos;
        // echo $comando;
        $resp = shell_exec($comando);
        //echo $resp;
        //var_dump($comando);
        //exit;
        $claveAcces = simplexml_load_file($ruta_si_firmados . $nuevo_xml);
        $claveAcceso['claveAccesoComprobante'] = substr(
            $claveAcces->infoTributaria[0]->claveAcceso,
            0,
            49
        );
        /*$cl = $claveAcces->infoTributaria[0]->claveAcceso;
         $retest = substr($cl, 8, 2);*/
        //var_dump($claveAcceso);
        //var_dump($comando);
        //ar_dump($resp);
        switch (substr($resp, 0, 7)) {
            case 'FIRMADO':
                $xml_firmado = file_get_contents(
                    $ruta_si_firmados . $nuevo_xml
                );
                $data['xml'] = base64_encode($xml_firmado);
                try {
                    $client = new nusoap_client($recepcion, true);
                    $client->soap_defencoding = 'utf-8';
                    $client->xml_encoding = 'utf-8';
                    $client->decode_utf8 = false;
                    $response = $client->call('validarComprobante', $data);
                    //var_dump($response);
                    // echo 'COMPROBANTE FIRMADO<br>';//todo::pendiente se oculto
                } catch (Exception $e) {
                    //echo "Error!<br />";
                    //echo $e->getMessage();
                    //echo 'Last response: ' . $client->response . '<br />';
                    //todo:los campos se ocultaron para notificacion pruebas habilitar
                    $resultado['mensaje'] =
                        'Error!<br />' .
                        $e->getMessage() .
                        'Last response: ' .
                        $client->response .
                        '<br />';
                    $resultado['estado'] = 'false';
                    echo json_encode($resultado);
                }
                switch ($response['RespuestaRecepcionComprobante']['estado']) {
                    case 'RECIBIDA':
                        //echo $response["RespuestaRecepcionComprobante"]["estado"] . '<br>';//todo::pendiente se oculto
                        $client = new nusoap_client($autorizacionws, true);
                        $client->soap_defencoding = 'utf-8';
                        $client->xml_encoding = 'utf-8';
                        $client->decode_utf8 = false;
                        try {
                            $responseAut = $client->call(
                                'autorizacionComprobante',
                                $claveAcceso
                            );
                            // var_dump($responseAut);
                        } catch (Exception $e) {
                            //echo "Error!<br>";
                            //echo $e->getMessage();
                            // echo 'Last response: ' . $client->response . '<br />';
                            $resultado['mensaje'] =
                                'Error!<br />' .
                                $e->getMessage() .
                                'Last response: ' .
                                $client->response .
                                '<br />';
                            $resultado['estado'] = 'false';
                            echo json_encode($resultado);
                        }

                        switch (
                            $responseAut['RespuestaAutorizacionComprobante'][
                                'autorizaciones'
                            ]['autorizacion']['estado']
                        ) {
                            case 'AUTORIZADO':
                                $autorizacion =
                                    $responseAut[
                                        'RespuestaAutorizacionComprobante'
                                    ]['autorizaciones']['autorizacion'];
                                $estado = $autorizacion['estado'];
                                $numeroAutorizacion =
                                    $autorizacion['numeroAutorizacion'];
                                $fechaAutorizacion =
                                    $autorizacion['fechaAutorizacion'];
                                $comprobanteAutorizacion =
                                    $autorizacion['comprobante'];
                                //echo $estado . '<br>';
                                //echo $numeroAutorizacion . '<br>';
                                $vfechaauto =
                                    substr($fechaAutorizacion, 0, 10) .
                                    ' ' .
                                    substr($fechaAutorizacion, 11, 5);
                                //echo 'Xml ' .
                                //  $func->crearXmlAutorizado($estado, $numeroAutorizacion, $fechaAutorizacion, $comprobanteAutorizacion, $ruta_autorizados, $nuevo_xml) .
                                // ' bytes creado<br>';

                                //notificacion de la Factura
                                $mensaje =
                                    $estado .
                                    '<br>' .
                                    $numeroAutorizacion .
                                    '<br>' .
                                    'Xml ' .
                                    $func->crearXmlAutorizado(
                                        $estado,
                                        $numeroAutorizacion,
                                        $fechaAutorizacion,
                                        $comprobanteAutorizacion,
                                        $ruta_autorizados,
                                        $nuevo_xml
                                    ) .
                                    ' bytes creado<br>';
                                //echo ($mensaje);avilitar para que vea si vale
                                //echo '<script language="javascript">alert(' . $mensaje . '); return false;</script>';;

                                if (
                                    $claveAcceso['claveAccesoComprobante'] =
                                        substr(
                                            $claveAcces->infoTributaria[0]
                                                ->claveAcceso,
                                            8,
                                            2
                                        ) == '01'
                                ) {
                                    $pdf = new pdf();
                                    $pdf->pdfFacura(
                                        $numeroAutorizacion,
                                        $id_bodega,
                                        $id_factura
                                    ); //
                                    //$func->correos($numeroAutorizacion);
                                    $datos_factura = Factura::ObterFacturaID(
                                        $id_factura
                                    );
                                    $datos_correo = [
                                        'email' =>
                                            $datos_factura['cliente_email'], //moficar de forma dinamica
                                        'asunto' => 'Factura Electronica',
                                        'id' => $id_factura,
                                        'emailCopia' => CORREO_REENVIO,
                                    ];

                                    $datos_detalleFactura = Factura::ObtenerDetalleFactura(
                                        $datos_factura['factura_id']
                                    );
                                    $datos = [
                                        'factura' => $datos_factura,
                                        'envio_correo' => $datos_correo,
                                        'detalle_factura' => $datos_detalleFactura,
                                    ];
                                    $datos = [
                                        'factura' => $datos_factura,
                                        'envio_correo' => $datos_correo,
                                        'detalle_factura' => $datos_detalleFactura,
                                        //todo::tener en cuenta al mmento de que se envie las facturas para la
                                        //todo::la impresion no se guardara correctamente ya que se va directo a un archivo estatico
                                        'nombreFactura' =>
                                            'FAC-' .
                                            $datosEstaBod['codigo'] .
                                            '-' .
                                            $datosEstaBod['codPtemi'] .
                                            '-' .
                                            str_pad(
                                                $datos_factura['factura_serie'],
                                                9,
                                                '0',
                                                STR_PAD_LEFT
                                            ),
                                    ];
                                    $correo_enviado = sendEmail(
                                        $datos,
                                        'email_notificacion_orden'
                                    );
                                    $resultado['estado'] = true; //cambiar el estado del correo
                                    $resultado['mensaje'] = $mensaje;
                                    $estado = 'F'; //todo::controlador estado F facturado
                                    $actualizacion_estado = Factura::actualizacionEstado(
                                        $id_factura,
                                        $estado
                                    );
                                    echo json_encode($resultado);
                                    //todo::envio de errores devuelta
                                } elseif (
                                    $claveAcceso['claveAccesoComprobante'] =
                                        substr(
                                            $claveAcces->infoTributaria[0]
                                                ->claveAcceso,
                                            8,
                                            2
                                        ) == '07'
                                ) {
                                    $pdf = new pdf();
                                    $pdf->pdfRet($numeroAutorizacion, $id); //enivar el id de la factura
                                    $func->correos($numeroAutorizacion);
                                } else {
                                    echo 'codigo de doc no leido';
                                }
                                //unlink($ruta_si_firmados . $nuevo_xml);
                                //require_once './funciones/factura_pdf.php';
                                //var_dump($func);

                                break;
                            case 'EN PROCESO'://todo::se modifico par que cuando este en proceso la factura se envie al correo
                                $numeroAutorizacion =
                                    $autorizacion['numeroAutorizacion'];
                                //echo "El comprobante se encuentra EN PROCESO:<br>";
                                //echo $responseAut['RespuestaAutorizacionComprobante']['autorizaciones']['autorizacion']['estado'] . '<br>';
                                $m .=
                                    'El documento se encuentra en proceso<br>';
                                $resultado['mensaje'] =
                                    'El comprobante se encuentra EN PROCESO:<br>"' .
                                    $responseAut[
                                        'RespuestaAutorizacionComprobante'
                                    ]['autorizaciones']['autorizacion'][
                                        'estado'
                                    ] .
                                    '<br>' .
                                    $m;
                                $resultado['estado'] = 'proceso'; //todo::modificar el resultado estado para que envie
                                $pdf = new pdf();
                                $pdf->pdfFacura(
                                    $numeroAutorizacion,
                                    $id_bodega,
                                    $id_factura
                                ); //
                                echo json_encode($resultado);
                               
                                $controlError = true;
                                ///header("Location: http://localhost/seli_logistics_inventario/app/views/venta.php");
                                break;
                            default:
                                if (
                                    $responseAut[
                                        'RespuestaAutorizacionComprobante'
                                    ]['numeroComprobantes'] == '0'
                                ) {
                                    //echo 'No autorizado</br>';
                                    //echo 'No se encontro informacion del comprobante en el SRI, vuelva an enviarlo.</br>';
                                    $resultado['mensaje'] =
                                        'No autorizado</br>' .
                                        'No se encontro informacion del comprobante en el SRI, vuelva a enviarlo.</br>';
                                    $resultado['estado'] = 'false';
                                    echo json_encode($resultado);
                                } elseif (
                                    $responseAut[
                                        'RespuestaAutorizacionComprobante'
                                    ]['numeroComprobantes'] == '1'
                                ) {
                                    //echo $responseAut['RespuestaAutorizacionComprobante']["autorizaciones"]["autorizacion"]["estado"] . '</br>';
                                    //echo $responseAut['RespuestaAutorizacionComprobante']["autorizaciones"]["autorizacion"]["mensajes"]["mensaje"]["mensaje"] . '</br>';
                                    //todo::eliminados por tema de pruebas  habilitar para otras personas
                                    $resultado['mensaje'] =
                                        $responseAut[
                                            'RespuestaAutorizacionComprobante'
                                        ]['autorizaciones']['autorizacion'][
                                            'estado'
                                        ] .
                                        '</br>' .
                                        $responseAut[
                                            'RespuestaAutorizacionComprobante'
                                        ]['autorizaciones']['autorizacion'][
                                            'mensajes'
                                        ]['mensaje']['mensaje'] .
                                        '</br>';
                                    $resultado['estado'] = 'false';
                                    echo json_encode($resultado);
                                    if (
                                        isset(
                                            $responseAut[
                                                'RespuestaAutorizacionComprobante'
                                            ]['autorizaciones']['autorizacion'][
                                                'mensajes'
                                            ]['mensaje']['mensaje'][
                                                'informacionAdicional'
                                            ]
                                        )
                                    ) {
                                        echo $responseAut[
                                            'RespuestaAutorizacionComprobante'
                                        ]['autorizaciones']['autorizacion'][
                                            'mensajes'
                                        ]['mensaje']['mensaje'][
                                            'informacionAdicional'
                                        ] . '</br>';
                                        $ms =
                                            $responseAut[
                                                'RespuestaAutorizacionComprobante'
                                            ]['autorizaciones']['autorizacion'][
                                                'mensajes'
                                            ]['mensaje']['mensaje'] .
                                            ' => ' .
                                            $responseAut[
                                                'RespuestaAutorizacionComprobante'
                                            ]['autorizaciones']['autorizacion'][
                                                'mensajes'
                                            ]['mensaje']['mensaje'][
                                                'informacionAdicional'
                                            ];
                                    } else {
                                        $ms =
                                            $responseAut[
                                                'RespuestaAutorizacionComprobante'
                                            ]['autorizaciones']['autorizacion'][
                                                'mensajes'
                                            ]['mensaje']['mensaje'];
                                    }
                                    //BORRAR EL VAR_DUMP
                                    //echo '<br/><br/>' . var_dump($responseAut) . '<br/><br/>';
                                } else {
                                    //echo 'No autorizado<br/>';
                                    //echo "Esta es la respuesta de SRI:<br/>";
                                    //echo var_dump($responseAut);
                                    //echo "<br/>";
                                    //echo 'INFORME AL ADMINISTRADOR!</br>';
                                    //todo::se oculto todo para prueba de errores
                                    $resultado['mensaje'] =
                                        'No autorizado<br/>Esta es la respuesta de SRI:<br/>' .
                                        $responseAut .
                                        '<br/>INFORME AL ADMINISTRADOR!</br>';
                                    $resultado['estado'] = 'false';
                                    echo json_encode($resultado);
                                }
                                break;
                        }
                        break;
                    case 'DEVUELTA':
                        $m .=
                            $response['RespuestaRecepcionComprobante'][
                                'estado'
                            ] . '<br>';
                        $m .=
                            $response['RespuestaRecepcionComprobante'][
                                'comprobantes'
                            ]['comprobante']['claveAcceso'] . '<br>';
                        $m .=
                            $response['RespuestaRecepcionComprobante'][
                                'comprobantes'
                            ]['comprobante']['mensajes']['mensaje']['mensaje'] .
                            '<br>';
                        if (
                            isset(
                                $response['RespuestaRecepcionComprobante'][
                                    'comprobantes'
                                ]['comprobante']['mensajes']['mensaje'][
                                    'informacionAdicional'
                                ]
                            )
                        ) {
                            $m .=
                                $response['RespuestaRecepcionComprobante'][
                                    'comprobantes'
                                ]['comprobante']['mensajes']['mensaje'][
                                    'informacionAdicional'
                                ] . '<br>';
                            $ms =
                                $response['RespuestaRecepcionComprobante'][
                                    'comprobantes'
                                ]['comprobante']['mensajes']['mensaje'][
                                    'mensaje'
                                ] .
                                ' => ' .
                                $response['RespuestaRecepcionComprobante'][
                                    'comprobantes'
                                ]['comprobante']['mensajes']['mensaje'][
                                    'informacionAdicional'
                                ];
                        } else {
                            //todo::clave de acceso registrada
                            $ms =
                                $response['RespuestaRecepcionComprobante'][
                                    'comprobantes'
                                ]['comprobante']['mensajes']['mensaje'][
                                    'mensaje'
                                ];
                        }

                        //$m .= $response["RespuestaRecepcionComprobante"]["comprobantes"]["comprobante"]["mensajes"]["mensaje"]["tipo"] . '<br><br>';
                        //echo $response["RespuestaRecepcionComprobante"]["estado"] . '<br>';
                        //echo $response["RespuestaRecepcionComprobante"]["comprobantes"]["comprobante"]["claveAcceso"] . '<br>';
                        //echo $response["RespuestaRecepcionComprobante"]["comprobantes"]["comprobante"]["mensajes"]["mensaje"]["mensaje"] . '<br>';
                        if ($ms == 'CLAVE ACCESO REGISTRADA') {
                            $mensaje =
                                $response['RespuestaRecepcionComprobante'][
                                    'estado'
                                ] .
                                '<br>' .
                                $response['RespuestaRecepcionComprobante'][
                                    'comprobantes'
                                ]['comprobante']['claveAcceso'] .
                                '<br>' .
                                $response['RespuestaRecepcionComprobante'][
                                    'comprobantes'
                                ]['comprobante']['mensajes']['mensaje'][
                                    'mensaje'
                                ] .
                                '<br>';
                            //todo::cuando es devuelta porque el autorizado es devulta

                            $resultado['mensaje'] = $mensaje;
                            $resultado['estado'] = 'false';
                            $estado = 'F';
                        } else {
                            if (
                                isset(
                                    $response['RespuestaRecepcionComprobante'][
                                        'comprobantes'
                                    ]['comprobante']['mensajes']['mensaje'][
                                        'informacionAdicional'
                                    ]
                                )
                            ) {
                                //echo $response["RespuestaRecepcionComprobante"]["comprobantes"]["comprobante"]["mensajes"]["mensaje"]["informacionAdicional"] . '<br>';
                                $resultado['mensaje'] =
                                    $resultado['mensaje'] .
                                    $response['RespuestaRecepcionComprobante'][
                                        'comprobantes'
                                    ]['comprobante']['mensajes']['mensaje'][
                                        'informacionAdicional'
                                    ] .
                                    '<br>';
                            }
                            //echo $response["RespuestaRecepcionComprobante"]["comprobantes"]["comprobante"]["mensajes"]["mensaje"]["tipo"] . '<br><br>';
                            $resultado['mensaje'] =
                                $resultado['mensaje'] .
                                $response['RespuestaRecepcionComprobante'][
                                    'comprobantes'
                                ]['comprobante']['mensajes']['mensaje'][
                                    'tipo'
                                ] .
                                '<br><br>';
                            $estado = 'D';
                        }
                        //todo::controlador estado F facturado
                        $actualizacion_estado = Factura::actualizacionEstado(
                            $id_factura,
                            $estado
                        );

                        echo json_encode($resultado);
                        //todo::envio de errores devuelta
                        $controlError = true;
                        break;
                    case false:
                        //include 'Pdf_Retenciones.php';
                        /*  $autorizacion = $responseAut['RespuestaAutorizacionComprobante']['autorizaciones']['autorizacion'];
                            $estado = $autorizacion['estado'];
                            $numeroAutorizacion = $autorizacion['numeroAutorizacion'];
                            $fechaAutorizacion = $autorizacion['fechaAutorizacion'];
                            $comprobanteAutorizacion = $autorizacion['comprobante'];
                            echo $estado . '<br>';
                            echo $numeroAutorizacion . '<br>';
                            $vfechaauto = substr($fechaAutorizacion, 0, 10) . ' ' . substr($fechaAutorizacion, 11, 5);
                            echo 'Xml ' .
                            $func->crearXmlAutorizado($estado, $numeroAutorizacion, $fechaAutorizacion, $comprobanteAutorizacion, $ruta_autorizados, $nuevo_xml) .
                                    ' bytes creado<br>';
                            $pdf->pdfRet($numeroAutorizacion);
                            $func->correos($numeroAutorizacion);*/
                        // echo 'No enucentra archivos';
                        $resultado['mensaje'] = 'No enucentra archivos';
                        $resultado['estado'] = 'false';
                        echo json_encode($resultado);
                        break;
                    default:
                        //echo "<br>Se ha producido un problema. Vuelve a intentarlo.<br>";
                        //echo "Esta es la respuesta de SRI:<br/>";
                        //echo var_dump($response) . '<br>';
                        //$m .= var_dump($response) . '<br>';
                        //echo "<br><br>";
                        //todo::los campos anteriores se ocultaron habilitar para pruebas
                        $resultado['mensaje'] =
                            '.<br>Se ha producido un problema. Vuelve a intentarlo.<br>Esta es la respuesta de SRI:<br/>' .
                            $m;
                        $resultado['estado'] = 'false';
                        echo json_encode($resultado);
                        $controlError = true;
                        break;
                }
                break;
            default:
                //echo 'no se puede firmar el doc';
                $resultado['mensaje'] = 'no se puede firmar el doc';
                $resultado['estado'] = 'false';
                echo json_encode($resultado);
                //var_dump('no se puede firmar el doc' . $resp) . '<br>';
                break;
        }
        // echo 'veamos';
    } else {
        //echo "Error: No se puede leer el almacén de certificados o clave del cert p12 es incorrecta.\n";
        $resultado['mensaje'] =
            'Error: No se puede leer el almacén de certificados o clave del cert p12 es incorrecta.\n';
        $resultado['estado'] = 'false';
        echo json_encode($resultado);
        exit();
    }
} else {
    //echo 'cargar un comprobante';
    $resultado['mensaje'] = 'Error: cargar un comprobante.\n';
    $resultado['estado'] = 'false';
    echo json_encode($resultado);
}
