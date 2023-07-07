<?php

use FTP\Connection;

require_once "../conection/conection.php";

class investigacionHurto {
    
    public  function getAll() {

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT * FROM investigacion_reporteHurto');
        $statement->execute();
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
        if($statement){
          http_response_code(200);
          return $resultado;
        }else{
          http_response_code(500);
          echo json_encode(array('Error:'=>'Error al obtener los registros'),JSON_PRETTY_PRINT);
        }
    }


    public function getByCriterio($criterio) {
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();

        $sql = "SELECT * FROM investigacion_reporteHurto WHERE
         id = :criterio or reporteHurto_FK = :criterio or investigacion_FK =:criterio  ";
 
        $statement = $ObjConexionPDO->prepare($sql);  

        $statement->execute(array(':criterio'=>$criterio));

        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
        if($statement){
          http_response_code(200);
          return $resultado;
        }else{
          http_response_code(500);
          echo json_encode(array('Error'=>'Error al obtener los registros'),JSON_PRETTY_PRINT);
        } 
        
    }

    public function insert($reporteHurto_FK,$investigacion_FK) {
        //*****************************

        $sql = " INSERT INTO investigacion_reporteHurto (id, reporteHurto_FK, investigacion_FK, fechaRegistroSystem) 
        VALUES (NULL, :reporteHurto_FK, :investigacion_FK, NOW())              
        ";

        $params = array(
            ':reporteHurto_FK' => $reporteHurto_FK,
            ':investigacion_FK' => $investigacion_FK
                       
        );

      //********************************/
        $instancia = conexion::getInstance();
        $OBJConexionPDO = $instancia->getConnection();
        $statement = $OBJConexionPDO->prepare($sql);
      
        $resultado = $statement->execute($params);

            if($resultado){
              http_response_code(200);
              return true;
              
            }else{
              http_response_code(500);
              return false;

            }
                      
    }



    public function update($id, $reporteHurto_FK,$investigacion_FK){
        //*********************************************

        $sql = " UPDATE investigacion_reporteHurto SET
         reporteHurto_FK = :reporteHurto_FK,  investigacion_FK = :investigacion_FK
          WHERE id = :id
        
        ";
        //*********************************************


        $params = array(
            ':id' => $id,
            ':reporteHurto_FK' => $reporteHurto_FK,
            ':investigacion_FK' => $investigacion_FK
        );

        //**********************************************

        
                 
          $instancia = conexion::getInstance();
          $OBJConexionPDO = $instancia->getConnection();
          $statement = $OBJConexionPDO->prepare($sql);
          $resultado = $statement->execute($params);
          if($resultado){
            http_response_code(200);
            return true;
          }else{
            http_response_code(500);
            return false;
          }
    }

    public function investigacion(){
        $sql ="SELECT id, observaciones_resultado  FROM investigacion WHERE motivo='hurto' AND id NOT IN 
        (SELECT investigacion_FK FROM investigacion_reporteHurto);";

        $intancia = conexion::getInstance();
        $OBJpdoConexion = $intancia->getConnection();
        $statement = $OBJpdoConexion->prepare($sql);
        $resul = $statement->execute();
        if($resul){
            $Registros = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $Registros;
        }else{
            return array('Estado'=>'Sin datos');
        }
    }
    public function reporteHurto(){
        $sql ="SELECT  obj.nombre as obj, obj.marca, victima.nombre as victima, reporteHurto.modalidadRobo, 
        reporteHurto.fechaSuceso, reporteHurto.idReporte, obj.id  FROM reporteHurto INNER JOIN obj ON reporteHurto.objExtraviadoFK = obj.id
        INNER JOIN victima ON reporteHurto.victimaFK = victima.cc 
        
        WHERE reporteHurto.idReporte NOT IN(SELECT reporteHurto_FK FROM investigacion_reporteHurto);
        ";

        $intancia = conexion::getInstance();
        $OBJpdoConexion = $intancia->getConnection();
        $statement = $OBJpdoConexion->prepare($sql);
        $resul = $statement->execute();
        if($resul){
            $Registros = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $Registros;
        }else{
            return array('Estado'=>'Sin datos');
        }
    }
    



}
?>