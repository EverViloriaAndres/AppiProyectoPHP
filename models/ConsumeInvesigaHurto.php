<?php
require_once "../assets/headers.php";

require_once  "../Clclientes/investigaHurto.php";
$investigacionHurto= new investigacionHurto();

switch($_SERVER['REQUEST_METHOD']){
    case 'GET';
        if(isset($_GET['criterio'])){
            
            $criterio = $_GET['criterio'];
            $resultado = $investigacionHurto->getByCriterio( $criterio );
                    if(!(count($resultado)==0)){
                        http_response_code(200);
                        echo json_encode($resultado,JSON_PRETTY_PRINT);
                    }else{
                        http_response_code(500);
                        echo json_encode(array('Estado'=>'Sin Coincidencias'),JSON_PRETTY_PRINT);
                    }        

        }elseif(isset($_GET['investigacion'])){
            echo json_encode($investigacionHurto->investigacion(),JSON_PRETTY_PRINT);

        } elseif(isset($_GET['hurto'])){
            echo json_encode($investigacionHurto->reporteHurto(),JSON_PRETTY_PRINT);

        }     
        else{
            echo json_encode($investigacionHurto->getAll(),JSON_PRETTY_PRINT);
            
        }
    
    break;
    case 'POST';
            $datos = json_decode(file_get_contents('php://input'),true);
            if($datos!=NULL){
                $reporteHurto_FK = $datos["reporteHurto_FK"];
                $investigacion_FK = $datos["investigacion_FK"];

                $resulsInsert = $investigacionHurto->insert($reporteHurto_FK,$investigacion_FK);

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
                $reporteHurto_FK = $datos["reporteHurto_FK"];
                $investigacion_FK = $datos["investigacion_FK"];                
                
                $resulsUpdate = $investigacionHurto->update($id, $reporteHurto_FK,$investigacion_FK );
                
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