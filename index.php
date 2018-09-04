<?php

require_once __DIR__ . '/public/functions.php';

router('GET', '^/$', function() {
    $manager = new MongoDB\Driver\Manager("mongodb://arqui1db-2018:jY4INnddURHmEEJDL05qGHEYGZVQgGvf4EmomytTCqhf3wsxhuxbUPN9CJAzkJWyKvt9MLrfx1TOdxOwhNT1Xw==@arqui1db-2018.documents.azure.com:10255/?ssl=true&replicaSet=globaldb");
    $filter = ['id' => ['$gt' => '201513744']];
    $options = [
        'projection' => ['_id' => 0],
        'sort' => ['x' => -1],
    ];
    $query = new MongoDB\Driver\Query($filter, $options);
    $cursor = $manager->executeQuery('db.collection', $query);
    foreach ($cursor as $document) {
        echo $document['Name'];
    }
});

// GET request to /users
router('GET', '^/users$', function() {
    echo '<a href="users/1000">Show user: 1000</a>';
});

// With named parameters
router('GET', '^/users/(?<id>\d+)$', function($params) {
    echo "You selected User-ID: ";
    var_dump($params);
});

// POST request to /users
router('POST', '^/users$', function() {
    header('Content-Type: application/json');
    $json = json_decode(file_get_contents('php://input'), true);
    echo json_encode(['result' => 1]);
});

header("HTTP/1.0 404 Not Found");
echo '404 Not Found';
?>
