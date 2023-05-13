<?php
    function verify($password, $email, $name) {
        $message = "";
        $regex_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $regex_password = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";
        if ($password == "" || $email == "" || $name == ""){
            $message = "You need to fill all the form.";
          }
        else if (!preg_match($regex_email, $email)){
            $message = "The email is invalid.";
          }
        else if (!preg_match($regex_password, $password)){
            $message = "The password is not strong enough.";
          }
        return $message;
    }

    $env = parse_ini_file('.env');
    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        
        $servername = "db";
        $username = $env['SQL_USER'];
        $password = $env['SQL_PASSWORD'];
        $_SESSION['errors'] = 'lol ca marche';
        $errors = [];
        $user_password = htmlspecialchars($_POST['password']);
        $email = htmlspecialchars($_POST['email']);
        $name = htmlspecialchars($_POST['username']);
        $user_password = password_hash($user_password, PASSWORD_DEFAULT);
        $message = verify($user_password, $email, $name);
        if ($message == ""){
            try{
                $dbco = new PDO("mysql:host=$servername;dbname=db_camagru", $username, $password);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO users (username, email, password, verify) VALUES (:name,:email,:password, 0)";
                $stmt = $dbco->prepare($sql);
                $stmt->execute(['name' => $name, 'email' => $email, 'password' => $user_password]);
                echo '<div> Base de données créée bien créée !</div>';
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