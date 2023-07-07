<?php

use FTP\Connection;

require_once "../conection/conection.php";

class ArqueoRepostado {
    
    public  function getAll() {

        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();
        $statement = $ObjConexionPDO->prepare('SELECT * FROM reporte_arqueo');
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

        $sql = "SELECT * FROM reporte_arqueo WHERE  id_registro = :criterio or 
        fecha_arqueo Like CONCAT('%',:criterio,'%')  or lugarFK =:criterio or
        guardaFK = :criterio or num_M = :criterio or num_C =:criterio  or num_B =:criterio  or total =:criterio 
        or observacion =:criterio  ";
 
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

    public function insert($fecha_arqueo,$lugarFK,$guardaFK,$num_M,
    $num_C,$num_B,$total,$observacion) {
        //*****************************

        $sql = " INSERT INTO reporte_arqueo (id_registro, fecha_arqueo, lugarFK, guardaFK,
        num_M, num_C, num_B, total,observacion, fechaRegistroSystem) VALUES (NULL, :fecha_arqueo, :lugarFK,:guardaFK,
        :num_M, :num_C, :num_B, :total,:observacion,  NOW())              
        ";

        
        $params = array(
            ':fecha_arqueo' => $fecha_arqueo,
            ':lugarFK' => $lugarFK,
            ':guardaFK' => $guardaFK,
            ':num_M' => $num_M,
            ':num_C' => $num_C,
            ':num_B' => $num_B,
            ':total' => $total,
            ':observacion' => $observacion
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



    public function update($fecha_arqueo,$lugarFK,$guardaFK,$num_M,
    $num_C,$num_B,$total,$observacion,$id_registro){
        //*********************************************

        $sql = " UPDATE investigacion_reporteHurto SET
         reporteHurto_FK = :reporteHurto_FK,  investigacion_FK = :investigacion_FK
          WHERE id = :id
        
        ";
        //*********************************************
        $sql = " UPDATE reporte_arqueo SET
        fecha_arqueo = :fecha_arqueo,  lugarFK = :lugarFK, guardaFK=:guardaFK,num_M=:num_M
        ,num_C=:num_C,num_B=:num_B,total=:total,observacion=:observacion
        WHERE id_registro = :id_registro  ";

        $params = array(
            ':fecha_arqueo' => $fecha_arqueo,
            ':lugarFK' => $lugarFK,
            ':guardaFK' => $guardaFK,
            ':num_M' => $num_M,
            ':num_C' => $num_C,
            ':num_B' => $num_B,
            ':total' => $total,
            ':observacion' => $observacion,
            ':id_registro' => $id_registro
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
    public function guardas(){
        $sql ="SELECT cc, apellido, nombre FROM personal_interno WHERE cargo = 'Guarda'";

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