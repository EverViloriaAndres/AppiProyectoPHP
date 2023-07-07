<?php

use FTP\Connection;

require_once "../conection/conection.php";

class Danio {
    
    public  function getAll() {

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT * FROM danios');
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

        $sql = "SELECT *
        FROM danios
        WHERE id_danio = :criterio
            OR lugarFK = :criterio
            OR nomObjAfectado = :criterio
            OR causa = :criterio
            OR estado = :criterio
            OR informante = :criterio
            OR fechaSuceso like concat('%',:criterio,'%')
            OR observacion = :criterio     ";
 
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

    public function insert($lugarFK,$nomObjAfectado,$causa,
    $estado,$informante,$fechaSuceso,$observacion) {


        //****************Formatear fechas */
       
        //*****************************

        $sql = " INSERT INTO danios (id_danio, lugarFK,
         nomObjAfectado, causa, estado,informante,fechaSuceso,observacion, fechaRegistroSystem)
           VALUES (NULL, :lugarFK, :nomObjAfectado, :causa, :estado, :informante, :fechaSuceso, :observacion,  NOW())              
        ";

        
        $params = array(
            
            ":lugarFK"=> $lugarFK,
            ":nomObjAfectado"=> $nomObjAfectado,
            ":causa"=> $causa,
            ":estado"=> $estado,
            ":informante"=> $informante,
            ":fechaSuceso"=> $fechaSuceso,
            ":observacion"=> $observacion
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



    public function update($lugarFK,$nomObjAfectado,$causa,
    $estado,$informante,$fechaSuceso,$observacion,$id_danio){

        //****************Formatear fechas */
        $fechaObjeto = date_create($fechaSuceso);
        if ($fechaObjeto) {
        $FECHA1 = $fechaObjeto->format('Y-m-d H:i:s');
        } else { echo ('Fecha de ingreso errada'); }
        //*********************************************
        
        $params = array(
            ":lugarFK"=> $lugarFK,
            ":nomObjAfectado"=> $nomObjAfectado,
            ":causa"=> $causa,
            ":estado"=> $estado,
            ":informante"=> $informante,
            ":fechaSuceso"=> $FECHA1,
            ":observacion"=> $observacion,
            ":id_danio"=> $id_danio
        );        
        
        //*********************************************
        $sql = "UPDATE danios SET lugarFK = :lugarFK, 
        nomObjAfectado = :nomObjAfectado, causa = :causa,
        estado = :estado, informante = :informante, fechaSuceso = :fechaSuceso,
        observacion = :observacion WHERE id_danio = :id_danio";


        


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


    public function lugares(){
        $sql ="SELECT id, tipoLugar, nombre from lugares";

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
   


    public function delete($criterio){
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('DELETE FROM danios WHERE danios.id_danio =:criterio ');
        $resul= $statement->execute(array(':criterio'=>$criterio));
         if(!$resul){
            return false;
         }       
        return true;

    }
}
?>