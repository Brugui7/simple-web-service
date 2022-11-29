<?php
header('Content-Type: application/json; charset=utf-8');

$params = [];
$params['nombre'] = $_POST['nombre'] ?? null;
$params['apellidos'] = $_POST['apellidos'] ?? null;
$params['temperatura'] = $_POST['temperatura'] ?? null;
$params['format'] = $_POST['format'] ?? null;
$params['ciudad'] = $_POST['ciudad'] ?? null;
$params['provincia'] = $_POST['provincia'] ?? null;

$response = [
    'success' => false,
    'error' => null,
    'temp' => null
];

foreach ($params as $key => $value) {
    if (empty($value)) {
        $response['error'] = 'Parámetro "' . $key . '" vacío';
        echo json_encode($response);
        die;
    }
}

if ($params['format'] != 1 && $params['format'] != 2) {
    $response['error'] = 'El Parámetro "format" solo admite los valores 1 y 2';
    echo json_encode($response);
    die;
}

if (is_numeric($params['temperatura']) === false) {
    $response['error'] = 'Temperatura debe ser un número entero.';
    echo json_encode($response);
    die;
}

$params['temperatura'] = round($params['temperatura']);


try {

    $pdo = new PDO(
        'mysql:dbname=test;host=127.0.0.1',
        'user1',
        '123',
        [PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
    );

    $query = $pdo->prepare('INSERT INTO users (nombre, apellidos, temperatura, `format`, ciudad, provincia) VALUES
                (:nombre, :apellidos, :temperatura, :format, :ciudad, :provincia)
    ');

    $query->bindParam(':nombre', $params['nombre']);
    $query->bindParam(':apellidos', $params['apellidos']);
    $query->bindParam(':temperatura', $params['temperatura'], PDO::PARAM_INT);
    $query->bindParam(':format', $params['format'], PDO::PARAM_INT);
    $query->bindParam(':ciudad', $params['ciudad']);
    $query->bindParam(':provincia', $params['provincia']);

    $query->execute();
    $response['success'] = true;
    $response['temp'] = $pdo->lastInsertId();
    echo json_encode($response);
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Ocurrió un error en la base de datos.
                    Inténtalo más tarde o ponte en contacto con el profesor.
                    ERROR: ' . $e->getMessage() . '.',
        'temp' => null
    ]);
}


