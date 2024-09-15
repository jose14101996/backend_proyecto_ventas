<?php
class cliente{
    //atributo
    public $conexion;
    //metodo constructor
    public function _construct($conexion){
        $this->conexion = $conexion;
    }

    //metodos
    public function consulta (){
        $con =   "SELECT * FROM cliente
                    INNER JOIN pedido
                    ON cliente.id_pedido= pedido.id_pedido;
                    SELECT*
                    FROM cliente
                    INNER JOIN carrito
                    ON cliente.id_carrito=carrito.id_carrito
                    ORDER BY usuario";
        $res = mysqli_query($this->conexion, $con);
        $vec = [];

        while ($row = mysqli_fetch_array($res)) {
            $vec[] = $row;
        }

        return $vec;
    }

    public function eliminar ($id){
        $del = "DELETE FROM cliente WHERE id_cliente= $id";
        mysqli_query($this->conexion, $del);
        $vec =[];
        $vec['resultado'] ="ok";
        $vec ['mensaje'] = " el cliente ha sido eliminado";
        return $vec;
    }

    public function insertar ($params){
        $ins= "INSERT INTO cliente(id_cliente, usuario, direccion, telefono, id_pedido, id_carrito) VALUES ($params->id_cliente, '$params->usuario', '$params->direccion', $params->telefono, $params->id_pedido, $params->id_carrito)";
        mysqli_query($this->conexion, $ins);
        $vec= [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "el cliente ha sido guardado";
        return $vec;
    }

    public function editar ($id, $params){
        $editar = "UPDATE cliente SET id_cliente =$params->id_cliente, usuario='$params->usuario', direccion='$params->direccion', telefono= $params->telefono, id_pedido= $params->id_pedido, id_carrito =$params->id_carrito WHERE id_clente = $id";
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "el cliente ha sido editado";
        return $vec;
    }

    public function filtro($dato){
        $filtro= "SELECT *FROM cliente
        INNER JOIN pedido
        ON cliente.id_pedido= pedido.id_pedido;
        SELECT*FROM cliente
        INNER JOIN carrito
        ON cliente.id_carrito=carrito.id_carrito
        WHERE id_cliente LIKE '%$dato%' OR usuario LIKE '%$dato%' OR direccion LIKE '%$dato%' OR telefono LIKE '%$dato%' OR id_pedido LIKE '%$dato%' OR id_carrito LIKE '%%$dato';
        ORDER BY usuario";
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)){
            $vec[] = $row;
        }

        return $vec;
    }

    public function consultar_cliente($dato){
        $filtro= "SELECT *FROM cliente
        INNER JOIN pedido
        ON cliente.id_pedido= pedido.id_pedido;
        SELECT*FROM cliente
        INNER JOIN carrito
        ON cliente.id_carrito=carrito.id_carrito
        WHERE id_cliente = '$dato';
        ORDER BY usuario";
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)){
            $vec[] = $row;
        }

        return $vec;
    }

}



?>