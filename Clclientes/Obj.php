<?php

use FTP\Connection;

require_once "../conection/conection.php";

class OBJ {
    
    public  function getAll() {

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT * FROM obj WHERE id NOT IN(SELECT objetoFK FROM objEntregado ); ');
        $statement->execute();
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
       
        return $resultado;
    }


    public function getByCriterio($criterio) {
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql = "SELECT * FROM obj
        WHERE id = :criterio
            OR nombre LIKE CONCAT(:criterio, '%')
            OR marca LIKE CONCAT('%', :criterio, '%')
            OR contenido LIKE CONCAT('%', :criterio, '%')
            OR valor = :criterio;
        ";
        $statement = $ObjConexionPDO->prepare($sql);        
        $statement->execute(array(':criterio'=>$criterio));
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
        if(count($resultado)==0){
             echo('Error, sin resultado');
        }
        return $resultado;
    }
    


    public function insert ($nombre,$marca,$contenido,$valor){
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql="INSERT INTO obj (id, nombre, marca, contenido, valor)
         VALUES (NULL, :nombre, :marca, :contenido, :valor)";
        $statement = $ObjConexionPDO->prepare($sql);
        $result = $statement->execute(array( ':nombre'=>$nombre, ':marca'=>$marca, ':contenido'=>$contenido, ':valor'=>$valor));
        if($result){
           return true;
        }else{
            return false;
        }



    }

    public function update($id,$nombre,$marca,$contenido,$valor) {
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql = "UPDATE obj SET nombre = :nombre, marca = :marca, contenido = :contenido, valor = :valor WHERE id = :id";
        $statement = $ObjConexionPDO->prepare($sql);
        $result = $statement->execute(array(
            ':nombre' => $nombre, 
            ':marca' => $marca, 
            ':contenido' => $contenido, 
            ':valor' => $valor, 
            ':id' => $id
        ));
        if ($result) {
            http_response_code(200);
            return true;
        } else {
            http_response_code(500);
            return false;
        }
    }

    public function delete($id) {
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql = "DELETE FROM obj WHERE id = :id";
        $statement = $ObjConexionPDO->prepare($sql);
        
        $statement->execute(array(':id' => $id));
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