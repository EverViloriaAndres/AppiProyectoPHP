<?php

use FTP\Connection;

require_once "../conection/conection.php";

class Activos {
    
    public  function getAll() {

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT * FROM activos');
        $statement->execute();
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
       
        return $resultado;
    }


    public function getByCriterio($criterio) {
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql = "SELECT * FROM activos
        WHERE num_serial = :criterio
            OR nombre LIKE CONCAT(:criterio, '%')
            OR describcion LIKE CONCAT('%', :criterio, '%')
            OR valor LIKE CONCAT('%', :criterio, '%')
            OR enPosecion = :criterio;
        ";
        $statement = $ObjConexionPDO->prepare($sql);        
        $statement->execute(array(':criterio'=>$criterio));
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
        if(count($resultado)==0){
             echo('Error, sin resultado');
        }
        return $resultado;
    }
    


    public function insert ($num_serial,$nombre,$describcion,$valor,$enPosecion){
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql="INSERT INTO activos (num_serial, nombre, describcion, valor, enPosecion) VALUES (:num_serial, :nombre, :describcion, :valor, :enPosecion)";
        $statement = $ObjConexionPDO->prepare($sql);
        $result = $statement->execute(array(':num_serial'=>$num_serial, ':nombre'=>$nombre, ':describcion'=>$describcion, ':valor'=>$valor, ':enPosecion'=>$enPosecion));
        if($result){
           return true;
        }else{
            return false;
        }



    }

    public function update($num_serial, $nombre, $describcion, $valor, $enPosecion) {
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql = "UPDATE activos SET nombre = :nombre, describcion = :describcion, valor = :valor, enPosecion = :enPosecion WHERE num_serial = :num_serial";
        $statement = $ObjConexionPDO->prepare($sql);
        $result = $statement->execute(array(':num_serial' => $num_serial, ':nombre' => $nombre, ':describcion' => $describcion, ':valor' => $valor, ':enPosecion' => $enPosecion));
        if ($result) {
            http_response_code(200);
            return true;
        } else {
            http_response_code(500);
            return false;
        }
    }

    public function delete($num_serial) {
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql = "DELETE FROM activos WHERE num_serial = :num_serial";
        $statement = $ObjConexionPDO->prepare($sql);
        
        $statement->execute(array(':num_serial' => $num_serial));
        $numRow = $statement->rowCount();
        if ($numRow!=0) {
            http_response_code(200);
            return true;
        } else {
            http_response_code(500);
            return false;
        }
    }
    
    


}



?>