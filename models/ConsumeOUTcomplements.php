<?php

include_once '../assets/headers.php';
include_once '../Clclientes/OUTcomplement.php';
$OUTcomplements = new OUTcomplements();
    if(isset($_GET['case'])){
        $case = $_GET['case'];
        
        switch ($case){
            case 1;
            echo json_encode($OUTcomplements->listarAutorizadores(),JSON_PRETTY_PRINT);
            break;

            case 2;
            echo json_encode($OUTcomplements->listarGuardas(),JSON_PRETTY_PRINT);
            break;

            case 3;
            echo json_encode($OUTcomplements->listarActivos(),JSON_PRETTY_PRINT);
            break;

            default;
            echo json_encode(array('Estado'=>'Caso desconocido'),JSON_PRETTY_PRINT);
            break;
        }
    }else{
        echo json_encode(array('Estado'=>'Valida lo que pasas por GET'));
    }