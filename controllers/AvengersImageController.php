<?php
require_once "AvengersController.php";

class AvengersImageController extends AvengersController {
    public $template = "image.twig";

    public function getContext() : array {
        $context = parent::getContext();
        $context['is_image'] = true;
        $context['image'] = "/images/avengers.jpeg";

        return $context;
    }
}