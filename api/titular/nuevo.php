<?php

header('Content-Type: application/json');

require_once 'modelosRespuestas/agregarRespuesta.php';
require_once 'modelosRequest/agregarRequest.php';

//se obtiene el body
$json = file_get_contents('php://input',true);
// Convertir el body en un objeto
$req = json_decode($json);

$resp= new AgregarRespuesta();
$resp->IsOk=true;

if ($req->Titular->Direccion===null) {
    $resp->IsOk=false;
    $resp->Mensaje[]='El campo es obligatorio';
}
if ($req->Titular->NroDocumento == null or $req->Titular->ApellidoNombre == null) {
   $resp->IsOk=false;
   $resp->Mensaje[]= 'el numero documento|apellidoNombre es obligatorio.';
}
else {
   $resp->IsOk=true;
   $resp->Mensaje[]='Titular agregado correctamente';
}

foreach ($resp->Mensaje as $m) {
    echo $m.'-';
}

echo json_encode ($resp);