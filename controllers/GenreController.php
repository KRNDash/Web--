<?php
require_once "BaseFilmTwigController.php"; // импортим TwigBaseController

class GenreController extends BaseFilmTwigController {
    public $template = "main.twig";
    public $title = "Жанры";

    public function getContext(): array
    {
        $context = parent::getContext();
        
        if (isset($_GET['type'])) {
            $query = $this->pdo->prepare("SELECT * FROM genres WHERE type= :type");
            $query->bindValue("type", $_GET['type']);
            $query->execute();

        } else {
            $query = $this->pdo->query("SELECT * FROM films_objects");
        }

        $context['films_objects'] = $query->fetchAll();

        return $context;
    }
}