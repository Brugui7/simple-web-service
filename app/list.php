<?php
header('Content-Type: application/json; charset=utf-8');


try {
    $pdo = new PDO(
        'mysql:dbname=test;host=127.0.0.1',
        'user1',
        '123',
        [PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
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


