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
                $sql = "UPDATE `users` SET verify=1 where verify_code = :valeur";
                $stmt = $dbco->prepare($sql);
                $stmt->execute(['valeur' => $verify_id]);
                $d = $stmt->rowCount();
                if ($d >= 1)
                    echo "Compte bien verifie";
                else
                    echo "Erreur";
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