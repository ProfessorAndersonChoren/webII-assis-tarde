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
    case "findAll":
        findAll();
        break;
    case "findOne":
        findOne();
        break;
    case "delete":
        delete();
        break;
    default:
        $_SESSION["msg_warning"] = "Operação inválida!!!";
        header("location:../View/message.php");
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
        $_POST["classification"]
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

function findAll()
{
    try {
        $call_repository = new CallRepository();
        $_SESSION["list_of_calls"] = $call_repository->findAll();
        header("location:../View/list-of-calls.php");
    } catch (Exception $exception) {
        $_SESSION["msg_error"] = "Ops, houve um erro inesperado em nosso banco de dados!!!";
        Log::write($exception->getMessage());
        header("location:../View/message.php");
    }
}

function findOne()
{
    $id = $_GET["code"];
    if(empty($id)){
        $_SESSION["msg_error"] = "O código do chamado é inválido!!!";
        header("location:../View/message.php");
        exit;
    }
    try{
        $call_repository = new CallRepository();
        $result = $call_repository->findOne($id);
        if(empty($result)){
            $_SESSION["msg_warning"] = "O chamado de código $id não foi encontrado em nossa base de dados!!!";
            header("location:../View/message.php");
        }else{
            $_SESSION["call"] = $result;
            header("location:../View/call-edit.php");
        }
    }catch(Exception $exception){
        $_SESSION["msg_error"] =
        "Ops, houve um erro inesperado em nosso banco de dados!!!";
        Log::write($exception->getMessage());
        header("location:../View/message.php");
    }
}

function delete()
{
    $id = $_GET["code"];
    if (empty($id)) {
        $_SESSION["msg_error"] = "O código do chamado é inválido!!!";
        header("location:../View/message.php");
        exit;
    }
    try {
        $call_repository = new CallRepository();
        $result = $call_repository->delete($id);
        if ($result) {
            $_SESSION["msg_success"] = "Chamado deletado com sucesso!!!";
        } else {
            $_SESSION["msg_warning"] = "Não foi possível deletar o chamado!!!";
        }
    } catch (Exception $exception) {
        $_SESSION["msg_error"] = "Ops, houve um erro inesperado em nosso banco de dados!!!";
        Log::write($exception->getMessage());
    } finally {
        header("location:../View/message.php");
    }
}
