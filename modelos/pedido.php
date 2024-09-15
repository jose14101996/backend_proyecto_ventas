<?php
class pedido{
    //atributo
    public $conexion;
    //metodo constructor
    public function _construct($conexion){
        $this->conexion = $conexion;
    }

    //metodos
    public function consulta (){
        $con = "SELECT * FROM pedido
            INNER JOIN cliente
            ON pedido.id_cliente = cliente.id_cliente
            ORDER BY estado";
        $res = mysqli_query($this->conexion, $con);
        $vec = [];

        while ($row = mysqli_fetch_array($res)) {
            $vec[] = $row;
        }

        return $vec;
    }

    public function eliminar ($id){
        $del = "DELETE FROM pedido WHERE id_pedido = $id";
        mysqli_query($this->conexion, $del);
        $vec =[];
        $vec['resultado'] ="ok";
        $vec ['mensaje'] = " el pedido ha sido eliminado";
        return $vec;
    }

    public function insertar ($params){
        $ins= "INSERT INTO pedido(id_pedido, fecha, estado, id_cliente )  VALUES ($params->id_pedido, '$params->fecha','$params->estado', $params->id_cliente )";
        mysqli_query($this->conexion, $ins);
        $vec= [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "el pedido ha sido guardado";
        return $vec;
    }

    public function editar ($id, $params){
        $editar = "UPDATE pedido SET id_pedido = $params->id_pedido, fecha = '$params->fecha', estado= '$params->estado', id_cliente= $params->id_cliente ";
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "el pedido ha sido editado";
        return $vec;
    }

    public function filtro($dato){
        $filtro = "SELECT * FROM pedido
                INNER JOIN cliente
                ON pedido.id_cliente = cliente.id_cliente
                ORDER BY estado
                 WHERE id_pedido LIKE '%$dato%' OR fecha LIKE '%$dato%' OR estado LIKE '%$dato%' OR id_cliente LIKE '%$dato%'";
                 
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)){
            $vec[] = $row;
        }

        return $vec;
    }

    public function consultar_pedido($dato){
        $filtro = "SELECT * FROM pedido
                 INNER JOIN cliente
                 ON pedido.id_cliente = cliente.id_cliente
                 ORDER BY estado
                 WHERE id_pedido = '$dato'";
                 
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)){
            $vec[] = $row;
        }

        return $vec;
    }

    public function consultap($id){
        $con = "SELECT producto FROM cliente WHERE id_cliente =$id";
        $res = mysqli_query($this->conexion,$con);
        $row = mysqli_fetch_array($res);
        $vec = unserialize($row[0]);

        return $vec;
    }

}



?>