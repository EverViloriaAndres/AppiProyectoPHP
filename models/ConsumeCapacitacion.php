<?php
require_once "../assets/headers.php";

require_once  "../Clclientes/capacitaciones.php";
$capacitacion= new capacitacion();

switch($_SERVER['REQUEST_METHOD']){
    case 'GET';
        if(isset($_GET['criterio'])){
            
            $criterio = $_GET['criterio'];
            $resultado = $capacitacion->getByCriterio( $criterio );
                    if(!(count($resultado)==0)){
                        http_response_code(200);
                        echo json_encode($resultado,JSON_PRETTY_PRINT);
                    }else{
                        http_response_code(500);
                        echo json_encode(array('Estado'=>'Sin Coincidencias'),JSON_PRETTY_PRINT);
                    }        

        }elseif(isset($_GET['lugar'])){
            echo json_encode($capacitacion->lugares(),JSON_PRETTY_PRINT);

        } elseif(isset($_GET['tutor'])){
            echo json_encode($capacitacion->guardas(),JSON_PRETTY_PRINT);

        }elseif(isset($_GET['borrar'])){
            $criterio =$_GET['borrar'];
            if(isset($criterio)){
                
                $result = $capacitacion->delete($criterio);
                if(!($result)){
                    echo json_encode(array('Estado'=>'false'),JSON_PRETTY_PRINT);
                    
                    
                }
                echo json_encode(array('Estado'=>'true'),JSON_PRETTY_PRINT);
        
            }else{
                echo json_encode(array('Estado'=>'void'),JSON_PRETTY_PRINT);
        
            } 
        }

        else{
            echo json_encode($capacitacion->getAll(),JSON_PRETTY_PRINT);
            
        }
    
    break;
    case 'POST';
            $datos = json_decode(file_get_contents('php://input'),true);
            if($datos!=NULL){
                $cc_persona_tutor_Fk = $datos["cc_persona_tutor_Fk"];
                $tema_capacitacion = $datos["tema_capacitacion"];
                $fecha_capacitacion = $datos["fecha_capacitacion"];
                $numero_horas = $datos["numero_horas"];
                $modalidad = $datos["modalidad"];
                $lugarFK = $datos["lugarFK"];
                $observacion = $datos["observacion"];
                
                
                

                $resulsInsert = $capacitacion->insert($cc_persona_tutor_Fk, $tema_capacitacion,
                $fecha_capacitacion, $numero_horas, $modalidad, $lugarFK, $observacion);

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

                $cc_persona_tutor_Fk = $datos["cc_persona_tutor_Fk"];
                $tema_capacitacion = $datos["tema_capacitacion"];
                $fecha_capacitacion = $datos["fecha_capacitacion"];
                $numero_horas = $datos["numero_horas"];
                $modalidad = $datos["modalidad"];
                $lugarFK = $datos["lugarFK"];
                $observacion = $datos["observacion"];
                $id_capacitacion = $datos["id_capacitacion"];
                
                
                $resulsUpdate = $capacitacion->update( $cc_persona_tutor_Fk, $tema_capacitacion,
                $fecha_capacitacion, $numero_horas, $modalidad, $lugarFK, $observacion,$id_capacitacion );
                
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