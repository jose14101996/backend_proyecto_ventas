<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Resquested-With, Content-Type, Accept");

require_once '../conexion.php';
require_once '../modelos/usuario.php';

$control = $_GET['control'];

$usuario = new usuario;

switch ($control){
    case 'consulta':
        $vec = $usuario->consulta();
    break; 
    case 'insertar':
        $json = file_get_contents('php://input');
        //$json='{"nombre":"prueba 2"}';
        $params = json_decode($json);
        $vec = $usuario->insertar($params);
    break;
    case 'eliminar':
        $id = $_GET['id'];
        $vec = $usuario->eliminar($id);
    break;
    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id'];
        $vec = $usuario->editar($id, $params);
    break;
    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $usuario->filtro($dato);
    break;   
    case 'cusuario':
        $dato = $_GET['dato'];
        $vec = $usuario->consultar_usuario($dato);
    break; 
}

$datosj = json_encode($vec);
echo $datosj;
header('Content-Type: application/json');
?>
