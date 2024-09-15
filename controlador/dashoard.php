<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Resquested-With, Content-Type, Accept");

require_once'../conexion.php';
require_once '../modelos/dashboard.php';

$control = $_GET['control'];

$dashboard = new dashboard ;

switch ($control){
    case 'consulta':
        $vec = $dashboard->consulta();
    break; 
    case 'insertar':
        $json = file_get_contents('php://input');
        //$json='{"nombre":"prueba 2"}';
        $params = json_decode($json);
        $vec = $dashboard->insertar($params);
    break;
    case 'eliminar':
        $id = $_GET['id'];
        $vec = $dashboard->eliminar($id);
    break;
    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id'];
        $vec = $dashboard->editar($id, $params);
    break;
    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $dashboard->filtro($dato);
    break;  
    case 'cdashboard':
        $dato = $_GET['dato'];
        $vec = $dashboard->consultar_dashboard($dato);
    break;  
}

$datosj = json_encode($vec);
echo $datosj;
header('Content-Type: application/json');
?>
