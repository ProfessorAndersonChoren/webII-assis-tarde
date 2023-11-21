<?php

namespace QI\SistemaDeChamados\Controller;

use QI\SistemaDeChamados\Model\Call;
use QI\SistemaDeChamados\Model\User;
use QI\SistemaDeChamados\Model\Equipment;
use QI\SistemaDeChamados\Model\Repository\CallRepository;

use \DateTime;
use \Exception;

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

function insert()
{
    if (empty($_POST)) {
        $_SESSION["msg_error"] = "Ops, houve um erro inesperado!!!";
        header("location:../View/message.php");
        exit;
    }
    $user = new User($_POST["user_email"]);
    $user->id = 1;
    $user->name = $_POST["user_name"]; // Setter

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
    if (!empty($_POST["notes"])) {
        $call->notes = $_POST["notes"]; // Setter
    }
    // TODO Validar os dados recebidos
    try {
        $call_repository = new CallRepository();
        $result = $call_repository->insert($call);
        if ($result) {
            $_SESSION["msg_success"] = "Chamado registrado com sucesso!!!";
        } else {
            $_SESSION["msg_warning"] = "Não foi possível registrar o chamado!!!";
        }
    } catch (Exception $e) {
        $_SESSION["msg_error"] = "Ops. Houve um erro em nossa base de dados. Tente novamente!!!";
        Log::write($e->getMessage());
    } finally {
        header("location:../View/message.php");
        exit;
    }
}
