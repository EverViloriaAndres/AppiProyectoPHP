<?php 

include_once '../assets/headers.php';
include_once '../Clclientes/NovedadDiaria.php';
$OBJDiariaNovedad = new NovedadDiaria();



switch($_SERVER['REQUEST_METHOD']){
    

    case 'GET';
    if(isset($_GET['criterio'])){
        $criterio = $_GET['criterio'];
        $resulset = $OBJDiariaNovedad->getByCriterio($criterio);
        if(!(count($resulset)>0)){ 
            echo json_encode(array('Estado'=>'Ajuste el filtro; Sin datos en el resulset'),JSON_PRETTY_PRINT);
        }
        echo json_encode($resulset,JSON_PRETTY_PRINT);
    }elseif(isset($_GET['lugares'])){
        /*hago esta maraña para mo crear un archivo separado que consuma este unico metodo.
        Que es necesario en el componente NovedadesDiarias*/
        $lugares = $OBJDiariaNovedad->lugaresComplements();
        echo json_encode($lugares,JSON_PRETTY_PRINT);

    }else{
        $resulset = $OBJDiariaNovedad->getAll();
        if(!(count($resulset)>0)){ 
            echo json_encode(array('Estado'=>'No se obtuvieron datos, validar'),JSON_PRETTY_PRINT);
        }
        echo json_encode($resulset,JSON_PRETTY_PRINT);

    }
    break;


    case 'POST';
    $datos = json_decode(file_get_contents('php://input'),true);
    if($datos!==null){
        
		$novedadValue = $datos['novedad'];
		$lugarFKValue = $datos['lugarFK'];
		$accionarValue = $datos['accionar'];
		$observacionesValue = $datos['observaciones'];
		$fechaSucesoValue = $datos['fechaSuceso'];
		
        $resulset = $OBJDiariaNovedad->insertNovedad($novedadValue,$lugarFKValue,$accionarValue,$observacionesValue,$fechaSucesoValue);
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

        $id =  $datos['id'];
		$novedadValue = $datos['novedad'];
		$lugarFKValue = $datos['lugarFK'];
		$accionarValue = $datos['accionar'];
		$observacionesValue = $datos['observaciones'];
		$fechaSucesoValue = $datos['fechaSuceso'];
        $resulset = $OBJDiariaNovedad->update($id,$novedadValue,$lugarFKValue,$accionarValue,$observacionesValue,$fechaSucesoValue);
        if(!$resulset){
            echo json_encode(array('Estado'=>'false'),JSON_PRETTY_PRINT);
        }
        echo json_encode(array('Estado'=>'true'),JSON_PRETTY_PRINT);
    
    }else{
        echo json_encode(array('Estado'=>'No se obtuvieron datos, validar'),JSON_PRETTY_PRINT);
        
    }
    

          

    break;


    case 'DELETE';
    if(isset($_GET['criterio'])){
        $criterio = $_GET['criterio'];
        $resulset = $OBJDiariaNovedad->delete($criterio);
        if(!$resulset ){
            http_response_code(404);
            echo json_encode(array('Estado'=>'No se encontro el registro a eliminar, valide el criterio'),JSON_PRETTY_PRINT);
        }else{
            http_response_code(200);
            echo json_encode(array('Estado'=>'true'),JSON_PRETTY_PRINT);
        }
        

        
    }else{
        echo json_encode(array('Estado'=>'No se espesifico el criterio de eliminacion'),JSON_PRETTY_PRINT);
    }

    break;

    


    default ;
    http_response_code(404);
    echo json_encode(array('Caso: '=>'Request Method no soportado'),JSON_PRETTY_PRINT);
    break;
}