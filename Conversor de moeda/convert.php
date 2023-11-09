<?php
session_start();
if (!empty($_POST)) {
    $money = $_POST["money"];
    $coin = $_POST["coin"];

    switch ($coin) {
        case "dollar":
            $_SESSION["amount-dollar"] = convertToDollar($money);
            break;
        case "euro":
            $_SESSION["amount-euro"] = convertToEuro($money);
            break;
    }
} else {
    $_SESSION["error"] = "Ops. Houve um erro inesperado!!!";
}
header("location:message.php");

function convertToDollar($money)
{
    return $money / 5;
}

function convertToEuro($money)
{
    return $money / 5.29;
}
