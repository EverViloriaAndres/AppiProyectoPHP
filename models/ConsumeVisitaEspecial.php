<?php 

include_once '../assets/headers.php';
include_once '../Clclientes/visitaEspecial.php';
$visita = new visitaEspecial();



switch($_SERVER['REQUEST_METHOD']){
    

    case 'GET';
    if(isset($_GET['criterio'])){

        $criterio = $_GET['criterio'];
        $resulset = $visita->getByCriterio($criterio);
        
        if(!(count($resulset)>0)){ 
            http_response_code(404);
            
        }
        echo json_encode($resulset,JSON_PRETTY_PRINT);

        

    }elseif(isset($_GET['Option2'])){
        $lugares = $visita->listarlugares();
        echo json_encode($lugares,JSON_PRETTY_PRINT);

    }elseif(isset($_GET['borrar'])){
        $criterio =$_GET['borrar'];
    if(isset($criterio)){
        
        $result = $visita->delete($criterio);
        if(!($result)){
            echo json_encode(array('Estado'=>'false'),JSON_PRETTY_PRINT);
            
            
        }
        echo json_encode(array('Estado'=>'true'),JSON_PRETTY_PRINT);

    }else{
        echo json_encode(array('Estado'=>'void'),JSON_PRETTY_PRINT);

    }
    } else{
        $resulset = $visita->getAll();
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
        
		
        
        $nombreVisitante= $datos['nombreVisitante'];
        $ocupacionVisitante= $datos['ocupacionVisitante'];
        $nacionalidad = $datos['nacionalidad'];
        $motivoVisita = $datos['motivoVisita'];
        $lugarFK = $datos['lugarFK'];
        $fechaIn = $datos['fechaIn'];
        $fechaOut = $datos['fechaOut'];
        $Observacion = $datos['Observacion'];
		
        $resulset = $visita->insert($nombreVisitante,$ocupacionVisitante,$nacionalidad,
        $motivoVisita,$lugarFK,$fechaIn,$fechaOut,$Observacion);
        if(!$resulset){
            echo json_encode(array('Estado'=>'false'),JSON_PRETTY_PRINT);
        }
        echo json_encode(array('Estado'=>'true'),JSON_PRETTY_PRINT);
        //echo json_encode(array('Fecha'=>$fechaOut),JSON_PRETTY_PRINT);
        
       
    }else{
        echo json_encode(array('Estado'=>'No se obtuvieron datos, validar'),JSON_PRETTY_PRINT);
    }
    break;


    case 'PUT';
    $datos = json_decode(file_get_contents('php://input'),true);
    if($datos!==null){

        $nombreVisitante= $datos['nombreVisitante'];
        $ocupacionVisitante= $datos['ocupacionVisitante'];
        $nacionalidad = $datos['nacionalidad'];
        $motivoVisita = $datos['motivoVisita'];
        $lugarFK = $datos['lugarFK'];
        $fechaIn = $datos['fechaIn'];
        $fechaOut = $datos['fechaOut'];
        $Observacion = $datos['Observacion'];
        $id_Visita = $datos['id_Visita'];

        $resulset = $visita->update( $nombreVisitante,$ocupacionVisitante,$nacionalidad,
        $motivoVisita,$lugarFK,$fechaIn,$fechaOut,$Observacion,$id_Visita);
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
 