<?php

require_once "../vendor/autoload.php";
require_once "../controllers/MainController.php"; // добавим в самом верху ссылку на наш контроллер
require_once "../controllers/AvengersController.php"; 
require_once "../controllers/ShoushenkaController.php"; 
require_once "../controllers/AvengersImageController.php"; 
require_once "../controllers/ShoushenkaImageController.php"; 
require_once "../controllers/AvengersInfoController.php"; 
require_once "../controllers/ShoushenkaInfoController.php"; 


// создаем экземпляр класса и передаем в него параметры подключения
// создание класса автоматом открывает соединение
$pdo = new PDO("mysql:host=localhost;dbname=kinopoisk;charset=utf8", "root", "");


$url = $_SERVER["REQUEST_URI"];


$loader = new \Twig\Loader\FilesystemLoader('../views');

// создаем собственно экземпляр Twig с помощью которого будет рендерить
$twig = new \Twig\Environment($loader, [
    "debug" => true
]);

$twig->addExtension(new \Twig\Extension\DebugExtension());

// добавил две переменные
$title = "";
$template = "";
$image = "";
$text = "";


$context = [];
$controller = null; // создаем переменную под контроллер




// тут теперь просто заполняю значение переменных
if ($url == "/") {
    $controller = new MainController($twig);
} elseif (preg_match("#^/avengers#", $url)) {
    $controller = new AvengersController($twig);

    if (preg_match("#^/avengers/images#", $url)) {
        $controller = new AvengersImageController($twig);

    } elseif (preg_match("#^/avengers/info#", $url)) {
        $controller = new AvengersInfoController($twig);
    }

} elseif (preg_match("#^/shoushenka#", $url)) {
    $controller = new ShoushenkaController($twig);

    if (preg_match("#^/shoushenka/images#", $url)) {
        $controller = new ShoushenkaImageController($twig);

    } elseif (preg_match("#^/shoushenka/info#", $url)) {
        $controller = new ShoushenkaInfoController($twig);
        
    }
}


// проверяем если controller не пустой, то рендерим страницу
if ($controller) {
    $controller->setPDO($pdo);
    $controller->get();
}