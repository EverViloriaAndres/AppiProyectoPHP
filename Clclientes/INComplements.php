<?php
use FTP\Connection;

require_once "../conection/conection.php";
class INcomplements{
    
    public function listarGuardas(){

        $sql = "SELECT cc, nombre, apellido FROM personal_interno WHERE cargo = 'Guarda';";
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();

        $statement = $ObjConexionPDO->prepare($sql);    
        if($statement->execute()){

            $listaGuardas = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $listaGuardas; 

        }else{ 
            json_encode(array('Mensaje'=>'Error de conexion al momento de listar'),JSON_PRETTY_PRINT);
         }

    }

    public function listarPersonal(){
        $sql = "SELECT cc, nombre, apellido FROM personal_interno ";
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();

        $statement = $ObjConexionPDO->prepare($sql);    
        if($statement->execute()){

            $listaGuardas = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $listaGuardas; 

        }else{ 
            json_encode(array('Mensaje'=>'Error de conexion al momento de listar'),JSON_PRETTY_PRINT);
         }

    }
    public function listarActivos(){

        $sql = "SELECT num_serial, nombre FROM activos WHERE enPosecion ='no';";
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();

        $statement = $ObjConexionPDO->prepare($sql);    
        if($statement->execute()){

            $listaActivos = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $listaActivos; 

        }else{ 
            echo json_encode(array('Mensaje'=>'Error de conexion al momento de listar'),JSON_PRETTY_PRINT);
          }
    
    }

    public function listarActivosFiltrados(){
        //**********************
        $sql = "SELECT obj.id, obj.nombre
        FROM obj
        LEFT JOIN objEntregado ON obj.id = objEntregado.objetoFK
        WHERE objEntregado.objetoFK IS NULL;
        ";
        //*******************************

        
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();

        $statement = $ObjConexionPDO->prepare($sql);    
        if($statement->execute()){

            $listaActivos = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $listaActivos; 

        }else{ 
            echo json_encode(array('Mensaje'=>'Error de conexion al momento de listar'),JSON_PRETTY_PRINT);
          }

    }
}

