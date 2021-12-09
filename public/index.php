<?php

require_once "../framework/autoload.php";
require_once "../vendor/autoload.php";

require_once "../controllers/ObjectController.php";

require_once "../controllers/SearchController.php";
require_once "../controllers/FilmObjectCreateController.php";
require_once "../controllers/FilmObjectDeleteController.php";
require_once "../controllers/FilmObjectUpdateController.php";

require_once "../controllers/GenreObjectCreateController.php";

require_once "../controllers/MainController.php";
require_once "../controllers/BaseFilmTwigController.php";
require_once "../controllers/Controller404.php";

// $url = $_SERVER["REQUEST_URI"];
//2123W123


$loader = new \Twig\Loader\FilesystemLoader('../views');

$twig = new \Twig\Environment($loader, [
    "debug" => true
]);

$twig->addExtension(new \Twig\Extension\DebugExtension());



$pdo = new PDO("mysql:host=localhost;dbname=kinopoisk;charset=utf8", "root", "");

$router = new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/films-objects/(?P<id>\d+)", ObjectController::class); 

$router->add("/search", SearchController::class);

$router->add("/films-objects/delete", FilmObjectDeleteController::class);
$router->add("/films-objects/(?P<id>\d+)/edit", FilmObjectUpdateController::class);
$router->add("/films-objects/add", FilmObjectCreateController::class);
$router->add("/genre/add", GenreObjectCreateController::class);

$router->get_or_default(Controller404::class);


$title = "";
$template = "";
$image = "";
$text = "";
$id = "";


$context = [];
$controller = null;


// проверяем если controller не пустой, то рендерим страницу
if ($controller) {
    $controller->setPDO($pdo);
    $controller->get();
}