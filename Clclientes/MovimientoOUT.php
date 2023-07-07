<?php

use FTP\Connection;

require_once "../conection/conection.php";

class MovimientosOUT {
    
    public  function getMovimientoOut() {

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT * FROM movimientoOUT');
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
          FROM movimientoOUT
          WHERE id_movimiento = :criterio
            OR autorizadoPOR = :criterio
            OR guardaTurno = :criterio
            OR motivo LIKE CONCAT(:criterio, '%')
            OR personaRetira LIKE CONCAT('%', :criterio, '%')
            OR ccPersonaRetita = :criterio
            OR areaPersonaRetira LIKE CONCAT('%', :criterio, '%')
            OR serialActivo = :criterio
            OR observacion LIKE CONCAT('%', :criterio, '%')
            OR fechaRetiro LIKE CONCAT('%', :criterio, '%') ";
 
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

    public function insert(      
      $autorizadoPOR,
      $guardaTurno,
      $motivo,
      $personaRetira,
      $ccPersonaRetita,
      $areaPersonaRetira,
      $serialActivo,
      $observacion) {
        $fechaActual = date('Y-m-d H:i:s');

        $sql = "INSERT INTO movimientoOUT (id_movimiento, autorizadoPOR, guardaTurno,
          motivo, personaRetira, ccPersonaRetita, areaPersonaRetira, 
          serialActivo, observacion, fechaRetiro) 
          VALUES (NULL, :autorizadoPOR, :guardaTurno, :motivo,
            :personaRetira, :ccPersonaRetita, :areaPersonaRetira, :serialActivo, 
            :observacion, :fechaActual);";
      
        $instancia = conexion::getInstance();
        $OBJConexionPDO = $instancia->getConnection();
        $statement = $OBJConexionPDO->prepare($sql);
      
        $resultado = $statement->execute(
          array(':autorizadoPOR' => $autorizadoPOR,
            ':guardaTurno' => $guardaTurno,
            ':motivo' => $motivo,
            ':personaRetira' => $personaRetira,
            ':ccPersonaRetita' => $ccPersonaRetita,
            ':areaPersonaRetira' => $areaPersonaRetira,
            ':serialActivo' => $serialActivo,
            ':observacion' => $observacion,
            ':fechaActual' => $fechaActual
          )
        );

            if($resultado){
              http_response_code(200);
              return true;
              
            }else{
              http_response_code(500);
              return false;

            }
                      
    }



    public function update($id_movimiento,$autorizadoPOR,$guardaTurno,$motivo,$personaRetira,
    $ccPersonaRetita,$areaPersonaRetira,$serialActivo, $observacion){

        $sql = " UPDATE movimientoOUT SET autorizadoPOR = :autorizadoPOR,  guardaTurno = :guardaTurno,
         motivo = :motivo,personaRetira = :personaRetira, ccPersonaRetita = :ccPersonaRetita,
         areaPersonaRetira = :areaPersonaRetira,serialActivo = :serialActivo,
         observacion = :observacion WHERE movimientoOUT.id_movimiento = :id_movimiento; ";
                 
          $instancia = conexion::getInstance();
          $OBJConexionPDO = $instancia->getConnection();
          $statement = $OBJConexionPDO->prepare($sql);
          $resultado = $statement->execute(
            array(
                  ':autorizadoPOR'=>$autorizadoPOR,
                  ':guardaTurno'=>$guardaTurno,
                  ':motivo'=>$motivo,
                  ':personaRetira'=>$personaRetira,
                  ':ccPersonaRetita'=>$ccPersonaRetita,
                  ':areaPersonaRetira'=>$areaPersonaRetira,
                  ':serialActivo'=>$serialActivo,
                  ':observacion'=>$observacion,
                  ':id_movimiento'=>$id_movimiento
            
              )
          );
          if($resultado){
            http_response_code(200);
            return true;
          }else{
            http_response_code(500);
            return false;
          }
    }
    



}
?>