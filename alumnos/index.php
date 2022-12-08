<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Portal </title>
</head>
<body>
    <?php
    session_start();
    require 'auxiliar.php';


    ?>

    <?php

    $pdo = conectar();
    $pdo->beginTransaction();
    $pdo->exec("LOCK TABLE alumnos IN SHARE MODE");
    $where = [];
    $execute = [];
    $sent = $pdo-> prepare("SELECT COUNT(*) FROM alumnos");

    $sent->execute($execute);
    $total = $sent->fetchColumn();


    $sent = $pdo->prepare("SELECT * FROM alumnos");
    $sent->execute($execute);
    $pdo->commit();


    ?>


    <br>
    <div>
        <table style="margin: auto" border="1">
            <thead>
                <th> Código alumno </th>
                <th> Nombre alumno </th>
                <th colspan="2"> Acciones </th> 
            </thead>
            <tbody>
                <?php foreach ($sent as $fila): ?>
                    <tr>
                        <td> <?= hh($fila['codigo']) ?> </td>
                        <td> <?= hh($fila['nombre']) ?> </td>
                        <td> <a href="modificar.php?id=<?= hh($fila['id']) ?>" </a> Modificar </td>
                        <td> <a href="confirmar_borrado.php?id=<?= hh($fila['id']) ?>" </a> Borrar </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <p> Número total de alumnos: <?= hh($total) ?> </p>
        <a href="matricular.php"> Matricular un nuevo alumno</a> </br>
        </div>

</body>
</html>