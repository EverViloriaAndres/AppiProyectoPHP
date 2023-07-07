<?php
/*Cabeceras para los cors, dar acceso a la api . */

require_once "../assets/headers.php";
require_once  "../Clclientes/clienteActivos.php";



$cliente= new Activos();
/**Evaluar los posbles casos  en los que se puede hacer solicitud por http, y proceder segun el caso */

switch($_SERVER['REQUEST_METHOD']){
    case 'GET';
    /*Si biene algo por url, lo uso como filtro*/
        if(isset($_GET['criterio'])){
            
            $criterio = $_GET['criterio'];
            echo json_encode($cliente->getByCriterio($criterio),JSON_PRETTY_PRINT);

        }
        else{
            
            echo json_encode($cliente->getAll(),JSON_PRETTY_PRINT);
        }
    
    break;
    
    case 'POST';

        $datos = json_decode(file_get_contents('php://input'),true);
        //el argumento true especifica que queremos un array asociativo
        if($datos!=NULL){
                $num_serial = $datos["num_serial"];
                $nombre = $datos["nombre"];
                $describcion = $datos["describcion"];
                $valor = $datos["valor"];
                $enPosecion = $datos["enPosecion"];
            $resulsInsert = $cliente->insert($num_serial,$nombre,$describcion,$valor,$enPosecion);
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
            $num_serial = $datos["num_serial"];
            $nombre = $datos["nombre"];
            $describcion = $datos["describcion"];
            $valor = $datos["valor"];
            $enPosecion = $datos["enPosecion"];
            
           
            $resulsUpdate = $cliente->update($num_serial, $nombre, $describcion, $valor, $enPosecion);
            
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
        
        if (isset($_GET['num_serial'])) {
            $num_serial = $_GET["num_serial"];           
            
            $resultDelete = $cliente->delete($num_serial);
            
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
