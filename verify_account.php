<?php

    $env = parse_ini_file('.env');
    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        $servername = "db";
        $username = $env['SQL_USER'];
        $password = $env['SQL_PASSWORD'];
        $verify_id = $_POST['id'];
        $message = "";
        if ($message == ""){
            try{
                $dbco = new PDO("mysql:host=$servername;dbname=db_camagru", $username, $password);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * from `users`";
                $stmt = $dbco->prepare($sql);
                $stmt->execute();
                $users = $stmt->fetchAll();
                var_dump($users);
                echo $users;
            }
            catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
            }
        }
        else{
            echo $message;
        }
}
?>