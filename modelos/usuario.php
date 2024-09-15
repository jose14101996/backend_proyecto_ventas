<?php
class usuario{
    //atributo
    public $conexion;
    //metodo constructor
    public function _construct($conexion){
        $this->conexion = $conexion;
    }

    //metodos
    public function consulta (){
        $con = "SELECT * from usuario ORDER BY nombre";
        $res = mysqli_query($this->conexion, $con);
        $vec = [];

        while ($row = mysqli_fetch_array($res)) {
            $vec[] = $row;
        }

        return $vec;
    }

    public function eliminar ($id){
        $del = "DELETE FROM usuario WHERE id_usuario= $id";
        mysqli_query($this->conexion, $del);
        $vec =[];
        $vec['resultado'] ="ok";
        $vec ['mensaje'] = " el usuario ha sido eliminado";
        return $vec;
    }

    public function insertar ($params){
        $ins= "INSERT INTO usuario(id_usuario, nombre,contraseña, tipo_usuario) VALUES ($params->id_usuario, '$params->nombre',$params->contraseña, '$params->tipo_usuario')";
        mysqli_query($this->conexion, $ins);
        $vec= [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "el usuario ha sido guardado";
        return $vec;
    }

    public function editar ($id, $params){
        $editar = "UPDATE usuario SET id_usuario = $params->id_usuario, nombre= '$params->nombre',contraseña= $params->contraseña, tipo_usuario= $params->tipo_usuario WHERE id_usuario = $id";
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "el usuario ha sido editado";
        return $vec;
    }

    public function filtro($dato){
        $filtro = "SELECT * FROM usuario ORDER BY nombre
         WHERE id_usuario LIKE '%$dato%' OR nombre LIKE '%$dato%' OR contraseña LIKE '%$dato%' OR tipo_usuario LIKE '%$dato%'";
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)){
            $vec[] = $row;
        }

        return $vec;
    }

    public function consultar_usuario($dato){
        $filtro = "SELECT * FROM usuario ORDER BY nombre
         WHERE id_usuario = '$dato'";
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)){
            $vec[] = $row;
        }

        return $vec;
    }

}



?>