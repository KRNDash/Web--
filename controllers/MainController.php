<?php
require_once "BaseFilmTwigController.php"; // импортим TwigBaseController

class MainController extends BaseFilmTwigController {
    public $template = "main.twig";
    public $title = "Главная";

    public function getContext(): array
    {
        $context = parent::getContext();
        
        if (isset($_GET['type'])) {
            $query = $this->pdo->prepare("SELECT * FROM films_objects WHERE type= :type");
            $query->bindValue("type", $_GET['type']);
            $query->execute();

        } else {
            $query = $this->pdo->query("SELECT * FROM films_objects");
        }

        $context['films_objects'] = $query->fetchAll();

        return $context;
    }
}