<?php 

use FTP\Connection;

require_once "../conection/conection.php";

class Request {
    
    
    public  function getAll() {

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT * FROM requerimiento_casual ');
        $statement->execute();
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
       
        return $resultado;
    }
 

    public function getByCriterio($criterio) {
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql = "SELECT *
            FROM requerimiento_casual
            WHERE id_requerimiento = :criterio OR
            requerimiento = :criterio OR
            lugarFK = :criterio OR
            quien_informa = :criterio OR
            area_requerimiento = :criterio OR
            accion = :criterio OR
            observacion = :criterio OR
            fecha_requerimiento LIKE CONCAT('%', :criterio, '%') ; ";
              
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
    
    


    public function insert ($requerimiento,$lugarFK,$quien_informa,$area_requerimiento,$accion,
    $observacion,$fecha_requerimiento ){

            
            //****************Formatear fechas */
            $fechaObjeto = date_create($fecha_requerimiento);
            if ($fechaObjeto) {
            $FECHA1 = $fechaObjeto->format('Y-m-d H:i:s');
            } else { echo ('Fecha de ingreso errada'); }


            /***Fecha out** Validar si viene NULA, para poder insertar bien el NULL 
            if($fechaOut!='NULL'){                
                $fechaObjeto = date_create($fechaOut);
                if ($fechaObjeto) {
                    $FECHA2 = $fechaObjeto->format('Y-m-d H:i:s');
                } else { echo ('Fecha de salida con mal formato, valide.'); }
            }else{
                $FECHA2 = NULL;

            }*/
            
            //**************************** */

            $params = array(
                
                
                ':requerimiento' => $requerimiento,
                ':lugarFK' => $lugarFK,
                ':quien_informa' => $quien_informa,
                ':area_requerimiento' => $area_requerimiento,
                ':accion' => $accion,
                ':observacion' => $observacion,
                ':fecha_requerimiento' => $FECHA1,
                
            );
            
        ////////////////////////////////////////////

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();

        $sql=" INSERT INTO requerimiento_casual (id_requerimiento, requerimiento, lugarFK, quien_informa, area_requerimiento,
         accion, observacion,fecha_requerimiento, fechaRegistroSystem)
        VALUES (NULL, :requerimiento, :lugarFK, :quien_informa, :area_requerimiento, :accion,
        :observacion, :fecha_requerimiento,NOW() ) ";

        $statement = $ObjConexionPDO->prepare($sql);
        $result = $statement->execute($params);
        if($result){
           return true;
        }else{
            return false;
        }
    }

    public function update( $requerimiento,$lugarFK,$quien_informa,$area_requerimiento,$accion,
    $observacion,$fecha_requerimiento,$id_requerimiento) {

         //****************Formatear fechas */
         $fechaObjeto = date_create($fecha_requerimiento);
         if ($fechaObjeto) {
         $FECHA1 = $fechaObjeto->format('Y-m-d H:i:s');
         } else { echo ('Fecha de ingreso errada'); }
        

         //**************************** */

         $params = array(
                
            ':requerimiento' => $requerimiento,
            ':lugarFK' => $lugarFK,
            ':quien_informa' => $quien_informa,
            ':area_requerimiento' => $area_requerimiento,
            ':accion' => $accion,
            ':observacion' => $observacion,
            ':fecha_requerimiento' => $FECHA1,
            ':id_requerimiento' => $id_requerimiento,
            
            
        );
     ////////////////////////////////////////////
        
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();

        $sql = "UPDATE requerimiento_casual  SET requerimiento = :requerimiento, lugarFK = :lugarFK,
            quien_informa = :quien_informa, area_requerimiento = :area_requerimiento, accion = :accion, observacion= :observacion,
            fecha_requerimiento = :fecha_requerimiento
             WHERE id_requerimiento = :id_requerimiento  " ;      

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
        $statement = $ObjConexionPDO->prepare('DELETE FROM requerimiento_casual WHERE id_requerimiento=:criterio ');
        $resul= $statement->execute(array(':criterio'=>$criterio));
         if(!$resul){
            return false;
         }       
        return true;

    }
    


}

 

?>