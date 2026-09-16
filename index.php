<?php
require_once __DIR__ . '/src/Database.php';

try{
    $pdo = Database::getConnection();
    echo "<h1>MyBlog</h1>";
}
catch(PDOException $e){
    echo "Error conection pls: ".$e->getMessage();
}
?>
