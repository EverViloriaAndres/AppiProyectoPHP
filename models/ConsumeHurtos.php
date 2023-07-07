<?php 

include_once '../assets/headers.php';
include_once '../Clclientes/ReporteHurtos.php';
$ReporteHurto = new ReporteHurto();



switch($_SERVER['REQUEST_METHOD']){
    

    case 'GET';
    if(isset($_GET['criterio'])){

        $criterio = $_GET['criterio'];
        $resulset = $ReporteHurto->getByCriterio($criterio);

        if(!(count($resulset)>0)){ 
            echo json_encode(array('Estado'=>'Ajuste el filtro; Sin datos en el resulset'),JSON_PRETTY_PRINT);
        }
        echo json_encode($resulset,JSON_PRETTY_PRINT);

    }elseif(isset($_GET['Option1'])){
        /*hago esta maraña para mo crear un archivo separado que consuma este unico metodo.
        Que es necesario en el componente NovedadesDiarias*/

        $Objetos = $ReporteHurto->listarOBJ();
        echo json_encode($Objetos,JSON_PRETTY_PRINT);

    }elseif(isset($_GET['Option2'])){
        $lugares = $ReporteHurto->listarlugares();
        echo json_encode($lugares,JSON_PRETTY_PRINT);

    }elseif(isset($_GET['Option3'])){
        $victimas = $ReporteHurto->listarVictimas();
        echo json_encode($victimas,JSON_PRETTY_PRINT);

    } else{
        $resulset = $ReporteHurto->getAll();
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
        
		$objExtraviadoFK = $datos['objExtraviadoFK'];
		$lugarFK = $datos['lugarFK'];
		$victimaFK = $datos['victimaFK'];
		$modalidadRobo = $datos['modalidadRobo'];
		$fechaSuceso = $datos['fechaSuceso'];
		
        $resulset = $ReporteHurto->insertNovedad($objExtraviadoFK,$lugarFK,$victimaFK,
                                                    $modalidadRobo,$fechaSuceso);
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

        $idReporte =  $datos['idReporte'];
		$objExtraviadoFK = $datos['objExtraviadoFK'];
		$lugarFK = $datos['lugarFK'];
		$victimaFK = $datos['victimaFK'];
		$modalidadRobo = $datos['modalidadRobo'];
		$fechaSuceso = $datos['fechaSuceso'];

        $resulset = $ReporteHurto->update($objExtraviadoFK,$lugarFK,$victimaFK,
                                            $modalidadRobo,$fechaSuceso,$idReporte);
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
 