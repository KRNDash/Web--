<?php
require_once "BaseController.php"; // обязательно импортим BaseController


class TwigBaseController extends BaseController {
    public $title = ""; // название страницы
    public $template = ""; // шаблон страницы
    protected \Twig\Environment $twig; // ссылка на экземпляр twig, для рендернига

    public function setTwig($twig) {
        $this->twig = $twig;
    }

    // переопределяем функцию контекста
    public function getContext() : array
    {
        
        $context = parent::getContext(); // вызываем родительский метод
        $context['title'] = $this->title; // добавляем title в контекст
        $context["history_list"] = isset($_SESSION['history_list']) ? $_SESSION['history_list'] : "";
        $context['history_list'] = array_reverse($_SESSION['history_list']);
        return $context;
    }
    
    public function get(array $context) { // добавил аргумент в get
        echo $this->twig->render($this->template, $context); // а тут поменяем getContext на просто $context
    }

    public function getTemplate() {
        return $this->template;
    }
}