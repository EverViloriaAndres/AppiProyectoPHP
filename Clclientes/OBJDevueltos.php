<?php

use FTP\Connection;

require_once "../conection/conection.php";


class OBJdevuelto {
    
    public  function getMovimientoIN() {

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        

        $statement = $ObjConexionPDO->prepare('SELECT * FROM objEntregado');
        $statement->execute();
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
        if(!$statement){
            echo json_encode(array('Estado'=>'Error'),JSON_PRETTY_PRINT);
        }
        return $resultado;
    }


    public function getByCriterio($criterio) {
        $sql = "SELECT *
          FROM objEntregado
          WHERE id = :criterio
            OR objetoFK = :criterio
            OR entrgadoPor_FK = :criterio
            OR entregadoA LIKE CONCAT('%', :criterio, '%')
            OR observaciones LIKE CONCAT('%', :criterio, '%')
            OR fechaSuceso LIKE CONCAT('%', :criterio, '%')";
      
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        
        $statement = $ObjConexionPDO->prepare($sql);        
        if ($statement->execute(array(':criterio' => $criterio))) {
          $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
        }        
      
        return $resultado;
      }
      

    public function insert($objetoFK,$entrgadoPor_FK,$entregadoA,$observaciones,$fechaSuceso){        
        
            $fechaObjeto = date_create($fechaSuceso);
            if ($fechaObjeto) {
            $fechaFormateada = $fechaObjeto->format('Y-m-d H:i:s');
            } else { echo ('Fecha errada'); }
        

        $sql = "INSERT INTO objEntregado (id, objetoFK, entrgadoPor_FK,
         entregadoA, observaciones, fechaSuceso,fechaRegistroSystem) 
         VALUES (NULL, :objetoFK, :entrgadoPor_FK, :entregadoA,
          :observaciones, :fechaSuceso, now());";

          $instancia = conexion::getInstance();
          $OBJConexionPDO = $instancia->getConnection();
          $statement = $OBJConexionPDO->prepare($sql);
          $executeBool = $statement->execute(
            array(':objetoFK'=>$objetoFK,':entrgadoPor_FK'=>$entrgadoPor_FK,
            ':entregadoA'=>$entregadoA,':observaciones'=>$observaciones,':fechaSuceso'=>$fechaFormateada )
          );

          if($executeBool){
            return true;

          }else{
            return false;
          }
    }

    public function update($id,$objetoFK,$entrgadoPor_FK,$entregadoA,$observaciones,$fechaSuceso){
        $fechaObjeto = date_create($fechaSuceso);
            if ($fechaObjeto) {
            $fechaFormateada = $fechaObjeto->format('Y-m-d H:i:s');
            } else { echo ('Fecha errada'); }
        
      $sql = "UPDATE objEntregado SET  objetoFK = :objetoFK, 
      entrgadoPor_FK = :entrgadoPor_FK, entregadoA = :entregadoA, observaciones = :observaciones,fechaSuceso = :fechaSuceso 
      WHERE objEntregado.id = :id;
      ";
          $instancia = conexion::getInstance();
          $OBJConexionPDO = $instancia->getConnection();
          $statement = $OBJConexionPDO->prepare($sql);
          $resultado = $statement->execute(
            array(':objetoFK'=>$objetoFK,':entrgadoPor_FK'=>$entrgadoPor_FK,
            ':entregadoA'=>$entregadoA,':observaciones'=>$observaciones,':fechaSuceso'=>$fechaFormateada,':id'=>$id )
          );
          if($resultado){
            return true;
          }else{
            return false;
          }
    }
    



}
?>