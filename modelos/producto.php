<?php
class producto{
    //atributo
    public $conexion;
    //metodo constructor
    public function _construct($conexion){
        $this->conexion = $conexion;
    }

    //metodos
    public function consulta (){
        $con = "SELECT * FROM producto
            INNER JOIN categoria
            ON producto.id_categoria = categoria.id_categoria
            ORDER BY precio";
        $res = mysqli_query($this->conexion, $con);
        $vec = [];

        while ($row = mysqli_fetch_array($res)) {
            $vec[] = $row;
        }

        return $vec;
    }

    public function eliminar ($id){
        $del = "DELETE FROM producto WHERE id_producto = $id";
        mysqli_query($this->conexion, $del);
        $vec =[];
        $vec['resultado'] ="ok";
        $vec ['mensaje'] = " el producto ha sido eliminado";
        return $vec;
    }

    public function insertar ($params){
        $ins= "INSERT INTO producto(id_producto, nombre,precio, stock, id_categoria ) 
        VALUES ($params->id_producto,'$params->nombre',$params->precio, $params->stock, $params->id_categoria )";
        mysqli_query($this->conexion, $ins);
        $vec= [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "el producto ha sido guardado";
        return $vec;
    }

    public function editar ($id, $params){
        $editar = "UPDATE producto SET id_producto = $params->id_producto, nombre ='$params->nombre',precio =$params->precio, stock =$params->stock, id_categoria =$params->id_categoria";
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "el producto ha sido editado";
        return $vec;
    }

    public function filtro($dato){
        $filtro = "SELECT * FROM producto
                INNER JOIN categoria
                ON producto.id_categoria = categoria.id_categoria
                ORDER BY precio
                 WHERE id_producto LIKE '%$dato%' OR nombre LIKE '%$dato%' OR precio LIKE '%$dato%' OR stock LIKE '%$dato%' OR id_categoria LIKE '%$dato%' ";
                 
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)){
            $vec[] = $row;
        }

        return $vec;
    }

    public function consultar_producto($dato){
        $filtro = "SELECT * FROM producto
                INNER JOIN categoria
                ON producto.id_categoria = categoria.id_categoria
                ORDER BY precio
                 WHERE id_producto = '$dato'";
                 
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)){
            $vec[] = $row;
        }

        return $vec;
    }

}



?>