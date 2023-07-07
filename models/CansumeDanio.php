<?php
require_once "../assets/headers.php";

require_once  "../Clclientes/danio.php";
$Danio= new Danio();

switch($_SERVER['REQUEST_METHOD']){
    case 'GET';
        if(isset($_GET['criterio'])){
            
            $criterio = $_GET['criterio'];
            $resultado = $Danio->getByCriterio( $criterio );
                    if(!(count($resultado)==0)){
                        http_response_code(200);
                        echo json_encode($resultado,JSON_PRETTY_PRINT);
                    }else{
                        http_response_code(500);
                        echo json_encode(array('Estado'=>'Sin Coincidencias'),JSON_PRETTY_PRINT);
                    }        

        }elseif(isset($_GET['lugar'])){
            echo json_encode($Danio->lugares(),JSON_PRETTY_PRINT);

        } elseif(isset($_GET['borrar'])){
            $criterio =$_GET['borrar'];
            if(isset($criterio)){
                
                $result = $Danio->delete($criterio);
                if(!($result)){
                    echo json_encode(array('Estado'=>'false'),JSON_PRETTY_PRINT);
                    
                    
                }
                echo json_encode(array('Estado'=>'true'),JSON_PRETTY_PRINT);
        
            }else{
                echo json_encode(array('Estado'=>'void'),JSON_PRETTY_PRINT);
        
            } 
        }

        else{
            echo json_encode($Danio->getAll(),JSON_PRETTY_PRINT);
            
        }
    
    break;
    case 'POST';
            $datos = json_decode(file_get_contents('php://input'),true);
            if($datos!=NULL){

                
                $lugarFK= $datos["lugarFK"];
                $nomObjAfectado= $datos["nomObjAfectado"];
                $causa= $datos["causa"];
                $estado= $datos["estado"];
                $informante= $datos["informante"];
                $fechaSuceso= $datos["fechaSuceso"];
                $observacion= $datos["observacion"];
                
                
                

                $resulsInsert = $Danio->insert($lugarFK,$nomObjAfectado,$causa,
                $estado,$informante,$fechaSuceso,$observacion);

                if($resulsInsert){
                    http_response_code(200);
                    echo json_encode(array('Estado'=>'Insert True'),JSON_PRETTY_PRINT);
                }else{
                    http_response_code(400);
                    echo json_encode(array('Estado'=>'Insert false'),JSON_PRETTY_PRINT);
                }

            }else{
                http_response_code(405);
                echo json_encode(array('Estado'=>'SQL Insert Void'),JSON_PRETTY_PRINT);
            }
    break;

    case 'PUT';
            $datos = json_decode(file_get_contents('php://input'), true);
            if ($datos != NULL) {

                $lugarFK= $datos["lugarFK"];
                $nomObjAfectado= $datos["nomObjAfectado"];
                $causa= $datos["causa"];
                $estado= $datos["estado"];
                $informante= $datos["informante"];
                $fechaSuceso= $datos["fechaSuceso"];
                $observacion= $datos["observacion"];
                $id_danio= $datos["id_danio"];
                
                
                $resulsUpdate = $Danio->update($lugarFK,$nomObjAfectado,$causa,
                $estado,$informante,$fechaSuceso,$observacion,$id_danio );
                
                if ($resulsUpdate) {
                    http_response_code(200);
                    echo json_encode(array('Estado'=>'Update true'),JSON_PRETTY_PRINT);
                } else {
                    http_response_code(400);
                    echo json_encode(array('Estado'=>'Update false'),JSON_PRETTY_PRINT);
                }
            } else {
                echo 'Sin datos PUT';
                echo json_encode(array('Estado'=>'SQL Update Void'),JSON_PRETTY_PRINT);
            }

    break;
    
    

    

    default:
    echo' Recurso desconocido';
    break;

}

?>