<?php

$host = "localhost";
$username = "root";
$password = ""; 
$databaseName = "techNinjaStore";
try {
    $db = new PDO("mysql:host=$host;dbname=$databaseName", $username, $password);
    // Habilitar erros PDO
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   

    // Realize um teste de consulta simples
    $query = "SELECT version() as version";
    $result = $db->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>

