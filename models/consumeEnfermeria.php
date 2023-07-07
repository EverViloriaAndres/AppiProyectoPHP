<?php 

include_once '../assets/headers.php';
include_once '../Clclientes/enfermeria.php';
$ReporteEnfermeria = new ReporteEnfermeria();



switch($_SERVER['REQUEST_METHOD']){
    

    case 'GET';
    if(isset($_GET['criterio'])){

        $criterio = $_GET['criterio'];
        $resulset = $ReporteEnfermeria->getByCriterio($criterio);
        
        if(!(count($resulset)>0)){ 
            http_response_code(404);
            
        }
        echo json_encode($resulset,JSON_PRETTY_PRINT);

        

    }elseif(isset($_GET['Option2'])){
        $lugares = $ReporteEnfermeria->listarlugares();
        echo json_encode($lugares,JSON_PRETTY_PRINT);

    }elseif(isset($_GET['borrar'])){
        $criterio =$_GET['borrar'];
    if(isset($criterio)){
        
        $result = $ReporteEnfermeria->delete($criterio);
        if(!($result)){
            echo json_encode(array('Estado'=>'false'),JSON_PRETTY_PRINT);
            
            
        }
        echo json_encode(array('Estado'=>'true'),JSON_PRETTY_PRINT);

    }else{
        echo json_encode(array('Estado'=>'void'),JSON_PRETTY_PRINT);

    }
    } else{
        $resulset = $ReporteEnfermeria->getAll();
        if(!(count($resulset)>0)){ 
            http_response_code(404);
            echo json_encode(array('Estado'=>'No hay Registros, validar'),JSON_PRETTY_PRINT);
        }
        echo json_encode($resulset,JSON_PRETTY_PRINT);

    }
    break;


    case 'POST';
    $datos = json_decode(file_get_contents('php://input'),true);
    if($datos!==null){
        
		
        $id_suceso = $datos['id_suceso'];
        $nombre_paciente= $datos['nombre_paciente'];
        $apellido_paciente= $datos['apellido_paciente'];
        $area_paciente = $datos['area_paciente'];
        $motivo_visita = $datos['motivo_visita'];
        $lugarFK = $datos['lugarFK'];
        $accionar = $datos['accionar'];
        $fecha_visita = $datos['fecha_visita'];
        $observaciones = $datos['observaciones'];
		
        $resulset = $ReporteEnfermeria->insert($nombre_paciente,$apellido_paciente,$area_paciente,
        $motivo_visita,$lugarFK,$accionar,$fecha_visita,$observaciones);
        if(!$resulset){
            echo json_encode(array('Estado'=>'false'),JSON_PRETTY_PRINT);
        }
        echo json_encode(array('Estado'=>'true'),JSON_PRETTY_PRINT);
        
       
    }else{
        echo json_encode(array('Estado'=>'No se obtuvieron datos, validar'),JSON_PRETTY_PRINT);
    }
    break;


    case 'PUT';
    $datos = json_decode(file_get_contents('php://input'),true);
    if($datos!==null){

        $nombre_paciente= $datos['nombre_paciente'];
        $apellido_paciente= $datos['apellido_paciente'];
        $area_paciente = $datos['area_paciente'];
        $motivo_visita = $datos['motivo_visita'];
        $lugarFK = $datos['lugarFK'];
        $accionar = $datos['accionar'];
        $fecha_visita = $datos['fecha_visita'];
        $observaciones = $datos['observaciones'];
        $id_suceso = $datos['id_suceso'];

        $resulset = $ReporteEnfermeria->update($nombre_paciente,$apellido_paciente,$area_paciente,
        $motivo_visita,$lugarFK,$accionar,$fecha_visita,$observaciones,$id_suceso);
        if(!$resulset){
            echo json_encode(array('Estado'=>'false'),JSON_PRETTY_PRINT);
        }
        echo json_encode(array('Estado'=>'true'),JSON_PRETTY_PRINT);
    
    }else{
        echo json_encode(array('Estado'=>'No se obtuvieron datos, validar'),JSON_PRETTY_PRINT);
        
    }        

    break;   

    

    default ;
    http_response_code(404);
    echo json_encode(array('Caso: '=>'Request Method no soportado'),JSON_PRETTY_PRINT);
    break;
}
 