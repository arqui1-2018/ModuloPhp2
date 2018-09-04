<?php

require_once __DIR__ . '/public/functions.php';

router('GET', '^/$', function() {
    $client = new MongoClient("mongodb://phpdb:1nNMDxrQKUl6TSVbe5U6EihSmDyXRtHg2vLpcAlsR8d5hDW9x0wv5fPJoGPewosUe8JFErvEyPbP5tFjHjxkgQ==@phpdb.documents.azure.com:10255/?ssl=true&replicaSet=globaldb");
    echo 'Holla Mundo';
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
