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

    public function getContext(): array {
        return []; // по умолчанию пустой контекст
    }
    
    // с помощью функции get будет вызывать непосредственно рендеринг
    abstract public function get();
}