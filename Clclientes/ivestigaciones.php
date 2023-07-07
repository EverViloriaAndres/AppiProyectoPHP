<?php

use FTP\Connection;

require_once "../conection/conection.php";

class investigacion {
    
    public  function getAll() {

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT * FROM investigacion');
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
        FROM investigacion
        WHERE id = :criterio
        OR motivo = :criterio
        OR quienSolicita = :criterio
        OR quienAutoriza_FK = :criterio
        OR lugarFK = :criterio
        OR investigadoPor = :criterio
        OR inicio LIKE CONCAT(:criterio, '%')
        OR fin LIKE CONCAT(:criterio, '%')
        OR finalizada = :criterio
        OR aprehension = :criterio
        OR observaciones_resultado = :criterio  ";
 
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

    public function insert($motivo,$quienSolicita,$quienAutoriza_FK,$lugarFK,
    $investigadoPor,$inicio,$fin,$finalizada,$aprehension,$observaciones_resultado    
      ) {
        //*****************************

        $sql = " INSERT INTO investigacion (id, motivo, quienSolicita, quienAutoriza_FK,
         lugarFK, investigadoPor, inicio, fin, finalizada, aprehension,
          observaciones_resultado, fechaRegistroSystem) 
        VALUES (NULL, :motivo, :quienSolicita, :quienAutoriza_FK, :lugarFK,
         :investigadoPor, :inicio, :fin, :finalizada, :aprehension, 
         :observaciones_resultado, NOW())              
        ";

        $params = array(
            ':motivo' => $motivo,
            ':quienSolicita' => $quienSolicita,
            ':quienAutoriza_FK' => $quienAutoriza_FK,
            ':lugarFK' => $lugarFK,
            ':investigadoPor' => $investigadoPor,
            ':inicio' => $inicio,
            ':fin' => $fin,
            ':finalizada' => $finalizada,
            ':aprehension' => $aprehension,
            ':observaciones_resultado' => $observaciones_resultado            
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



    public function update($id, $motivo,$quienSolicita,$quienAutoriza_FK,$lugarFK,
    $investigadoPor,$inicio,$fin,$finalizada,$aprehension,$observaciones_resultado ){
        //*********************************************

        $sql = " UPDATE investigacion SET   motivo = :motivo,  quienSolicita = :quienSolicita,
         quienAutoriza_FK = :quienAutoriza_FK, lugarFK = :lugarFK, investigadoPor = :investigadoPor,
        inicio = :inicio, fin = :fin, finalizada = :finalizada,  aprehension = :aprehension,
        observaciones_resultado = :observaciones_resultado  WHERE id = :id
        
        ";
        //*********************************************

            $ObjFechaInicio = date_create($inicio);
            if ($ObjFechaInicio) {
            $FinicioFormat = $ObjFechaInicio->format('Y-m-d H:i:s');
            } else { echo ('Fecha errada'); }

            $ObjFechaFin = date_create($fin);
            if ($ObjFechaFin) {
            $FfinFormat = $ObjFechaFin->format('Y-m-d H:i:s');
            } else { echo ('Fecha errada'); }



        

        //**********************************************/

        $params = array(
            ':id' => $id,
            ':motivo' => $motivo,
            ':quienSolicita' => $quienSolicita,
            ':quienAutoriza_FK' => $quienAutoriza_FK,
            ':lugarFK' => $lugarFK,
            ':investigadoPor' => $investigadoPor,
            ':inicio' => $FinicioFormat,
            ':fin' => $FfinFormat,
            ':finalizada' => $finalizada,
            ':aprehension' => $aprehension,
            ':observaciones_resultado' => $observaciones_resultado
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
    public function gerentes(){
        $sql ="SELECT cc, apellido, nombre FROM personal_interno WHERE cargo = 'gerente'";

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