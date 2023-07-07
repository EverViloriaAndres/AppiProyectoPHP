<?php
use FTP\Connection;

require_once "../conection/conection.php";
class OUTcomplements{
    
    public function listarAutorizadores(){

        $sql = "SELECT  cc, nombre, apellido FROM personal_interno WHERE cargo = 'Supervisor' or cargo = 'Gerente';";
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();

        $statement = $ObjConexionPDO->prepare($sql);    
        if($statement->execute()){

            $listaAutorizadores = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $listaAutorizadores; 

        }else{
                echo 'Error de conexion al momento de listar';
            }
    }

    public function listarGuardas(){
        $sql = "SELECT cc, nombre, apellido FROM personal_interno WHERE cargo = 'Guarda';";
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();

        $statement = $ObjConexionPDO->prepare($sql);    
        if($statement->execute()){

            $listaGuardas = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $listaGuardas; 

        }else{ echo 'Error de conexion al momento de listar';   }

    }
    public function listarActivos(){

        $sql = "SELECT num_serial, nombre FROM activos WHERE enPosecion ='si';";
        $instancia = conexion::getInstance();
        $ObjConexionPDO = $instancia->getConnection();

        $statement = $ObjConexionPDO->prepare($sql);    
        if($statement->execute()){

            $listaActivos = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $listaActivos; 

        }else{ echo 'Error de conexion al momento de listar';   }
    
    }
}

