<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Resquested-With, Content-Type, Accept");

require_once '../conexion.php';
require_once '../modelos/ofertas.php';

$control = $_GET['control'];

$ofertas = new ofertas;

switch ($control){
    case 'consulta':
        $vec = $ofertas->consulta();
    break; 
    case 'insertar':
        $json = file_get_contents('php://input');
        //$json='{"nombre":"prueba 2"}';
        $params = json_decode($json);
        $vec = $ofertas->insertar($params);
    break;
    case 'eliminar':
        $id = $_GET['id'];
        $vec = $ofertas->eliminar($id);
    break;
    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id'];
        $vec = $ofertas->editar($id, $params);
    break;
    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $ofertas->filtro($dato);
    break;   
    case 'ofertas':
        $dato = $_GET['dato'];
        $vec = $ofertas->consultar_ofertas($dato);
    break;
}

$datosj = json_encode($vec);
echo $datosj;
header('Content-Type: application/json');
?>
