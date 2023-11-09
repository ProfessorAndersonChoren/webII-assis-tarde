<?php
session_start();

switch ($_GET["operation"]) {
    case "login":
        login();
        break;
    case "logout":
        logout();
        break;
    default:
        $_SESSION["msg_warning"] = "Operação inválida!!!";
        header("location:../View/message.php");
        exit;
}

function logout()
{
    unset($_SESSION["user_data"]);
    header("location:../../index.html");
    exit;
}

function login()
{
    if (empty($_POST)) {
        $_SESSION["msg_error"] = "Ops, houve um erro inesperado!!!";
        header("location:../View/message.php");
        exit;
    }

    $users = array(
        array(
            "name" => "Maria",
            "email" => "maria@gmail.com",
            "password" => password_hash("12345678", PASSWORD_DEFAULT),
        ),
        array(
            "name" => "João",
            "email" => "joao@gmail.com",
            "password" => password_hash("12345678", PASSWORD_DEFAULT),
        )
    );

    $email = $_POST["user_email"];
    $password = $_POST["user_password"];

    foreach ($users as $user) {
        if ($email == $user["email"] && password_verify($password, $user["password"])) {
            $_SESSION["user_data"] = $user;
            header("location:../View/dashboard.php");
            exit;
        }
    }

    $_SESSION["msg_warning"] = "Usuário ou senha inválidos!!!";
    header("location:../View/message.php");
    exit;
}
