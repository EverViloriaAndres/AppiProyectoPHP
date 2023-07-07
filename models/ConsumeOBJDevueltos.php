<?php

require_once "../assets/headers.php";

require_once  "../Clclientes/OBJDevueltos.php";




$OBJdevuelto= new OBJdevuelto();

switch($_SERVER['REQUEST_METHOD']){
    case 'GET';
        if(isset($_GET['criterio'])){
            
            $criterio = $_GET['criterio'];
            $jsonRespuestas = $OBJdevuelto->getByCriterio($criterio);
            echo json_encode($jsonRespuestas,JSON_PRETTY_PRINT);

        }else{
            $JSONRespuestas =  $OBJdevuelto->getMovimientoIN();
            echo json_encode($JSONRespuestas,JSON_PRETTY_PRINT);
            
        }
    
    break;
    case 'POST';
            $datos = json_decode(file_get_contents('php://input'),true);
            if($datos!=NULL){
                    
                    $objetoFK = $datos["objetoFK"];                    
                    $entrgadoPor_FK = $datos["entrgadoPor_FK"];
                    $entregadoA = $datos["entregadoA"];
                    $observaciones = $datos["observaciones"];
                    $fechaSuceso = $datos["fechaSuceso"];                   
                    

                $resulsInsert = $OBJdevuelto->insert($objetoFK,$entrgadoPor_FK,$entregadoA,$observaciones,$fechaSuceso);

                if($resulsInsert){
                    echo json_encode(array('Estado'=>'Insert True'),JSON_PRETTY_PRINT);
                    http_response_code(200);
                }else{
                    echo json_encode(array('Estado'=>'Insert False'),JSON_PRETTY_PRINT);
                    http_response_code(500);
                }

            }else{
                echo json_encode(array('Estado'=>'Inser Void'),JSON_PRETTY_PRINT);
                http_response_code(404);
            }
    break;

    case 'PUT';
            $datos = json_decode(file_get_contents('php://input'), true);
            if ($datos != NULL) {
                $id = $datos["id"];
                $objetoFK = $datos["objetoFK"];                    
                $entrgadoPor_FK = $datos["entrgadoPor_FK"];
                $entregadoA = $datos["entregadoA"];
                $observaciones = $datos["observaciones"];
                $fechaSuceso = $datos["fechaSuceso"];
                
                
            
                $resulsUpdate = $OBJdevuelto->update($id,$objetoFK,$entrgadoPor_FK,$entregadoA,$observaciones,$fechaSuceso);
                
                if ($resulsUpdate) {
                    http_response_code(200);
                    echo  json_encode(array('Estado'=>'Update true'),JSON_PRETTY_PRINT);
                } else {
                    http_response_code(400);
                    echo  json_encode(array('Estado'=>'Update false'),JSON_PRETTY_PRINT);
                }
            } else {
                http_response_code(405);
                echo  json_encode(array('Estado'=>'Update void'),JSON_PRETTY_PRINT);
            }

    break;   

    default:
    echo' Recurso desconocido';
    break;
    //No se permiten DELETE, reglas internas de los supervisores

}

?>