<?php
require_once "ShoushenkaController.php";

class ShoushenkaImageController extends ShoushenkaController {
    public $template = "image.twig";

    public function getContext() : array {
        $context = parent::getContext();
        $context['is_image'] = true;
        $context['image'] = "/images/pobeg.jpg";

        return $context;
    }
}