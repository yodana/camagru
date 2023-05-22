<?php
    session_start();
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (isset($_GET['url']))
        $url_id = explode("/", $_GET['url']);
    if ($url == "/"){
        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/homepage.php';
    }
    else if ($url == "/login"){
        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/homepage.php';
    }
    else if ($url == "/verify"){
        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/verify.php'; // probleme sur le routeur
    }
    else{
        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/404.php';
    }
?>