<?php
require_once "ShoushenkaController.php";

class ShoushenkaInfoController extends ShoushenkaController {
    public $template = "info.twig";

    public function getContext() : array {
        $context = parent::getContext();
        $context['is_image'] = false;
        $context['text'] = "Бухгалтер Энди Дюфрейн обвинён в убийстве собственной жены и её любовника. Оказавшись в тюрьме под названием Шоушенк, он сталкивается с жестокостью и беззаконием, царящими по обе стороны решётки. Каждый, кто попадает в эти стены, становится их рабом до конца жизни. Но Энди, обладающий живым умом и доброй душой, находит подход как к заключённым, так и к охранникам, добиваясь их особого к себе расположения.";

        return $context;
    }
}