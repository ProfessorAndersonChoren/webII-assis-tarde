<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Desk Help - Lista de chamados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="m-5">
    <nav class=" bg-info d-flex justify-content-between p-3">
    <div>
        <a href="dashboard.php" class="text-white text-decoration-none">Dashboard</a>
        <a href="add-new-call.php" class="text-white text-decoration-none">Abrir chamado</a>
        <a href="../Controller/Call.php?operation=findAll" class="text-white text-decoration-none">Listar chamados</a>
    </div>
    <a href="../Controller/Auth.php?operation=logout" class="text-white text-decoration-none">Sair</a>
    </nav>
    <main class="d-flex justify-content-center mt-3">
        <table class="table table-primary mx-5">
            <thead>
                <th>#</th>
                <th>Nome do usuário</th>
                <th>Número de equipamento</th>
                <th>Descrição do chamado</th>
                <th>Observações</th>
            </thead>
            <tbody>
                <?php
                session_start();
                if (empty($_SESSION["list_of_calls"])) :
                ?>
                    <tr>
                        <td colspan="5">Não existem chamados cadastrados</td>
                    </tr>
                <?php
                endif;
                foreach ($_SESSION["list_of_calls"] as $call) :
                ?>
                    <tr>
                        <td>
                            <?= $call["id"] ?>
                        </td>
                        <td>
                            <?= $call["name"] ?>
                        </td>
                        <td>
                            <?= $call["equipment_id"] ?>
                        </td>
                        <td>
                            <?= $call["description"] ?>
                        </td>
                        <td>
                            <?= (!empty($call["notes"])) ? $call["notes"] : "Não existem observações" ?>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </main>
</body>

</html>