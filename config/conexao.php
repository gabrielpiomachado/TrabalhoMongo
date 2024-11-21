<?php
require '../vendor/autoload.php';

try {
    // Conectar ao MongoDB Atlas
    $client = new MongoDB\Client("mongodb+srv://mello:joaomello13@cluster0.du21r.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0");

    // Selecionar o banco de dados
    $db = $client->selectDatabase('Trabalho_Mongo');

    // Testar a conexão listando as coleções
    $collections = $db->listCollections();
    
    echo "Conexão bem-sucedida! As coleções no banco de dados são:<br>";
    
    foreach ($collections as $collection) {
        echo $collection->getName() . "<br>";
    }
} catch (Exception $e) {
    // Exibir erro se houver problemas na conexão
    echo "Erro ao conectar ao MongoDB: " . $e->getMessage();
}
?>
