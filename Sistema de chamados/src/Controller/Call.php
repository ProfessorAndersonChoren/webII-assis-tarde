<?php

namespace QI\SistemaDeChamados\Controller;

use QI\SistemaDeChamados\Model\Call;
use QI\SistemaDeChamados\Model\User;
use QI\SistemaDeChamados\Model\Equipment;

use \DateTime;

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
    $user = new User($_POST["user_email"]);
    $equipment = new Equipment(
        $_POST["pc_number"],
        $_POST["floor"],
        $_POST["room"],
    );
    $call = new Call(
        new DateTime("now"),
        $user,
        $equipment,
        $_POST["description"],
    );
    // TODO Validar os dados recebidos
}
