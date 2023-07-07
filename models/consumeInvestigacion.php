<?php
require_once "../assets/headers.php";

require_once  "../Clclientes/ivestigaciones.php";
$investigacion= new investigacion();

switch($_SERVER['REQUEST_METHOD']){
    case 'GET';
        if(isset($_GET['criterio'])){
            
            $criterio = $_GET['criterio'];
            $resultado = $investigacion->getByCriterio( $criterio );
                    if(!(count($resultado)==0)){
                        http_response_code(200);
                        echo json_encode($resultado,JSON_PRETTY_PRINT);
                    }else{
                        http_response_code(500);
                        echo json_encode(array('Estado'=>'Sin Coincidencias'),JSON_PRETTY_PRINT);
                    }        

        }elseif(isset($_GET['lugar'])){
            echo json_encode($investigacion->lugares(),JSON_PRETTY_PRINT);

        } elseif(isset($_GET['gerente'])){
            echo json_encode($investigacion->gerentes(),JSON_PRETTY_PRINT);

        }     
        else{
            echo json_encode($investigacion->getAll(),JSON_PRETTY_PRINT);
            
        }
    
    break;
    case 'POST';
            $datos = json_decode(file_get_contents('php://input'),true);
            if($datos!=NULL){
                $motivo = $datos["motivo"];
                $quienSolicita = $datos["quienSolicita"];
                $quienAutoriza_FK = $datos["quienAutoriza_FK"];
                $lugarFK = $datos["lugarFK"];
                $investigadoPor = $datos["investigadoPor"];
                $inicio = $datos["inicio"];
                $fin = $datos["fin"];
                $finalizada = $datos["finalizada"];
                $aprehension = $datos["aprehension"];
                $observaciones_resultado = $datos["observaciones_resultado"];

                $resulsInsert = $investigacion->insert($motivo,$quienSolicita,$quienAutoriza_FK,$lugarFK,
                $investigadoPor,$inicio,$fin,$finalizada,$aprehension,$observaciones_resultado);

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

                $id = $datos["id"];
                $motivo = $datos["motivo"];
                $quienSolicita = $datos["quienSolicita"];
                $quienAutoriza_FK = $datos["quienAutoriza_FK"];
                $lugarFK = $datos["lugarFK"];
                $investigadoPor = $datos["investigadoPor"];
                $inicio = $datos["inicio"];
                $fin = $datos["fin"];
                $finalizada = $datos["finalizada"];
                $aprehension = $datos["aprehension"];
                $observaciones_resultado = $datos["observaciones_resultado"];
                
                
                $resulsUpdate = $investigacion->update(                    
                    $id, $motivo, $quienSolicita, $quienAutoriza_FK, $lugarFK, 
                    $investigadoPor, $inicio, $fin, $finalizada, 
                    $aprehension, $observaciones_resultado
                );
                
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