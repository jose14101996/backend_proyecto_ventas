<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Resquested-With, Content-Type, Accept");

require_once'../conexion.php';
require_once '../modelos/categoria.php';

$control = $_GET['control'];

$categoria = new categoria;

switch ($control){
    case 'consulta':
        $vec = $categoria->consulta();
    break; 
    case 'insertar':
        $json = file_get_contents('php://input');
        //$json='{"nombre":"prueba 2"}';
        $params = json_decode($json);
        $vec = $categoria->insertar($params);
    break;
    case 'eliminar':
        $id = $_GET['id'];
        $vec = $categoria->eliminar($id);
    break;
    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id'];
        $vec = $categoria->editar($id, $params);
    break;
    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $categoria->filtro($dato);
    break;   
    case 'ccategoria':
        $dato = $_GET['dato'];
        $vec = $categoria->consultar_categoria($dato);
    break;
}

$datosj = json_encode($vec);
echo $datosj;
header('Content-Type: application/json');
?>
