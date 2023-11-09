<?php
session_start();

switch ($_GET["operation"]) {
    case "insert":
        insert();
        break;
    default:
        $_SESSION["msg_warning"] = "Operação inválida!!!";
        header("../View/message.php");
        exit;
}

function insert(){
    if(empty($_POST)){
        $_SESSION["msg_error"] = "Ops, houve um erro inesperado!!!";
        header("location:../View/message.php");
        exit;
    }
    // TODO Criar o objeto Call
    // TODO Validar os dados recebidos
}
