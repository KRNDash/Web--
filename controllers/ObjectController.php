<?php

class ObjectController extends TwigBaseController {
    public $template = "__object.twig"; // указываем шаблон

    public function getContext(): array
    {
        $context = parent::getContext();

        // добавил вывод params
        // echo "<pre>";
        // print_r($this->params);
        // echo "</pre>";

        // $query = $this->pdo->query("SELECT title, description, id FROM films_objects WHERE id=" . $this->params['id']);
        // создам запрос, под параметр создаем переменную my_id в запросе
        $query = $this->pdo->prepare("SELECT title, description, id FROM films_objects WHERE id= :my_id");
        // подвязываем значение в my_id
        $query->bindValue("my_id", $this->params['id']);
        $query->execute(); // выполняем запрос
        // стягиваем одну строчку из базы
        $data = $query->fetch();
        
        // передаем описание из БД в контекст
        $context['title'] = $data['title'];
        $context['description'] = $data['description'];

        return $context;
    }
}