<?php
class categoria{
    //atributo
    public $conexion;

    //metodo constructor
    public function _construct($conexion){
        $this->conexion = $conexion;
    }

    //metodos
    public function consulta (){
        $con = "SELECT * from categoria ORDER BY nombre";
        $res = mysqli_query($this->conexion, $con);
        $vec = [];

        while ($row = mysqli_fetch_array($res)) {
            $vec[] = $row;
        }

        return $vec;
    }

    public function eliminar ($id){
        $del = "DELETE FROM categoria WHERE id_categoria= $id";
        mysqli_query($this->conexion, $del);
        $vec =[];
        $vec['resultado'] = "ok";
        $vec ['mensaje'] = " la categoria  ha sido eliminada";
        return $vec;
    }

    public function insertar ($params){
        $ins= "INSERT INTO  categoria(id_categoria, nombre,descripcion) VALUES ($params->id_categoria, '$params->nombre', '$params->descripcion')";
        mysqli_query($this->conexion, $ins);
        $vec= [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "la categoria ha sido guardado";
        return $vec;
    }

    public function editar ($id, $params){
        $editar = "UPDATE categoria SET id_categoria = $params->id_categoria, nombre = '$params->nombre', descripcion = '$params->descripcion', WHERE id_categoria =$id";
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "la categoria ha sido editada";
        return $vec;
    }

    public function filtro($dato){
        $filtro= "SELECT * from categoria ORDER BY nombre
                 WHERE id_categoria LIKE '%$dato%' OR nombre LIKE '%$dato%' OR descripcion LIKE '%$dato%'";
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)){
            $vec[] = $row;
        }

        return $vec;
    }

    public function consultar_categoria($dato){
        $filtro= "SELECT * from categoria ORDER BY nombre
                 WHERE id_categoria = '$dato'";
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)){
            $vec[] = $row;
        }

        return $vec;
    }


}



?>