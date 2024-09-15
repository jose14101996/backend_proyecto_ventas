<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Resquested-With, Content-Type, Accept");

require_once ("../conexion.php");
require_once ("../modelos/login.php");

$email= $_GET['email'];
$clave= $_GET['clave'];

$login= new login;

$vec =$login->consulta($email, $clave);
$datosj = json_encode($vec);
echo $datosj;
header('Content-Type: application/json');
?>
