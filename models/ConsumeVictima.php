<?php
/*Cabeceras para los cors, dar acceso a la api . */

require_once "../assets/headers.php";
require_once  "../Clclientes/Victima.php";



$Victima= new Victima();
/**Evaluar los posbles casos  en los que se puede hacer solicitud por http, y proceder segun el caso */

switch($_SERVER['REQUEST_METHOD']){
    case 'GET';
    /*Si biene algo por url, lo uso como filtro*/
        if(isset($_GET['criterio'])){
            
            $criterio = $_GET['criterio'];
            echo json_encode($Victima->getByCriterio($criterio),JSON_PRETTY_PRINT);

        }
        else{
            
            echo json_encode($Victima->getAll(),JSON_PRETTY_PRINT);
        }
    
    break;
    
    case 'POST';

        $datos = json_decode(file_get_contents('php://input'),true);
        //el argumento true especifica que queremos un array asociativo
        if($datos!=NULL){
                
                $nombre = $datos["nombre"];
                $apellido = $datos["apellido"];
                $cc = $datos["cc"];
                $cargo = $datos["cargo"];

            $resulsInsert = $Victima->insert($nombre,$apellido,$cc,$cargo);
            if($resulsInsert){
                
                http_response_code(200);
                echo json_encode(array('Estado' => 'true'));
            }else{
                http_response_code(500); 
                echo json_encode(array('Estado' => 'Error al insertar'));
            }

        }else{
            http_response_code(400);
            echo json_encode(array('Estado'=>'Post vacio o mal formateado'));
        }
        
    break;

    case 'PUT';
        $datos = json_decode(file_get_contents('php://input'), true);
        if ($datos != NULL) {
                
                $nombre = $datos["nombre"];
                $apellido = $datos["apellido"];
                $cc = $datos["cc"];
                $cargo = $datos["cargo"];
            
           
            $resulsUpdate = $Victima->update($nombre,$apellido,$cc,$cargo);
            
            if ($resulsUpdate) {
                
                http_response_code(200);
                echo json_encode(array('Estado'=>'true'));
            } else {
                http_response_code(500);
                echo json_encode(array('Estado'=>'false'));
            }
        } else {
            http_response_code(405);
            echo json_encode(array('Estado'=>'Sin datos en el PUT'));
        }

    break;

    case 'DELETE';
        
        if (isset($_GET['cc'])) {
            $cc = $_GET["cc"];           
            
            $resultDelete = $Victima->delete($cc);
            
            if ($resultDelete) {
                http_response_code(200);
                echo json_encode(array('Estado'=>'true'),JSON_PRETTY_PRINT);
            } else {
                http_response_code(400);
                echo json_encode(array('Estado'=>'false'),JSON_PRETTY_PRINT);
            }
        } else {
            http_response_code(405);
            echo json_encode(array('Estado'=>'Sin criterio para eliminar'));
        }
    break;

    default:
    http_response_code(404);
    echo json_encode(array('Estado'=>'Servicio desconocido'),JSON_PRETTY_PRINT);
    break;

}

?>
