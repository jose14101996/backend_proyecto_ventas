<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Resquested-With, Content-Type, Accept");

require_once '../conexion.php';
require_once '../modelos/pedido.php';

$control = $_GET['control'];

$pedido = new pedido;

switch ($control){
    case 'consulta':
        $vec = $pedido->consulta();
        $datosj = json_encode($vec);
        echo $datosj;
    break; 
    case 'insertar':
        $json = file_get_contents('php://input');
        //$json='{"nombre":"prueba 2"}';
        $params = json_decode($json);
        $tex_arreglo = serialize($params->producto);
        $params->producto = $tex_arreglo;
        $vec = $pedido->insertar($params);
        $datosj = json_encode($vec);
        echo $datosj;
        header('Content-Type: application/json');
    break;
    case 'eliminar':
        $id = $_GET['id'];
        $vec = $pedido->eliminar($id);
        $datosj = json_encode($vec);
        echo $datosj;
        header('Content-Type: application/json');
    break;
    case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id'];
        $vec = $pedido->editar($id, $params);
        $datosj = json_encode($vec);
        echo $datosj;
        header('Content-Type: application/json');
    break;
    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $pedido->filtro($dato);
        $datosj = json_encode($vec);
        echo $datosj;
        header('Content-Type: application/json');
    break;  
    case 'cpedido':
        $dato = $_GET['dato'];
        $vec = $pedido->consultar_pedido($dato);
        $datosj = json_encode($vec);
        echo $datosj;
        header('Content-Type: application/json');
    break;  
    case 'producto':
        $id= $_GET['id'];
        $vec= $pedido->consultap($id);
        $datosj = json_encode($vec);
        echo $datosj;
        header('Content-Type: application/json');
    break;    
}

?>
