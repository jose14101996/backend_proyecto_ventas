<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Resquested-With, Content-Type, Accept");

require_once '../conexion.php';
require_once '../modelos/cliente.php';

$control = $_GET['control'];

$cliente = new cliente;

switch ($control){
    case 'consulta':
        $vec = $cliente->consulta();
    break; 
    case 'insertar':
        $json = file_get_contents('php://input');
        //$json='{"nombre":"prueba 2"}';
        $params = json_decode($json);
        $vec = $cliente->insertar($params);
    break;
    case 'eliminar':
        $id = $_GET['id'];
        $vec = $cliente->eliminar($id);
    break;
    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id'];
        $vec = $cliente->editar($id, $params);
    break;
    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $cliente->filtro($dato);
    break; 
    case 'ccliente':
        $dato = $_GET['dato'];
        $vec = $cliente->consultar_cliente($dato);
    break;   
}

$datosj = json_encode($vec);
echo $datosj;
header('Content-Type: application/json');
?>
