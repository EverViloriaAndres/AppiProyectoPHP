<?php 

include_once '../assets/headers.php';
include_once '../Clclientes/ReqCasual.php';
$Request = new Request();



switch($_SERVER['REQUEST_METHOD']){
    

    case 'GET';
    if(isset($_GET['criterio'])){

        $criterio = $_GET['criterio'];
        $resulset = $Request->getByCriterio($criterio);
        
        if(!(count($resulset)>0)){ 
            http_response_code(404);
            
        }
        echo json_encode($resulset,JSON_PRETTY_PRINT);

        

    }elseif(isset($_GET['Option2'])){
        $lugares = $Request->listarlugares();
        echo json_encode($lugares,JSON_PRETTY_PRINT);

    }elseif(isset($_GET['borrar'])){
        $criterio =$_GET['borrar'];
    if(isset($criterio)){
        
        $result = $Request->delete($criterio);
        if(!($result)){
            echo json_encode(array('Estado'=>'false'),JSON_PRETTY_PRINT);
            
            
        }
        echo json_encode(array('Estado'=>'true'),JSON_PRETTY_PRINT);

    }else{
        echo json_encode(array('Estado'=>'void'),JSON_PRETTY_PRINT);

    }
    } else{
        $resulset = $Request->getAll();
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
        
		
        
        $requerimiento= $datos['requerimiento'];
        $lugarFK = $datos['lugarFK'];
        $quien_informa= $datos['quien_informa'];
        $area_requerimiento  = $datos[' area_requerimiento '];
        $accion = $datos['accion'];
        $observacion = $datos['observacion'];
        $fecha_requerimiento = $datos['fecha_requerimiento'];
        
		
        $resulset = $Request->insert($requerimiento,$lugarFK,$quien_informa,$area_requerimiento,$accion,
        $observacion,$fecha_requerimiento );
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

        $requerimiento= $datos['requerimiento'];
        $lugarFK = $datos['lugarFK'];
        $quien_informa= $datos['quien_informa'];
        $area_requerimiento  = $datos[' area_requerimiento '];
        $accion = $datos['accion'];
        $observacion = $datos['observacion'];
        $fecha_requerimiento = $datos['fecha_requerimiento'];
        $id_requerimiento = $datos['id_requerimiento'];

        $resulset = $Request->update( $requerimiento,$lugarFK,$quien_informa,$area_requerimiento,$accion,
        $observacion,$fecha_requerimiento,$id_requerimiento);
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
 