<?php

use FTP\Connection;

require_once "../conection/conection.php";


class MovimientoIN {
    
    public  function getMovimientoIN() {

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        

        $statement = $ObjConexionPDO->prepare('SELECT * FROM movimientoIN');
        $statement->execute();
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
        if(!$statement){
            echo 'Error nauceabundo';
        }
        return $resultado;
    }


    public function getByCriterio($criterio) {
      $sql = "SELECT *
        FROM movimientoIN
        WHERE id_movimiento = :criterio
          OR guardaTurno = :criterio
          OR personaDevuelve = :criterio
          OR ccPersonaDevuelve  = :criterio
          OR serialActivo = :criterio
          OR observacion LIKE CONCAT('%', :criterio, '%')            
          OR fechaIngreso LIKE CONCAT('%', :criterio, '%');";

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        
        $statement = $ObjConexionPDO->prepare($sql);        
        if($statement->execute(array(':criterio'=>$criterio))){
          $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
        }        
        
        return $resultado;
    }

    public function insert($guardaTurno,$personaDevuelve,$ccPersonaDevuelve,$serialActivo,$observacion){
        $fechaActual = date('Y-m-d H:i:s');
        

        $sql = "INSERT INTO movimientoIN (id_movimiento, guardaTurno, personaDevuelve,
         ccPersonaDevuelve, serialActivo, observacion, fechaIngreso) 
         VALUES (NULL, :guardaTurno, :personaDevuelve, :ccPersonaDevuelve,
          :serialActivo, :observacion, :fechaIngreso);";

          $instancia = conexion::getInstance();
          $OBJConexionPDO = $instancia->getConnection();
          $statement = $OBJConexionPDO->prepare($sql);
          $executeBool = $statement->execute(
            array(':guardaTurno'=>$guardaTurno,':personaDevuelve'=>$personaDevuelve,':ccPersonaDevuelve'=>$ccPersonaDevuelve,
            ':serialActivo'=>$serialActivo,':observacion'=>$observacion,':fechaIngreso'=>$fechaActual )
          );

          if($executeBool){
            return true;

          }else{
            return false;
          }
    }

    public function update($personaDevuelve,$ccPersonaDevuelve,$serialActivo,$observacion,$id_movimiento){
        
      $sql = "UPDATE movimientoIN SET  personaDevuelve = :personaDevuelve, 
      ccPersonaDevuelve = :ccPersonaDevuelve, serialActivo = :serialActivo, observacion = :observacion 
      WHERE movimientoIN.id_movimiento = :id_movimiento;
      ";
          $instancia = conexion::getInstance();
          $OBJConexionPDO = $instancia->getConnection();
          $statement = $OBJConexionPDO->prepare($sql);
          $resultado = $statement->execute(
            array(':personaDevuelve'=>$personaDevuelve, ':ccPersonaDevuelve'=>$ccPersonaDevuelve,':serialActivo'=>$serialActivo, ':observacion'=>$observacion,
            ':id_movimiento'=>$id_movimiento)
          );
          if($resultado){
            return true;
          }else{
            return false;
          }
    }
    



}
?>