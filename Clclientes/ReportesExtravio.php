<?php 

use FTP\Connection;

require_once "../conection/conection.php";

class ReporteExtravio {
    
    public  function getAll() {

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT * FROM reporteExtravio WHERE objExtraviadoFK  
        NOT IN (SELECT objetoFK FROM objEntregado);');
        $statement->execute();
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
       
        return $resultado;
    }


    public function getByCriterio($criterio) {
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql = "SELECT *
        FROM reporteExtravio
        WHERE objExtraviadoFK NOT IN (SELECT objetoFK FROM objEntregado)
          AND (
                objExtraviadoFK = :criterio
                OR lugarFK = :criterio
                OR victimaFK = :criterio
                OR fechaSuceso LIKE CONCAT(:criterio, '%')
          );";
          

        $statement = $ObjConexionPDO->prepare($sql);        
        $statement->execute(array(':criterio'=>$criterio));
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
        if(count($resultado)==0){
             echo json_encode(array('Estado'=>'No hay coincidencias'),JSON_PRETTY_PRINT);
        }
        return $resultado;
    }
    


    public function insertNovedad ( $objExtraviadoFK,$lugarFK,$victimaFK,
                                            $quienReporta,$fechaSuceso, ){

        //////////////////////////////////////        
        $fechaObjeto = date_create($fechaSuceso);
            if ($fechaObjeto) {
            $fechaFormateada = $fechaObjeto->format('Y-m-d H:i:s');
            } else { echo ('Fecha errada'); }

            $parametros = array(
                ':objExtraviadoFK' => $objExtraviadoFK,
                ':lugarFK' => $lugarFK,
                ':victimaFK' => $victimaFK,
                ':quienReporta' => $quienReporta,
                ':fechaSuceso' => $fechaFormateada );
        ////////////////////////////////////////////

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();

        $sql=" INSERT INTO reporteExtravio (idReporte, objExtraviadoFK, lugarFK, victimaFK, quienReporta, fechaSuceso, fechaRegistroSystem)
        VALUES (NULL, :objExtraviadoFK, :lugarFK, :victimaFK, :quienReporta, :fechaSuceso, NOW() ) ";

        $statement = $ObjConexionPDO->prepare($sql);
        $result = $statement->execute($parametros);
        if($result){
           return true;
        }else{
            return false;
        }
    }

    public function update($objExtraviadoFK,$lugarFK,$victimaFK,$quienReporta,
                                                    $fechaSuceso,$idReporte) {

         //////////////////////////////////////        
         $fechaObjeto = date_create($fechaSuceso);
         if ($fechaObjeto) {
         $fechaFormateada = $fechaObjeto->format('Y-m-d H:i:s');
         } else { echo ('Fecha errada'); }

         $parametros = array(
             ':idReporte'=>$idReporte,
             ':objExtraviadoFK' => $objExtraviadoFK,
             ':lugarFK' => $lugarFK,
             ':victimaFK' => $victimaFK,
             ':quienReporta' => $quienReporta,
             ':fechaSuceso' => $fechaFormateada );
     ////////////////////////////////////////////
        
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();

        $sql = "UPDATE reporteExtravio  SET objExtraviadoFK = :objExtraviadoFK, lugarFK = :lugarFK,
            victimaFK = :victimaFK, quienReporta = :quienReporta, fechaSuceso = :fechaSuceso
             WHERE idReporte = :idReporte";      

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


    public function listarOBJ(){
        //************************ */
        $sql="
        SELECT obj.id, obj.nombre
                        FROM obj  WHERE obj.id NOT IN (SELECT objExtraviadoFK FROM reporteExtravio)
                        AND id NOT IN (SELECT objetoFK FROM objEntregado) AND id  NOT IN 
                        (SELECT objExtraviadoFK FROM reporteHurto)
        
        ";

        //********************
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare($sql);
        $statement->execute();
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
       
        return $resultado;
    }
    public function listarlugares(){
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT id, tipoLugar, nombre  FROM lugares');
        $statement->execute();
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
       
        return $resultado;
    }
    public function listarVictimas(){
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT cc, nombre FROM victima');
        $statement->execute();
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
       
        return $resultado;
    }

 
    
    


}

 

?>