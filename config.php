<?php 

try {

    $pdo = new PDO('mysql:host=localhost;dbname=projeto_reservas', 'root', '');

} catch(PDOException $e) {
    echo 'ERRO: '.$e->getMessage();
    exit;
}
