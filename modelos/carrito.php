<?php
class carrito{
    //atributo
    public $conexion;

    //metodo constructor
    public function _construct($conexion){
        $this->conexion = $conexion;
    }

    //metodos
    public function consulta (){
        $con = "SELECT * FROM carrito
                INNER JOIN cliente
                ON carrito.id_cliente = cliente.id_cliente
                ORDER BY fecha_creacion";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

        while ($row = mysqli_fetch_array($res)) {
            $vec[] = $row;
        }

        return $vec;
    }

    public function eliminar ($id){
        $del = "DELETE FROM carrito WHERE id_carrito= $id";
        mysqli_query($this->conexion, $del);
        $vec =[];
        $vec['resultado'] = "ok";
        $vec ['mensaje'] = " el carrito ha sido eliminado";
        return $vec;
    }

    public function insertar ($params){
        $ins= "INSERT INTO carrito(id_carrito, fecha_creacion, id_cliente) VALUES ($params->id_carrito, $params->fecha_creacion, $params->id_cliente)";
        mysqli_query($this->conexion, $ins);
        $vec= [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "el carrito ha sido guardado";
        return $vec;
    }

    public function editar ($id, $params){
        $editar = "UPDATE carrito SET id_carrito =$params->id_carrito, fecha_creacion=$params->fecha_creacion,id_cliente=$params->id_cliente WHERE id_carrito = $id, $params";
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "el carrito ha sido editado";
        return $vec;
    }

    public function filtro($dato){
        $filtro = "SELECT * FROM carrito
                    INNER JOIN cliente
                    ON carrito.id_cliente= cliente.id_cliente
                    WHERE id_cliente LIKE '%$dato%' OR fecha_creacion LIKE '%$dato%' OR id_cliente LIKE '%$dato%'
                    ORDER BY fecha_creacion";
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)){
            $vec[] = $row;
        }

        return $vec;
    }

    public function consultar_carrito($dato){
        $filtro = "SELECT * FROM carrito
                    INNER JOIN cliente
                    ON carrito.id_cliente= cliente.id_cliente
                    WHERE id_cliente = '$dato'
                    ORDER BY fecha_creacion";
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)){
            $vec[] = $row;
        }

        return $vec;
    }

}



?>