<?php

    function send_email($email, $verify_code){
        $to = "camagru.yodana@gmail.com";
        var_dump($verify_code);
        $message = "Please, click <a href='http://localhost:8000/verify/" . $verify_code . "'> here </a> to confirm your account";
        $subject = "Welcome to Camagru!";
        $corps="<HTML><BODY><FONT FACE='Arial, Verdana' SIZE=2>";
        $corps.=$message."</BODY></HTML>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        mail($to, $subject, $corps, $headers);
    }

    function verify($password, $email, $name) {
        $env = parse_ini_file('.env');
        $servername = "db";
        $username = $env['SQL_USER'];
        $sqlpassword = $env['SQL_PASSWORD'];
        $message = "";
        $regex_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $regex_password = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[@$!%*?&])[A-Za-z0-9@$!%*?&]{12,}$/";
        if ($password == "" || $email == "" || $name == ""){
            $message = "You need to fill all the form.";
          }
        else if (!preg_match($regex_email, $email)){
            $message = "The email is invalid.";
          }
        else if (!preg_match($regex_password, $password)){
            $message = "The password is not strong enough.";
          }
        try{
            $dbco = new PDO("mysql:host=$servername;dbname=db_camagru", $username, $sqlpassword);
            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT COUNT(*) from users where users.username=:name";
            $stmt = $dbco->prepare($sql);
            $stmt->execute(['name' => $name]);
            $c = $stmt->fetchColumn();
            $sql = "SELECT COUNT(*) from users where users.email=:email";
            $stmt = $dbco->prepare($sql);
            $stmt->execute(['email' => $email]);
            $c = $stmt->fetchColumn() + $c;
            if ($c > 0){
                $message = "User or email aleready taken.";
            }
        }
        catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
        }
        return $message;
    }

    $env = parse_ini_file('.env');
    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        
        $servername = "db";
        $username = $env['SQL_USER'];
        $password = $env['SQL_PASSWORD'];
        $verify_code = base64_encode(password_hash($env['SALT'] . $username, PASSWORD_DEFAULT));
        $errors = [];
        $message = "";
        $email = htmlspecialchars($_POST['email']);
        $name = htmlspecialchars($_POST['username']);
        $user_password = $_POST['password'];
        $message = verify($user_password, $email, $name);
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if ($message == ""){
            try{
                $dbco = new PDO("mysql:host=$servername;dbname=db_camagru", $username, $password);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO users (username, email, password, verify, verify_code) VALUES (:name,:email,:password, 0, :verify_code)";
                $stmt = $dbco->prepare($sql);
                $stmt->execute(['name' => $name, 'email' => $email, 'password' => $user_password, 'verify_code' => $verify_code]);
                send_email($email, $verify_code);
                echo 'Veuillez confirmer votre compte dans votre boite mail!';
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