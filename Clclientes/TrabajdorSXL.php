<?php

use FTP\Connection;

require_once "../conection/conection.php";

class TrabajadorSexual {
    
    public  function getAll() {

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT * FROM trabajadoresSXL  order by nombre');
        $statement->execute();
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
       
        return $resultado;
    }


    public function getByCriterio($criterio) {
        $sql = "SELECT * FROM trabajadoresSXL
        WHERE cc = :criterio
            OR nombre  like concat('%',:criterio,'%')
            OR apellido like concat('%',:criterio,'%')
            OR genero = :criterio   ";
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare($sql);        
        $statement->execute(array(':criterio'=>$criterio));
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
        
        return $resultado;
    }
    


    public function insert ($cc,$nombre,$apellido,$genero){
        /***************Array de parametros*/
        $parametros = array( ':cc'=>$cc, ':nombre'=>$nombre, ':apellido'=>$apellido, ':genero'=>$genero);
        //**************

        $sql="INSERT INTO trabajadoresSXL (cc, nombre, apellido, genero)
         VALUES (:cc, :nombre, :apellido, :genero)";


        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare($sql);
        $result = $statement->execute(array( ':cc'=>$cc, ':nombre'=>$nombre, ':apellido'=>$apellido, ':genero'=>$genero));
        if($result){
           return true;
        }else{
            return false;
        }



    }

    public function update($cc,$nombre,$apellido,$genero) {

        /***************Array de parametros*/
        $parametros = array( ':cc'=>$cc, ':nombre'=>$nombre, ':apellido'=>$apellido, ':genero'=>$genero);

        //******************************* */
        $sql = "UPDATE trabajadoresSXL SET cc = :cc, nombre = :nombre, apellido = :apellido, genero = :genero WHERE cc = :cc";


        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare($sql);
        $result = $statement->execute($parametros);
        if ($result) {
            http_response_code(200);
            return true;
        } else {
            http_response_code(500);
            return false;
        }
    }

    public function delete($cc) {
        $sql = "DELETE FROM trabajadoresSXL WHERE cc = :cc order by nombre";

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
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