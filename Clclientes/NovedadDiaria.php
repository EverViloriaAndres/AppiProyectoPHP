<?php 

use FTP\Connection;

require_once "../conection/conection.php";

class NovedadDiaria {
    
    public  function getAll() {

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT * FROM novedadesDiarias');
        $statement->execute();
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
       
        return $resultado;
    }


    public function getByCriterio($criterio) {
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql = "SELECT *
        FROM novedadesDiarias
        WHERE id = :criterio
            OR novedad LIKE CONCAT(:criterio, '%')
            OR lugarFK = :criterio
            OR accionar LIKE CONCAT('%', :criterio, '%')
            OR observaciones LIKE CONCAT('%', :criterio, '%')
            OR fechaSuceso LIKE CONCAT('%', :criterio, '%'); ";

        $statement = $ObjConexionPDO->prepare($sql);        
        $statement->execute(array(':criterio'=>$criterio));
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
        if(count($resultado)==0){
             echo json_encode(array('Estado'=>'No hay coincidencias'),JSON_PRETTY_PRINT);
        }
        return $resultado;
    }
    


    public function insertNovedad (
        $novedadValue,
        $lugarFKValue,
        $accionarValue,
        $observacionesValue,
        $fechaSucesoValue,
        ){

        //////////////////////////////////////
        $fechaRegistroSystemValue = date("Y-m-d H:i:s");
        ////////////////////////////////////////////

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql=" INSERT INTO novedadesDiarias (id, novedad, lugarFK, accionar, observaciones, fechaSuceso, fechaRegistroSystem)
        VALUES (NULL, :novedad, :lugarFK, :accionar, :observaciones, :fechaSuceso, :fechaRegistroSystem);

        ";
        $statement = $ObjConexionPDO->prepare($sql);
        $result = $statement->execute(array(
            ':novedad' => $novedadValue,
            ':lugarFK' => $lugarFKValue,
            ':accionar' => $accionarValue,
            ':observaciones' => $observacionesValue,
            ':fechaSuceso' => $fechaSucesoValue,
            ':fechaRegistroSystem' => $fechaRegistroSystemValue

        ));
        if($result){
           return true;
        }else{
            return false;
        }
    }

    public function update($id,$novedadValue,$lugarFKValue,$accionarValue,$observacionesValue,$fechaSucesoValue) {
        $fechaRegistroSystemValue = date("Y-m-d H:i:s");
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql = " UPDATE novedadesDiarias
        SET novedad = :novedad,
            lugarFK = :lugarFK,
            accionar = :accionar,
            observaciones = :observaciones,
            fechaSuceso = :fechaSuceso  WHERE id = :id;
        
        ";
        $statement = $ObjConexionPDO->prepare($sql);
        $result = $statement->execute(array(

            ':novedad' => $novedadValue,
            ':lugarFK' => $lugarFKValue,
            ':accionar' => $accionarValue,
            ':observaciones' => $observacionesValue,
            ':fechaSuceso' => $fechaSucesoValue,            
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

    public function delete($criterio) {

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();

        $sql = "DELETE FROM novedadesDiarias
        WHERE id = :criterio   ";
        $statement = $ObjConexionPDO->prepare($sql);
        
        $statement->execute(array(':criterio' => $criterio));
        $numRow = $statement->rowCount();
        if ($numRow>0) {
            http_response_code(200);
            return true;
        } else {
            
            http_response_code(500);
            return false;
        }
    }

    public function lugaresComplements(){
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT id, tipoLugar, nombre  FROM lugares');
        $statement->execute();
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
       
        return $resultado;
    }

 
    
    


}



?>