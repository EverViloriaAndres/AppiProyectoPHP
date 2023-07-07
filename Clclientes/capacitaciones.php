<?php

use FTP\Connection;

require_once "../conection/conection.php";

class capacitacion {
    
    public  function getAll() {

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT * FROM capacitaciones');
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

        $sql = "SELECT * FROM capacitaciones WHERE id_capacitacion = :criterio 
        OR cc_persona_tutor_Fk = :criterio
        OR tema_capacitacion = :criterio
        OR fecha_capacitacion LIKE CONCAT('%', :criterio, '%')
        OR numero_horas = :criterio
        OR modalidad LIKE CONCAT('%', :criterio, '%')
        OR lugarFK = :criterio
        OR observacion = :criterio
         ";
 
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

    public function insert($cc_persona_tutor_Fk, $tema_capacitacion,
     $fecha_capacitacion, $numero_horas, $modalidad, $lugarFK, $observacion) {


        //****************Formatear fechas */
        $fechaObjeto = date_create($fecha_capacitacion);
        if ($fechaObjeto) {
        $FECHA1 = $fechaObjeto->format('Y-m-d H:i:s');
        } else { echo ('Fecha de ingreso errada'); }
        //*****************************

        $sql = " INSERT INTO capacitaciones (id_capacitacion, cc_persona_tutor_Fk,
         tema_capacitacion, fecha_capacitacion, numero_horas,
          modalidad, lugarFK, observacion, fechaRegistroSystem)
           VALUES (NULL, :cc_persona_tutor_Fk,
         :tema_capacitacion, :fecha_capacitacion, :numero_horas,
          :modalidad, :lugarFK, :observacion,  NOW())              
        ";

        
        $params = array(
            ":cc_persona_tutor_Fk"=> $cc_persona_tutor_Fk,
            ":tema_capacitacion"=> $tema_capacitacion,
            ":fecha_capacitacion"=> $FECHA1,
            ":numero_horas"=> $numero_horas,
            ":modalidad"=> $modalidad,
            ":lugarFK"=> $lugarFK,
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



    public function update($cc_persona_tutor_Fk, $tema_capacitacion,
    $fecha_capacitacion, $numero_horas, $modalidad, $lugarFK, $observacion,$id_capacitacion){

        //****************Formatear fechas */
        $fechaObjeto = date_create($fecha_capacitacion);
        if ($fechaObjeto) {
        $FECHA1 = $fechaObjeto->format('Y-m-d H:i:s');
        } else { echo ('Fecha de ingreso errada'); }
        //*********************************************
        
        $params = array(
            ":cc_persona_tutor_Fk"=> $cc_persona_tutor_Fk,
            ":tema_capacitacion"=> $tema_capacitacion,
            ":fecha_capacitacion"=> $FECHA1,
            ":numero_horas"=> $numero_horas,
            ":modalidad"=> $modalidad,
            ":lugarFK"=> $lugarFK,
            ":observacion"=> $observacion,
            ":id_capacitacion"=> $id_capacitacion,    );        
        
        //*********************************************
        $sql = " UPDATE capacitaciones SET cc_persona_tutor_Fk = :cc_persona_tutor_Fk, 
        tema_capacitacion = :tema_capacitacion, fecha_capacitacion = :fecha_capacitacion,
        numero_horas = :numero_horas, modalidad = :modalidad , lugarFK = :lugarFK,
        observacion = :observacion    WHERE id_capacitacion = :id_capacitacion  ";

        


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
    public function guardas(){
        $sql ="SELECT cc, apellido, nombre FROM personal_interno where cargo != 'guarda' and cargo != 'recepcionista'";

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
        $statement = $ObjConexionPDO->prepare('DELETE FROM capacitaciones WHERE capacitaciones.id_capacitacion =:criterio ');
        $resul= $statement->execute(array(':criterio'=>$criterio));
         if(!$resul){
            return false;
         }       
        return true;

    }
}
?>