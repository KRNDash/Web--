<?php

class ObjectController extends TwigBaseController {
    public $template = "__object.twig"; // указываем шаблон

    public function getContext(): array
    {
        $context = parent::getContext();

        $query = $this->pdo->prepare("SELECT info, image, title, description, id FROM films_objects WHERE id= :my_id");
        // подвязываем значение в my_id
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();
        $data = $query->fetch();
        
        // передаем описание из БД в контекст
        $context['id'] = $data['id'];
        $context['title'] = $data['title'];
        $context['description'] = $data['description'];
        $context['info'] = $data['info'];
        $context['image'] = $data['image'];

        return $context;
    }
}