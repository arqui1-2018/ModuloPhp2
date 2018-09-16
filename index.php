<?php

date_default_timezone_set('Central');
require_once __DIR__ . '/public/functions.php';

router('GET', '^/$', function() {
    echo 'Esta es una api, hola!!';
});

router('GET', '^/query$', function() {
    $manager = new MongoDB\Driver\Manager("mongodb://arqui1db-2018:jY4INnddURHmEEJDL05qGHEYGZVQgGvf4EmomytTCqhf3wsxhuxbUPN9CJAzkJWyKvt9MLrfx1TOdxOwhNT1Xw==@arqui1db-2018.documents.azure.com:10255/?ssl=true&replicaSet=globaldb");
    $query = new MongoDB\Driver\Query(array());
    $cursor = $manager->executeQuery('admin.Entrada', $query);
    $array = $cursor->toArray();
    $data = "";
    $data = '[{"Fecha":"'.$array[0]->Fecha.'", "Mensaje":"'.$array[0]->Mensaje.'"}';
    for($i = 1; $i < count($array); $i++)
         $data.=',{"Fecha":"'.$array[$i]->Fecha.'", "Mensaje":"'.$array[$i]->Mensaje.'"}';    
    $data .= "]";
    echo $data;
    // foreach ($cursor as $document) {
    //     echo "{ Fecha: $document->Fecha , Mensaje: $document->Mensaje }";
    // }
});

// // With named parameters
// router('GET', '^/users/(?<id>\d+)$', function($params) {
//     echo "You selected User-ID: ";
//     var_dump($params);
// });

// // POST request to /users
// router('POST', '^/users$', function() {
//     header('Content-Type: application/json');
//     $json = json_decode(file_get_contents('php://input'), true);
//     echo json_encode(['result' => 1]);
// });

// GET insert Correct
router('GET', '^/insert/correct$', function(){
    $bulk = new MongoDB\Driver\BulkWrite();

    $bulk->insert(['Fecha' => date(DATE_RFC2822), 'Mensaje' => 'Correcto']);

    $manager = new MongoDB\Driver\Manager("mongodb://arqui1db-2018:jY4INnddURHmEEJDL05qGHEYGZVQgGvf4EmomytTCqhf3wsxhuxbUPN9CJAzkJWyKvt9MLrfx1TOdxOwhNT1Xw==@arqui1db-2018.documents.azure.com:10255/?ssl=true&replicaSet=globaldb");
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 100);
    $result = $manager->executeBulkWrite('admin.Entrada', $bulk, $writeConcern);

});

// GET insert Incorrect
router('GET', '^/insert/incorrect$', function(){
    $bulk = new MongoDB\Driver\BulkWrite();

    $bulk->insert(['Fecha' => date(DATE_RFC2822), 'Mensaje' => 'Incorrecto']);

    $manager = new MongoDB\Driver\Manager("mongodb://arqui1db-2018:jY4INnddURHmEEJDL05qGHEYGZVQgGvf4EmomytTCqhf3wsxhuxbUPN9CJAzkJWyKvt9MLrfx1TOdxOwhNT1Xw==@arqui1db-2018.documents.azure.com:10255/?ssl=true&replicaSet=globaldb");
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 100);
    $result = $manager->executeBulkWrite('admin.Entrada', $bulk, $writeConcern);

});
header("HTTP/1.0 404 Not Found");
echo '404 Not Found';

?>