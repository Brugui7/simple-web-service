<?php

header('Content-Type: application/json; charset=utf-8');

$user = $_POST['user'] ?? null;
$password = $_POST['passwd'] ?? null;

$response = [
    "success" => true,
    "error" => null,
    "credentials" => true
];

if (empty($user) || empty($password)) {
    $response = [
        "success" => false,
        "error" => "No se han recibido todos los parámetros requeridos.",
        "credentials" => false
    ];
}

echo json_encode($response);