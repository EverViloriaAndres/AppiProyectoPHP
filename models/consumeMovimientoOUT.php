<?php
require_once "../assets/headers.php";

require_once  "../Clclientes/MovimientoOUT.php";
$cliente= new MovimientosOUT();

switch($_SERVER['REQUEST_METHOD']){
    case 'GET';
        if(isset($_GET['criterio'])){
            
            $criterio = $_GET['criterio'];
            $resultado = $cliente->getByCriterio( $criterio );
                    if(!(count($resultado)==0)){
                        http_response_code(200);
                        echo json_encode($resultado,JSON_PRETTY_PRINT);
                    }else{
                        http_response_code(500);
                        echo json_encode(array('Estado'=>'Error inesperado'),JSON_PRETTY_PRINT);
                    }        

        }else{
            echo json_encode($cliente->getMovimientoOut(),JSON_PRETTY_PRINT);
            
        }
    
    break;
    case 'POST';
            $datos = json_decode(file_get_contents('php://input'),true);
            if($datos!=NULL){
                    $autorizadoPOR = $datos["autorizadoPOR"];
                    $guardaTurno = $datos["guardaTurno"];
                    $motivo = $datos["motivo"];
                    $personaRetira = $datos["personaRetira"];
                    $ccPersonaRetita = $datos["ccPersonaRetita"];
                    $areaPersonaRetira = $datos["areaPersonaRetira"];
                    $serialActivo = $datos["serialActivo"];
                    $observacion = $datos["observacion"];

                $resulsInsert = $cliente->insert($autorizadoPOR,$guardaTurno,
                                $motivo,$personaRetira,$ccPersonaRetita,
                                $areaPersonaRetira,$serialActivo,$observacion);

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

                $id_movimiento = $datos["id_movimiento"];
                $autorizadoPOR = $datos["autorizadoPOR"];
                $guardaTurno = $datos["guardaTurno"];
                $motivo = $datos["motivo"];
                $personaRetira = $datos["personaRetira"];
                $ccPersonaRetita = $datos["ccPersonaRetita"];
                $areaPersonaRetira = $datos["areaPersonaRetira"];
                $serialActivo = $datos["serialActivo"];
                $observacion = $datos["observacion"];
                
            
                $resulsUpdate = $cliente->update($id_movimiento,$autorizadoPOR,$guardaTurno,$motivo,$personaRetira,
                          $ccPersonaRetita,$areaPersonaRetira,$serialActivo, $observacion);
                
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