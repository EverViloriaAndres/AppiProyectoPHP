<?php

use FTP\Connection;

require_once "../conection/conection.php";

class Victima {
    
    public  function getAll() {

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT * FROM victima');
        $statement->execute();
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
       
        return $resultado;
    }


    public function getByCriterio($criterio) {
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql = "SELECT * FROM victima
        WHERE cc = :criterio
            OR nombre LIKE CONCAT('%', :criterio, '%')
            OR apellido  LIKE CONCAT('%', :criterio, '%')
            OR cargo = :criterio;
            
        ";
        $statement = $ObjConexionPDO->prepare($sql);        
        $statement->execute(array(':criterio'=>$criterio));
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
        if(count($resultado)==0){
             echo('Error, sin resultado');
        }
        return $resultado;
    }
    


    public function insert ($nombre,$apellido,$cc,$cargo){
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql="INSERT INTO victima (nombre, apellido, cc, cargo)
         VALUES (:nombre, :apellido, :cc, :cargo)";
        $statement = $ObjConexionPDO->prepare($sql);
        $result = $statement->execute(array( ':nombre'=>$nombre, ':apellido'=>$apellido, ':cc'=>$cc, ':cargo'=>$cargo));
        if($result){
           return true;
        }else{
            return false;
        }



    }

    public function update($nombre,$apellido,$cc,$cargo) {
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql = "UPDATE victima SET nombre = :nombre, apellido  = :apellido ,  cargo = :cargo WHERE cc = :cc";
        $statement = $ObjConexionPDO->prepare($sql);
        $result = $statement->execute(array(':nombre'=>$nombre, ':apellido'=>$apellido, ':cc'=>$cc, ':cargo'=>$cargo ));
        if ($result) {
            http_response_code(200);
            return true;
        } else {
            http_response_code(500);
            return false;
        }
    }

    public function delete($cc) {
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql = "DELETE FROM victima WHERE cc = :cc";
        $statement = $ObjConexionPDO->prepare($sql);
        
        $statement->execute(array(':cc' => $cc));
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