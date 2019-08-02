<?php

require_once __DIR__."/../includes/connect.inc.php";

if (isset($_POST['inscription']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($username))
    {
        $error[] = "Entrer un nom d'utilisateur";
    }
    else if (empty($email))
    {
        $error[] = "Entrer une adresse email";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $error[] = "Entrer une adresse email valide";
    }
    else if (empty($password))
    {
        $error[] = "Entrer un mot de passe";
    }
    else if (strlen($password) < 6)
    {
        $error[] = "Le mot de passe doit être composé de minimum 6 caractères";
    }
    else
    {
        try
        {
            $request = $db->prepare("SELECT username, email FROM users 
                                        WHERE username=:uname OR email=:uemail");

            $request->execute(array(
                ':uname' => $username,
                ':uemail' => $email
            ));
            $row = $request->fetch(PDO::FETCH_ASSOC);

            if ($row["username"] == $username)
            {
                $error[] = "Désolé, ce pseudo est déjà utilisé";
            }
            else if ($row["email"] == $email)
            {
                $error[] = "Désolé cette adresse email est déjà utilisé";
            }
            else if (!isset($error))
            {
                $new_password = password_hash($password, PASSWORD_DEFAULT);

                $request = $db->prepare("INSERT INTO users (username,email,password) VALUES
                                                                (:uname,:uemail,:upassword)");

                if ($request->execute(array(
                    ':uname' => $username,
                    ':uemail' => $email,
                    ':upassword' => $new_password
                )))
                {

                    $success = "Inscription réussie";
                    header("refresh:2; index.php");
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}

?>
