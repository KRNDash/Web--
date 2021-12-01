<?php
require_once "BaseFilmTwigController.php";

class SearchController extends BaseFilmTwigController {
    public $template = "search.twig"; 

    public function getContext(): array
    {
        $context = parent::getContext();

        $info = isset($_GET['info']) ? $_GET['info'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $type = '';

        if (isset($_GET['title'])) {
            if (($_GET['type']) == 'Все') {
                $type = '';
            } else {
                $type = isset($_GET['type']) ? $_GET['type'] : '';
            }
        }



        $sql = <<<EOL
SELECT id, title
FROM films_objects
WHERE (:title = '' OR title like CONCAT('%', :title, '%'))
    AND (:type = '' OR type = :type) AND (:info = '' OR info like CONCAT('%', :info, '%'))
EOL;
        
        $query = $this->pdo->prepare($sql);

        $query->bindValue("title", $title);
        $query->bindValue("info", $info);
        $query->bindValue("type", $type);
        $query->execute();

        $context['objects'] = $query->fetchAll();
        return $context;
    }
}