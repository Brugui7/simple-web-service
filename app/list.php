<?php
require_once __DIR__ . '/constants.php';
header('Content-Type: application/json; charset=utf-8');

try {
    $pdo = new PDO(
        'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST,
        DB_USER,
        DB_PASSWORD,
        [
            PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ]
    );

    $query = $pdo->query("SELECT * from users");
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode([
        "success" => true,
        "error" => null,
        "temp" => $results
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "error" => 'Ocurrió un error en la base de datos.
                    Inténtalo más tarde o ponte en contacto con el profesor.
                    ERROR: ' . $e->getMessage() . '.',
        "temp" => null
    ]);
}


