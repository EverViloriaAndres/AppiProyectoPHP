<?php
require_once "../assets/headers.php";

require_once  "../Clclientes/ReporteArqueo.php";
$ReporteArqueo= new ArqueoRepostado();

switch($_SERVER['REQUEST_METHOD']){
    case 'GET';
        if(isset($_GET['criterio'])){
            
            $criterio = $_GET['criterio'];
            $resultado = $ReporteArqueo->getByCriterio( $criterio );
                    if(!(count($resultado)==0)){
                        http_response_code(200);
                        echo json_encode($resultado,JSON_PRETTY_PRINT);
                    }else{
                        http_response_code(500);
                        echo json_encode(array('Estado'=>'Sin Coincidencias'),JSON_PRETTY_PRINT);
                    }        

        }elseif(isset($_GET['lugar'])){
            echo json_encode($ReporteArqueo->lugares(),JSON_PRETTY_PRINT);

        } elseif(isset($_GET['guarda'])){
            echo json_encode($ReporteArqueo->guardas(),JSON_PRETTY_PRINT);

        }     
        else{
            echo json_encode($ReporteArqueo->getAll(),JSON_PRETTY_PRINT);
            
        }
    
    break;
    case 'POST';
            $datos = json_decode(file_get_contents('php://input'),true);
            if($datos!=NULL){
                $fecha_arqueo = $datos["fecha_arqueo"];
                $lugarFK = $datos["lugarFK"];
                $guardaFK = $datos["guardaFK"];
                $num_M = $datos["num_M"];
                $num_C = $datos["num_C"];
                $num_B = $datos["num_B"];
                $total = $datos["total"];
                $observacion = $datos["observacion"];
                
                

                $resulsInsert = $ReporteArqueo->insert($fecha_arqueo,$lugarFK,$guardaFK,$num_M,
                $num_C,$num_B,$total,$observacion);

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

                $fecha_arqueo = $datos["fecha_arqueo"];
                $lugarFK = $datos["lugarFK"];
                $guardaFK = $datos["guardaFK"];
                $num_M = $datos["num_M"];
                $num_C = $datos["num_C"];
                $num_B = $datos["num_B"];
                $total = $datos["total"];
                $observacion = $datos["observacion"];
                $id_registro = $datos["id_registro"];
                
                
                $resulsUpdate = $ReporteArqueo->update( $fecha_arqueo,$lugarFK,$guardaFK,$num_M,
                $num_C,$num_B,$total,$observacion,$id_registro  );
                
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