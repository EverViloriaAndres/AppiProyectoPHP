<?php

use FTP\Connection;

require_once "../conection/conection.php";

 class login{

     private $CedulaUsuario;
     private $CargoUsuario;
     

     /*Voy a necesitar el cargo y la cédula del usuario, por eso esta consulta envuelve, para hacer un solo execute().*/
     private $sql = "select cargo, cc from personal_interno 
     WHERE cc= (SELECT cc_personaFK from login WHERE usr =:usr and passw=:passw);";

     public function Loguear($usr,$passw){
        

        try{
            $instancia = conexion::getInstance();
            $OBJConexionPDO = $instancia->getConnection();
            $statement = $OBJConexionPDO->prepare($this->sql);
            $resultado = $statement->execute(array(':usr'=>$usr,':passw'=>$passw));
            if($resultado){
                $tableVirtual = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach($tableVirtual as $row){

                    $this->CedulaUsuario = $row['cc'];
                    $this->CargoUsuario = $row['cargo'];                    
                    
                }               
                
                return array('cc'=>$this->CedulaUsuario,'cargo'=>$this->CargoUsuario);
                
            }else{
                
                return $statement->errorInfo();
            }

        }catch(PDOException $e){

            echo 'FATAL, dentro del CATCH';
            return $e->errorInfo;

        }


     }

}
