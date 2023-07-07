<?php 

use FTP\Connection;

require_once "../conection/conection.php";

class visitaEspecial {
    
    
    public  function getAll() {

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT * FROM visitasEspeciales ');
        $statement->execute();
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
       
        return $resultado;
    }
 

    public function getByCriterio($criterio) {
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql = "SELECT *
            FROM visitasEspeciales
            WHERE id_Visita = :criterio OR
            nombreVisitante = :criterio OR
            ocupacionVisitante = :criterio OR
            nacionalidad = :criterio OR
            motivoVisita = :criterio OR
                  lugarFK = :criterio OR
                  fechaIn LIKE CONCAT('%', :criterio, '%') OR
                  fechaOut LIKE CONCAT('%', :criterio, '%') OR
                  Observacion = :criterio";
              
        $statement = $ObjConexionPDO->prepare($sql);        
        $statement->execute(array(':criterio'=>$criterio));
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
        if(isset($resultado)){
            http_response_code(200);
            
            return $resultado;    
        }else{
            
            return $resultado;
        }
    }
    
    


    public function insert ($nombreVisitante,$ocupacionVisitante,$nacionalidad,
                                            $motivoVisita,$lugarFK,$fechaIn,$fechaOut,$Observacion ){

            
            //****************Formatear fechas */
            $fechaObjeto = date_create($fechaIn);
            if ($fechaObjeto) {
            $FECHA1 = $fechaObjeto->format('Y-m-d H:i:s');
            } else { echo ('Fecha de ingreso errada'); }
            //****Fecha out** */

            if($fechaOut!='NULL'){
                
                $fechaObjeto = date_create($fechaOut);
                if ($fechaObjeto) {
                    $FECHA2 = $fechaObjeto->format('Y-m-d H:i:s');
                } else { echo ('Fecha de salida con mal formato, valide.'); }
            }else{
                $FECHA2 = NULL;

            }
            
            //**************************** */

            $params = array(
                
                ':nombreVisitante' => $nombreVisitante,
                ':ocupacionVisitante' => $ocupacionVisitante,
                ':nacionalidad' => $nacionalidad,
                ':motivoVisita' => $motivoVisita,
                ':lugarFK' => $lugarFK,
                ':fechaIn' => $FECHA1,
                ':fechaOut' => $FECHA2,
                ':Observacion' => $Observacion,
                
            );
            
        ////////////////////////////////////////////

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();

        $sql=" INSERT INTO visitasEspeciales (id_Visita, nombreVisitante, ocupacionVisitante, nacionalidad, motivoVisita,
         lugarFK, fechaIn,fechaOut, Observacion ,fechaRegistroSystem)
        VALUES (NULL, :nombreVisitante, :ocupacionVisitante, :nacionalidad, :motivoVisita, :lugarFK,
        :fechaIn, :fechaOut, :Observacion,    NOW() ) ";

        $statement = $ObjConexionPDO->prepare($sql);
        $result = $statement->execute($params);
        if($result){
           return true;
        }else{
            return false;
        }
    }

    public function update( $nombreVisitante,$ocupacionVisitante,$nacionalidad,
    $motivoVisita,$lugarFK,$fechaIn,$fechaOut,$Observacion,$id_Visita) {

         //****************Formatear fechas */
         $fechaObjeto = date_create($fechaIn);
         if ($fechaObjeto) {
         $FECHA1 = $fechaObjeto->format('Y-m-d H:i:s');
         } else { echo ('Fecha de ingreso errada'); }
         //****Fecha Out** */
         if($fechaOut!=NULL){
                
            $fechaObjeto = date_create($fechaOut);
            if ($fechaObjeto) {
                $FECHA2 = $fechaObjeto->format('Y-m-d H:i:s');
            } else {
                echo ('Fecha de salida con mal formato, valide.'); 
            }

        }else{
            $FECHA2 = $fechaOut;

        }

         //**************************** */

         $params = array(
                
            ':nombreVisitante' => $nombreVisitante,
            ':ocupacionVisitante' => $ocupacionVisitante,
            ':nacionalidad' => $nacionalidad,
            ':motivoVisita' => $motivoVisita,
            ':lugarFK' => $lugarFK,
            ':fechaIn' => $FECHA1,
            ':fechaOut' => $FECHA2,
            ':Observacion' => $Observacion,
            ':id_Visita' => $id_Visita,
            
        );
     ////////////////////////////////////////////
        
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();

        $sql = "UPDATE visitasEspeciales  SET nombreVisitante = :nombreVisitante, ocupacionVisitante = :ocupacionVisitante,
            nacionalidad = :nacionalidad, motivoVisita = :motivoVisita, lugarFK = :lugarFK, fechaIn= :fechaIn,
            fechaOut = :fechaOut, Observacion = :Observacion
             WHERE id_Visita = :id_Visita  " ;      

        $statement = $ObjConexionPDO->prepare($sql);
        $result = $statement->execute($params);

        if ($result) {
            http_response_code(200);
            return true;
        } else {
            http_response_code(500);
            return false;
        }
    }


    
    public function listarlugares(){
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT id, tipoLugar, nombre  FROM lugares');
        $statement->execute();
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
       
        return $resultado;
    }

    public function delete($criterio){
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('DELETE FROM visitasEspeciales WHERE visitasEspeciales.id_Visita =:criterio ');
        $resul= $statement->execute(array(':criterio'=>$criterio));
         if(!$resul){
            return false;
         }       
        return true;

    }
    


}

 

?>