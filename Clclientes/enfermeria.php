<?php 

use FTP\Connection;

require_once "../conection/conection.php";

class ReporteEnfermeria {
    
    public  function getAll() {

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT * FROM visitas_enfermeria ');
        $statement->execute();
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC); 
       
        return $resultado;
    }
 

    public function getByCriterio($criterio) {
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $sql = "SELECT *
            FROM visitas_enfermeria
            WHERE id_suceso = :criterio OR
                  nombre_paciente = :criterio OR
                  apellido_paciente = :criterio OR
                  area_paciente = :criterio OR
                  motivo_visita = :criterio OR
                  lugarFK = :criterio OR
                  accionar = :criterio OR
                  fecha_visita LIKE CONCAT('%', :criterio, '%') OR
                  observaciones = :criterio";
              
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
    
    


    public function insert ( $nombre_paciente,$apellido_paciente,$area_paciente,
                                            $motivo_visita,$lugarFK,$accionar,$fecha_visita,$observaciones ){

        //////////////////////////////////////        
            $fechaObjeto = date_create($fecha_visita);
            if ($fechaObjeto) {
            $fechaFormateada = $fechaObjeto->format('Y-m-d H:i:s');
            } else { echo ('Fecha errada'); }

            $params = array(
                ':nombre_paciente' => $nombre_paciente,
                ':apellido_paciente' => $apellido_paciente,
                ':area_paciente' => $area_paciente,
                ':motivo_visita' => $motivo_visita,
                ':lugarFK' => $lugarFK,
                ':accionar' => $accionar,
                ':fecha_visita' => $fechaFormateada,
                ':observaciones' => $observaciones,
                
            );
            
        ////////////////////////////////////////////

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();

        $sql=" INSERT INTO visitas_enfermeria (id_suceso, nombre_paciente, apellido_paciente, area_paciente, motivo_visita,
         lugarFK, accionar,fecha_visita, observaciones ,fechaRegistroSystem)
        VALUES (NULL, :nombre_paciente, :apellido_paciente, :area_paciente, :motivo_visita, :lugarFK,
        :accionar, :fecha_visita, :observaciones,    NOW() ) ";

        $statement = $ObjConexionPDO->prepare($sql);
        $result = $statement->execute($params);
        if($result){
           return true;
        }else{
            return false;
        }
    }

    public function update($nombre_paciente,$apellido_paciente,$area_paciente,
    $motivo_visita,$lugarFK,$accionar,$fecha_visita,$observaciones,$id_suceso) {

         //////////////////////////////////////    
         
         
         


         $fechaObjeto = date_create($fecha_visita);
         if ($fechaObjeto) {
         $fechaFormateada = $fechaObjeto->format('Y-m-d H:i:s');
         } else { echo ('Fecha errada'); }

         $params = array(
            
            ':nombre_paciente' => $nombre_paciente,
            ':apellido_paciente' => $apellido_paciente,
            ':area_paciente' => $area_paciente,
            ':motivo_visita' => $motivo_visita,
            ':lugarFK' => $lugarFK,
            ':accionar' => $accionar,
            ':fecha_visita' => $fechaFormateada,
            ':observaciones' => $observaciones,
            ':id_suceso'=>$id_suceso,
            
        );
     ////////////////////////////////////////////
        
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();

        $sql = "UPDATE visitas_enfermeria  SET nombre_paciente = :nombre_paciente, apellido_paciente = :apellido_paciente,
            area_paciente = :area_paciente, motivo_visita = :motivo_visita, lugarFK = :lugarFK, accionar= :accionar,
            fecha_visita = :fecha_visita, observaciones = :observaciones
             WHERE id_suceso = :id_suceso  " ;      

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
        $statement = $ObjConexionPDO->prepare('DELETE FROM visitas_enfermeria WHERE visitas_enfermeria.id_suceso =:criterio ');
        $resul= $statement->execute(array(':criterio'=>$criterio));
         if(!$resul){
            return false;
         }       
        return true;

    }
    


}

 

?>