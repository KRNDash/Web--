<?php
require_once "TwigBaseController.php"; // импортим TwigBaseController

class ShoushenkaController extends TwigBaseController {
    public $template = "__object.twig";
    public $title = "Побег из Шоушенка";

    public function getContext() : array {
        $context = parent::getContext();
        $context['url'] = "/shoushenka";

        return $context;
    }
}