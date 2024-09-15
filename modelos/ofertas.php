<?php
class ofertas{
    //atributo
    public $conexion;
    //metodo constructor
    public function _construct($conexion){
        $this->conexion = $conexion;
    }

    //metodos
    public function consulta (){
        $con = "SELECT * FROM ofertas
                INNER JOIN producto
                ON ofertas.id_producto = producto.id_producto
                ORDER BY descuento";
        $res = mysqli_query($this->conexion, $con);
        $vec = [];

        while ($row = mysqli_fetch_array($res)) {
            $vec[] = $row;
        }

        return $vec;
    }

    public function eliminar ($id){
        $del = "DELETE FROM ofertas WHERE id_ofertas= $id";
        mysqli_query($this->conexion, $del);
        $vec =[];
        $vec['resultado'] ="ok";
        $vec ['mensaje'] = " la oferta ha sido eliminada";
        return $vec;
    }

    public function insertar ($params){
        $ins= "INSERT INTO ofertas(id_ofertas,descuento,fecha_inicio, fecha_fin, id_producto)  VALUES ($params->id_ofertas, $params->descuento,'$params->fecha_inicio', '$params->fecha_fin', $params->id_producto)";
        mysqli_query($this->conexion, $ins);
        $vec= [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "la oferta ha sido guardada";
        return $vec;
    }

    public function editar ($id, $params){
        $editar = "UPDATE ofertas SET id_ofertas =$params->id_ofertas, descuento= $params->descuento ,fecha_inicio= '$params-> fecha_inicio', fecha_fin = '$params->fecha_fin', id_producto=$params->id_producto WHERE id_ofertas =$id";
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "la oferta ha sido editada";
        return $vec;
    }

    public function filtro($dato){
        $filtro = "SELECT * FROM ofertas
            INNER JOIN producto
            ON ofertas.id_producto = producto.id_producto
            ORDER BY descuento
                 WHERE id_ofertas LiKE '%$dato%' OR descuento LIKE '%$dato%' OR fecha_inicio LIKE '%$dato%' OR fecha_fin LIKE '%$dato%' OR id_producto LIKE '%$dato%'";
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)){
            $vec[] = $row;
        }

        return $vec;
    }

    public function consultar_ofertas($dato){
        $filtro = "SELECT * FROM ofertas
                 INNER JOIN producto
                 ON ofertas.id_producto = producto.id_producto
                 ORDER BY descuento
                 WHERE id_ofertas = '$dato'";
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)){
            $vec[] = $row;
        }

        return $vec;
    }

}



?>