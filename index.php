<?php
    session_start();
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if ($url == "/"){
        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/homepage.php';
    }
    else if ($url == "/login"){
        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/homepage.php';
    }
    else{
        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/404.php';
    }
?>