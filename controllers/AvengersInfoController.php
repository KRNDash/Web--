<?php
require_once "AvengersController.php";

class AvengersInfoController extends AvengersController {
    public $template = "info.twig";

    public function getContext() : array {
        $context = parent::getContext();
        $context['is_info'] = true;
        $context['text'] = "Локи, сводный брат Тора, возвращается, и в этот раз он не один. Земля оказывается на грани порабощения, и только лучшие из лучших могут спасти человечество. Глава международной организации Щ.И.Т. Ник Фьюри собирает выдающихся поборников справедливости и добра, чтобы отразить атаку. Под предводительством Капитана Америки Железный Человек, Тор, Невероятный Халк, Соколиный Глаз и Чёрная Вдова вступают в войну с захватчиком.";
        
        return $context;
    }
}