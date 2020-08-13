<?php

include_once __DIR__ . "/../Config.php";
use Api\Controller\Perform\UserController;

header('Content-Type: application/json');
$json = file_get_contents('php://input');
$obj = json_decode($json);

if(!isset($_GET) OR empty($_GET)) {
    http_response_code(400);
    die();
}

if(!isset($obj) OR empty($obj)) {
    http_response_code(400);
    echo json_encode(["message" => "Malformed JSON"]);
    die();
}

switch (array_keys($_GET)[0]) {
    case 'User':
        echo json_encode(UserController::read($obj));
        break;
    default:
        http_response_code(404);
        echo json_encode(["message" => "Invalid parameter"]);
}