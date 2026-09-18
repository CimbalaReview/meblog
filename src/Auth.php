<?php
class Auth
{
    public static function register(string $username, string $email, string $password):array
    {
        $errors = [];

        if(mb_strlen($username)<3)
            $errors[]= "имя пользователя слишком короткое, необходимо ввести более 2 символов.";
        if(mb_strlen($username)>25)
            $errors[]= "имя пользователя слишком длинное, необходимо ввести менее 26 символов.";
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            $errors[]= "некорректный адрес электронной почты, введите другое значение.";
        if(mb_strlen($password)<6)
            $errors[]="пароль учетной записи слишком короткий, необходимо ввести не менее 5 символов.";

        if(!empty($errors))
            return $errors;

        $pdo = Database::getConnection();

        $registerQuery=$pdo->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
        $registerQuery->execute(['username' => $username, 'email' => $email]);
        if ( $registerQuery->fetch(PDO::FETCH_ASSOC) )
            return ["Пользователь с такими данными уже существует"];


        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password)");
            $stmt->execute([
                'username' => $username,
                'email'    => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ]);
        }
        catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return ["Пользователь с такими данными уже существует!"];
            }
            else
            {
                throw $e;
                return ["непредвиденная ошибка."];
            }



        }

        $userId = (int) $pdo->lastInsertId();
        self::loginById($userId);

        return [];
    }

    public static function login( string $email, string $password):?string
    {
        $pdo = Database::getConnection();
        $login_query = $pdo->prepare("SELECT id,password_hash FROM users WHERE email = ?");
        $login_query->execute( [$email]);
        $user = $login_query->fetch();
        if(empty($user)||!password_verify($password, $user['password_hash'])){
            return  "Неверный пароль для указанного пользователя";
        }
        else {
            self::loginByID((int) $user['id']);
            return null;
        }

    }

    public static function logout():void
    {
        $_SESSION=[];
        session_destroy();
    }

    public static function user():?array
    {
        if(empty($_SESSION['user_id']))
            return null;
        $pdo = Database::getConnection();
        $strt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $strt->execute(['id' => $_SESSION['user_id']]);
        $user=$strt->fetch();

        return $user?:null;

    }

    public static function check():bool
    {
        return !empty($_SESSION['user_id']);
    }

    public static function loginById(int $userId):void
    {
        $_SESSION['user_id'] = $userId;
        session_regenerate_id(true);
    }


}