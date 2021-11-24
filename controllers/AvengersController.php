<?php
// require_once "TwigBaseController.php"; // импортим TwigBaseController

class AvengersController extends TwigBaseController {
    public $template = "__object.twig";
    public $title = "Мстители";

    public function getContext() : array {
        $context = parent::getContext();
        $context['url'] = "/avengers";

        return $context;
    }
}