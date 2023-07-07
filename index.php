<?php
    session_start();
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    var_dump($url);
    $pattern_verify = '~^/verify/([0-9a-zA-Z]+)/?$~';
    if (preg_match($pattern_verify, $url)){
        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/verify.php';
    }
    else if ($url == "/"){
        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/homepage.php';
    }
    else if ($url == "/login"){
        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/homepage.php';
    }
    else if ($url == "/register"){
        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/register.php';
    }
    else if ($url == "/webcam"){
        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/webcam.php';
    }
    else{
        require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/404.php';
    }
?>