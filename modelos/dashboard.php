<?php
class dashboard{
    //atributo
    public $conexion;
    //metodo constructor
    public function _construct($conexion){
        $this->conexion = $conexion;
    }

    //metodos
    public function consulta (){
        $con = "SELECT *FROM dashboard
            INNER JOIN usuario
            ON dashboard.id_usuario = usuario.id_usuario
            ORDER BY preferencias";
        $res = mysqli_query($this->conexion, $con);
        $vec = [];

        while ($row = mysqli_fetch_array($res)) {
            $vec[] = $row;
        }

        return $vec;
    }

    public function eliminar ($id){
        $del = "DELETE FROM dashboard WHERE id_dashboard = $id";
        mysqli_query($this->conexion, $del);
        $vec =[];
        $vec['resultado'] ="ok";
        $vec ['mensaje'] = " el dashboard ha sido eliminado";
        return $vec;
    }

    public function insertar ($params){
        $ins= "INSERT INTO dashboard(id_dashboard, id_usuario, configuracion, preferencias)  VALUES ($params->id_dashboard,$params->id_usuario, '$params->configuracion', '$params->preferencias')";
        mysqli_query($this->conexion, $ins);
        $vec= [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "el dasboard ha sido guardado";
        return $vec;
    }

    public function editar ($id, $params){
        $editar = "UPDATE dashboard SET id_dashboard =$params->id_dashoard, id_usuario= $params->id_usuario, configuracion= '$params->configuracion', preferencias='$params->preferencias'";
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "ok";
        $vec['mensaje'] = "el dashboard ha sido editado";
        return $vec;
    }

    public function filtro($dato){
        $filtro =" SELECT * FROM dashboard
                    INNER JOIN usuario
                    ON dashboard.id_usuario = usuario.id_usuario
                    ORDER BY preferencias
                    WHERE id_dashboard LIKE '%$dato%' OR id_usuario LIKE '%$dato%' OR configuracion LIKE '%$dato%' OR preferencias LIKE '%$dato%'";         
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)){
            $vec[] = $row;
        }

        return $vec;
    }

    public function consultar_dashboard($dato){
        $filtro =" SELECT * FROM dashboard
                    INNER JOIN usuario
                    ON dashboard.id_usuario = usuario.id_usuario
                    ORDER BY preferencias
                    WHERE id_dashboard = ''$dato";         
        $res = mysqli_query($this->conexion, $filtro);
        $vec = [];

        while($row = mysqli_fetch_array($res)){
            $vec[] = $row;
        }

        return $vec;
    }

}



?>