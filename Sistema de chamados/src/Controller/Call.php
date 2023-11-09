<?php

namespace QI\SistemaDeChamados\Controller;

use QI\SistemaDeChamados\Model\Call;

require_once dirname(dirname(__DIR__)) . "/vendor/autoload.php";

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
    $call = new Call();
    // TODO Validar os dados recebidos
}
