<?php

class LoginRequiredMiddleware extends BaseMiddleware {
    public function apply(BaseController $controller, array $context)
    {
        $query = $controller->pdo->prepare("SELECT username,password,id FROM users WHERE password = :my_password AND username = :my_username");

        $query->bindValue("my_username", isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '');
        $query->bindValue("my_password", isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '');
        $query->execute();
        $data = $query->fetch();

        if (!$data) {
            header('WWW-Authenticate: Basic realm="films-objects"');
            http_response_code(401); 
        }
    }
}