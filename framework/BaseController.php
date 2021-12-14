<?php

abstract class BaseController {

    public PDO $pdo; // добавил поле
    public array $params; // добавил поле
    
    // добавил сеттер
    public function setParams(array $params) {
        $this->params = $params;
    }

    public function setPDO(PDO $pdo) { // и сеттер для него
        $this->pdo = $pdo;
    }

    // новая функция
    public function process_response() {
        session_set_cookie_params(60*60*10);
        session_start();

        $history_list = $_SESSION['history_list'];
        if (!isset($history_list)) {
            $history_list = [];
        }
        array_push($history_list, $_SERVER['REQUEST_URI']);
        $_SESSION['history_list'] = array_slice($history_list, -10);
        

        $method = $_SERVER['REQUEST_METHOD'];
        $context = $this->getContext(); // вызываю context тут
        if ($method == 'GET') {
            $this->get($context); // а тут просто его пробрасываю внутрь
        } else if ($method == 'POST') {
            $this->post($context); // и здесь
        }
    }



    public function getContext(): array {
        return []; // по умолчанию пустой контекст
    }
    
    // с помощью функции get будет вызывать непосредственно рендеринг
    public function get(array $context) {}
    public function post(array $context) {}
}