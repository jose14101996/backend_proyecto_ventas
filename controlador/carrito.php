<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Resquested-With, Content-Type, Accept");

require_once ("../conexion.php");
require_once("../modelos/carrito.php");

$control = $_GET['control'];

$carrito=new carrito($conexion);

switch ($control){
    case 'consulta':
        $vec = $carrito->consulta();
    break;  
    case 'insertar':
            $json = file_get_contents('php://input');
            //$json='{"nombre":"prueba 2"}';
            $params = json_decode($json);
            $vec = $carrito->insertar($params);
        break;
        case 'eliminar':
            $id = $_GET['id'];
            $vec = $carrito->eliminar($id);
        break;
        case 'editar':
            $json = file_get_contents('php://input');
            $params = json_decode($json);
            $id = $_GET['id'];
            $vec = $carrito->editar($id, $params);
        break;
        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $carrito->filtro($dato);
        break;
        case 'ccarrito':
            $dato = $_GET['dato'];
            $vec = $carrito->consultar_carrito($dato);
        break;

                
    }

     $datosj = json_encode($vec);
     echo $datosj;
     header('Content-Type: application/json');
?>
