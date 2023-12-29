<?php

session_start();

session_unset();
session_destroy();
$_SESSION['login'] = false;
header("Location: http://localhost:90/seli_logistics_inventario/app/views/login.php");
die();
