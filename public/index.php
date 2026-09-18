<?php
session_start();

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH .'/src/Database.php';

require_once BASE_PATH .'/src/Auth.php';

try{
    $pdo = Database::getConnection();
    $uri = parse_url($_SERVER['REQUEST_URI']??'/', PHP_URL_PATH);
    $uri = rtrim($uri,'/')?:'/';
    switch ($uri) {
        case '/':
            require BASE_PATH .'/views/home.php';
            break;

        case '/register':
            require BASE_PATH .'/views/register.php';
            break;

        case '/login':
            require BASE_PATH .'/views/login.php';
            break;

        case '/logout':
                Auth::logout();
                header('Location: /');
                exit;

        default:
            http_response_code(404);
            echo '<h1>404 не найдено</h1>';
    }
}

catch(PDOException $e){
    echo "Error conection pls: ".$e->getMessage();
}
?>
