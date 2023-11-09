<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagem do sistema</title>
</head>

<body>
    <main>
        <h1>Mensagem do sistema</h1>
        <?php
        session_start();
        if (!empty($_SESSION["error"])) :
        ?>
            <p>
                <?= $_SESSION["error"]; ?>
            </p>
        <?php
            unset($_SESSION["error"]);
        endif;
        ?>
    </main>
</body>

</html>