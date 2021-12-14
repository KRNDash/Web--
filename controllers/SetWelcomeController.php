<?php

class SetWelcomeController extends BaseController {
    public function get(array $context) {
        $_SESSION['welcome_message'] = $_GET['message'];

        if (!isset($_SESSION['message'])) {
            $_SESSION['message'] = [];
        }
        
        array_push($_SESSION['message'], $_GET['message']);
        
        $url = $_SERVER['HTTP_REFERER'];
        header("Location: $url");
        exit;
    }
}