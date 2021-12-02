<?php
require_once "BaseFilmTwigController.php";

class GenreObjectCreateController extends BaseFilmTwigController {
    public $template = "genre_create.twig";

    public function get(array $context)
    {
        // echo $_SERVER['REQUEST_METHOD'];
        
        parent::get($context);
    }

    public function post(array $context) {
        // получаем значения полей с формы
        $name = $_POST['name'];
        
        $tmp_name = $_FILES['image']['tmp_name'];
        $name_img =  $_FILES['image']['name'];

        move_uploaded_file($tmp_name, "../public/media/$name_img");
        $image_url = "/media/$name_img"; // формируем ссылку без адреса сервера

        $sql = <<<EOL
INSERT INTO genres(name, image)
VALUES(:name, :image_url) 
EOL;


        // подготавливаем запрос к БД
        $query = $this->pdo->prepare($sql);
        // привязываем параметры
        $query->bindValue("name", $name);
        $query->bindValue("image_url", $image_url);
        
        // выполняем запрос
        $query->execute();
        
        $context['message'] = 'Вы успешно создали жанр';
        $context['id'] = $this->pdo->lastInsertId(); // получаем id нового добавленного объекта

        $this->get($context);
    }
}
