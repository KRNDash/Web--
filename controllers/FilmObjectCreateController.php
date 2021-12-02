<?php
require_once "BaseFilmTwigController.php";

class FilmObjectCreateController extends BaseFilmTwigController {
    public $template = "film_object_create.twig";

    public function get(array $context)
    {
        // echo $_SERVER['REQUEST_METHOD'];
        
        parent::get($context);
    }

    public function post(array $context) {
        // получаем значения полей с формы
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $info = $_POST['info'];
        
        $tmp_name = $_FILES['image']['tmp_name'];
        $name_img =  $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$name_img");
        $image_url = "/media/$name_img";

        $sql = <<<EOL
INSERT INTO films_objects(title, description, type, info, image)
VALUES(:title, :description, :type, :info, :image_url) 
EOL;


        // подготавливаем запрос к БД
        $query = $this->pdo->prepare($sql);
        // привязываем параметры
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->bindValue("image_url", $image_url);
        
        // выполняем запрос
        $query->execute();
        
        $context['message'] = 'Вы успешно создали объект';
        $context['id'] = $this->pdo->lastInsertId(); // получаем id нового добавленного объекта

        $this->get($context);
    }
}
