<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de Facturación</title>
    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="../../public/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../../public/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/fontawesome-free-6.4.2-web/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../public/libs/css/toastr.css">


    <link rel="stylesheet" type="text/css" href="../../public/vendor/datatables/css/dataTables.bootstrap4.css">
    <link rel="shortcut icon" href="../../public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../public/libs/css/picker.min.css">



    <!-- Custom styles for this template-->





    <!--datables CSS básico
    <link rel="stylesheet" type="text/css" href="../vendor/datatables/datatables.min.css" />-->
    <!--datables estilo bootstrap 4 CSS
    <link rel="stylesheet" type="text/css" href="../vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">-->

</head>

<?php
include dirname(dirname(__FILE__)) . "../../app/Helpers/Helpers.php";
ob_start();
getpermisos(3);
ob_end_clean();
?>