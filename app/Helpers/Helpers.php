<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//require '../Libraries/phpmailer/Exception.php'
const RUTA_ABSOLUTA = 'C:\xampp\htdocs\sistema_facturacion';
require RUTA_ABSOLUTA.'\app\Libraries/phpmailer/Exception.php';
require RUTA_ABSOLUTA.'\app\Libraries/phpmailer/PHPMailer.php';
require RUTA_ABSOLUTA.'\app\Libraries/phpmailer/SMTP.php';
const ENVIRONMENT = 0; // Local: 0, Produccón: 1;
date_default_timezone_set('America/Guayaquil');
//TODO::Datos envio de correo

const NOMBRE_REMITENTE = 'SELILOGISTICS';
const EMAIL_REMITENTE = 'selisistemd@gmail.com';
const NOMBRE_EMPESA = 'SELILOGISTICS';
const WEB_EMPRESA = 'www.selilogistics.com';
const CORREO_REENVIO = 'selisistemd@gmail.com'; //copias de facturas para cliente
//TODO::datos de los modulos modificar si el modulo cambia
//TODO::datos de correo hosti y calve y tipo
const SERVIDOR_CORREO = 'smtp.gmail.com';
const CLAVE_CORREO = 'pvljtjkimnzobzoz';
const PORT_CORREO = '465'; //SMTPS

const DASHBOARD = 1;
const ADMINISTRACION = 2;
const USUARIOS = 3;
const ROLES = 4;
const SUCURSAL = 5;
const EMISOR = 6;
const ESTABLECIMIENTO = 7;
const PUNTO_EMISION = 8;
const INGRESO = 9;
const CLIENTE = 10;
const INGRESO_PRODUCTO = 11;
const PROVEEDOR = 12;
const VENDEDOR = 13;
const COMBOS = 14;
const INVENTARIO = 15;
const INGRESO_PRODUCTOS = 16;
const EGRESO_PRODUCTO = 17;
const KARDEX = 18;
const TRAZABILIDAD = 19;
const BODEGA = 20;
const REGISTRO_BODEGA = 21;
const CATEGORIA = 22;
const CODIGO_BARRAS = 23;
const CIERRES_CAJA = 24;
const REGISTRO_CAJAS = 25;
const REGISTRO_MOVIMIENTOS = 26;
const FINALIZACION_CAJA = 27;
const FACTURACION = 28;
const PUNTO_VENTA = 29;
const FACTURA = 30;
const COMPROBANTE_SALIDA = 31;
const RESERVA = 32;
const PROFORMA = 33;
const CONTABILIDAD = 34;
const COMPRAS = 35;
const CAJA_CHICA = 36;
const COMERCIAL = 37;
const VISITAS = 38;
const REPORTE = 39;
const REPORTE_FACTURA = 40;
const REPORTE_VENTA = 41;
const REPORTE_PRODUCTO = 42;
const REPORTE_COMISION = 43;
const REPORTE_COMPRA = 44;
const REPORTE_STOCK = 45;
const REPORTE_CIERRES = 46;



function sendEmail($data, $template)
{
    if (ENVIRONMENT == 1) {
        $asunto = $data['asunto'];
        $emailDestino = $data['email'];
        $empresa = NOMBRE_REMITENTE;
        $remitente = EMAIL_REMITENTE;
        $emailCopia = !empty($data['emailCopia']) ? $data['emailCopia'] : '';
        //ENVIO DE CORREO
        $de = "MIME-Version: 1.0\r\n";
        $de .= "Content-type: text/html; charset=UTF-8\r\n";
        $de .= "From: {$empresa} <{$remitente}>\r\n";
        $de .= "Bcc: $emailCopia\r\n";
        ob_start();
        include_once RUTA_ABSOLUTA .
            '\app\Views\Template\Email/' .
            $template .
            '.php';
        $mensaje = ob_get_clean();
        $send = mail($emailDestino, $asunto, $mensaje, $de);
        return $send;
    } else {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        ob_start();
        include_once RUTA_ABSOLUTA .
            '\app\Views/Template/Email/' .
            $template .
            '.php';
        $mensaje = ob_get_clean();
        try {
            //$datos=mail($name,$email,$asunto,$msg,$header);
            //Server settings
            //$filex = 'C:\\xampp\\htdocs\\seli_logistics_inventario\\app\\facturas\\1724254352001\\comprobrantes\\autorizados\\'.$data['nombreFactura'].'.xml';
            //$filep = 'C:\\xampp\\htdocs\\seli_logistics_inventario\\app\\facturas\\1724254352001\\comprobrantes\\pdf\\'.$data['nombreFactura'].'.pdf';
            $filex =
                $data['factura']['dirDocAutorizados'] .
                $data['nombreFactura'] .
                '.xml';
            $filep =
                $data['factura']['dirDocPdf'] . $data['nombreFactura'] . '.pdf';
            //var_dump('C:\xampp\htdocs\seli_logistics_inventario\app\Views/Template/Email/' . $template . '.php');

            $mail->SMTPDebug = 0; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = SERVIDOR_CORREO; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = EMAIL_REMITENTE; //SMTP username
            $mail->Password = CLAVE_CORREO; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $mail->Port = PORT_CORREO; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            //todo::validar si se puede enviar el correo electronico desde el servidor  con el puerto 26 validar
            //todo::con el correo de la empresa para verificacion de datos
            //Recipients
            $mail->setFrom(EMAIL_REMITENTE, 'Factura Electronica');
            $mail->addAddress($data['envio_correo']['email']); //Add a recipient
            if (!empty($data['envio_correo']['emailCopia'])) {
                $mail->addBCC(CORREO_REENVIO);
            }
            $mail->CharSet = 'UTF-8';
            //Content
            $mail->isHTML(true);

            $mail->AddAttachment($filex, $data['nombreFactura'] . '.xml');
            $mail->AddAttachment($filep, $data['nombreFactura'] . '.pdf'); //Set email format to HTML
            $mail->Subject = $data['envio_correo']['asunto'];
            $mail->Body = $mensaje;
            //
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}


function sendMailLocal($data, $template)
{
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    ob_start();
    include_once RUTA_ABSOLUTA .
        '\app\Views/Template/Email/' .
        $template .
        '.php';
    //require_once("C:\xammpp\htdocs\seli_logistics_inventario\app\Views/Template/Email/" . $template . ".php");
    $mensaje = ob_get_clean();
    try {
        if ($data['envio_correo']['asunto'] == 'Proforma') {
            $filep =
                RUTA_ABSOLUTA .
                '\app\facturas\proformas/Proforma_' .
                $data['codigos']['ruc'] .
                '_' .
                $data['codigos']['cod_esta'] .
                '_' .
                $data['codigos']['cod_pto'] .
                '_' .
                $data['notaVenta']['proforma_serie'] .
                '.pdf';
        }

        $mail->SMTPDebug = 0; //Enable verbose debug output
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = SERVIDOR_CORREO; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = EMAIL_REMITENTE; //SMTP username
        $mail->Password = CLAVE_CORREO; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption ENCRYPTION_SMTPS
        $mail->Port = PORT_CORREO;
        //Recipients
        $mail->setFrom('facturas@credp-s.net.ec', NOMBRE_EMPESA);
        $mail->addAddress($data['notaVenta']['cliente_email']); //Add a recipient
        if (!empty($data['envio_correo']['emailCopia'])) {
            $mail->addBCC(CORREO_REENVIO);
        }
        //Content
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);
        //var_dump($data);
        //exit();            //Set email format to HTML
        if ($data['envio_correo']['asunto'] == 'Proforma') {
            $mail->AddAttachment(
                $filep,
                'Proforma' . $data['notaVenta']['proforma_serie'] . '.pdf'
            );
        }
        $mail->Subject = $data['envio_correo']['asunto'];
        $mail->Body = $mensaje;
        return $mail->send();
        echo 'Mensaje enviado';
    } catch (Exception $e) {
        echo "Error en el envío del mensaje: {$mail->ErrorInfo}";
    }
}
function dep($data)
{
    $format = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('</pre>');
    return $format;
}
function getPermisos(int $idmodulo)
{
    require_once '../models/PermisosModel.php';
    $objPermisos = new PermisosModel();
    if (!empty($_SESSION['login'])) {
        $idrol = $_SESSION['id_rol'];
        $arrPermisos = PermisosModel::permisosModulo($idrol);
        $permisos = '';
        $permisosMod = '';
        if (!empty($arrPermisos)) {
            if (count($arrPermisos) > 0) {
                $permisos = $arrPermisos;
                $permisosMod = isset($arrPermisos[$idmodulo])
                    ? $arrPermisos[$idmodulo]
                    : '';
            }
            $_SESSION['permisos'] = $permisos;
            $_SESSION['permisosMod'] = $permisosMod;
        }
    } else {
        $_SESSION['permisos'] = 'datos no encontrados';
    }
}

