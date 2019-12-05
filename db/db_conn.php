<?php
include __DIR__ . '/db_config.php';
try {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHAR;
    $conn = new PDO($dsn, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // echo 'Connected to Database<br/>';
}catch (PDOException $e){
    echo $e->getMessage();
}

