<?php
if ($_SERVER['REQUEST_METHOD'] === "POST"){
        $servername = "db";
        $username = $env['SQL_USER'];
        $password = $env['SQL_PASSWORD'];
        $img = $_POST['img'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $data = base64_decode($img);
        file_put_contents("img/test.png",  $data);
    }