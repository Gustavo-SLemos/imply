<?php

try {
    $conn = new pdo('mysql:host=localhost;dbname=test', 'root', '');
    echo "Conectou";
} catch (PDOException $e) {
    echo "Erro ao se conectar: Erro " . $e->getMessage();
}