<?php
require __DIR__ . '/../vendor/autoload.php';

try {
   
    $client = new MongoDB\Client(
        "mongodb+srv://mello:joaomello13@cluster0.du21r.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0"
    );
    $db = $client->selectDatabase('Trabalho_Mongo');

} catch (Exception $e) {
    echo "Erro ao conectar ao MongoDB: " . $e->getMessage();
}
?>
