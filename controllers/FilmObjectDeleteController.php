<?php

// в кой то веки наследуемся не от TwigBaseController а от BaseController
class FilmObjectDeleteController extends BaseController {
    public function post(array $context)
    {
        $query = $controller->pdo->prepare("SELECT username,password,id FROM users WHERE password= :my_password AND username= :my_username");

        $query->bindValue("my_username", isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '');
        $query->bindValue("my_password", isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '');
        $query->execute();
        $data = $query->fetch();

        //сверяем с корректными данными из базы
        if (!$data) {
        // если не совпали, надо указать такой заголовок
        // именно по нему браузер поймет что надо показать окно для ввода юзера/пароля
        header('WWW-Authenticate: Basic realm="space-objects"');
        http_response_code(401); // ну и статус 401 — Unauthorized, то есть неавторизован
        exit; // прерываем выполнение скрипта
        }

    }
}