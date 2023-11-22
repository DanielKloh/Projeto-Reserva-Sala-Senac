<?php

// Inicio da conexão com o banco de dados utilizando PDO
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "projetoreservasalas";
$port = 3306;

try {
    $conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);
}
 catch (PDOException $err) {
    die("Erro: Conexão com banco de dados não realizado com sucesso. Erro gerado " . $err->getMessage());
}

?>