<?php
require_once "BaseFilmTwigController.php";

class FilmObjectUpdateController extends BaseFilmTwigController {
    public $template = "film_object_update.twig";

    public function get(array $context)
    {
        $id = $this->params['id'];

        $sql = <<<EOL
SELECT * FROM films_objects WHERE id=:id
EOL;

        // подготавливаем запрос к БД
        $query = $this->pdo->prepare($sql);
        // привязываем параметры
        $query->bindValue("id", $id);
        // выполняем запрос
        $query->execute();

        $data = $query->fetch();

        $context['object'] = $data;

        parent::get($context);
    }

    public function post(array $context) {
        // получаем значения полей с формы
        $id = $this->params['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $info = $_POST['info'];
        
        $tmp_name = $_FILES['image']['tmp_name'];
        $name_img =  $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$name_img");
        $image_url = "/media/$name_img";

        $sql = <<<EOL
UPDATE films_objects
SET title = :title, description= :description, type = :type, info = :info, image = :image_url
WHERE id = :id
EOL;


        // подготавливаем запрос к БД
        $query = $this->pdo->prepare($sql);
        // привязываем параметры
        $query->bindValue("id", $id);
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->bindValue("image_url", $image_url);
        
        // выполняем запрос
        $query->execute();
        
        $context['message'] = 'Вы успешно обновили объект';
        $context['id'] = $id; // получаем id нового добавленного объекта

        $this->get($context);
    }
}
