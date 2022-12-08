<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Modificar alumno </title>
</head>
<body>

    <?php
    session_start();

    require 'auxiliar.php';

    $id = obtener_get('id');

    if (!isset($id)) {
        return volver();
    }

    const PAR = [
        'nombre',
        'codigo',
    ];

    $par = obtener_parametros(PAR, $_POST);
    extract($par);

    $pdo = conectar();
    $error = [];

    if (comprobar_parametros($par)) {
        validar_nombre($nombre, $error);
        validar_codigo($codigo, $error);
        if (!hay_errores($error)) {
            modificar_alumnos($codigo, $nombre, $id, $pdo);
            return volver_alumnos();
        }

    }

    ?>


    <div>
        <form action="" method="post">
        <div>
            <p> Inserta nombre: </p>
        <input type="text" name="nombre" size="30" value="<?= $nombre ?>">
        <p> <?php mostrar_errores('nombre', $error) ?> </p>
    </div>
    <div>
            <p> Inserta codigo: </p>
        <input type="text" name="codigo" size="30" value="<?= $codigo ?>">
        <p> <?php mostrar_errores('codigo', $error) ?> </p>
    </div>
    </br>
        <input type="submit" value="Modificar">
    </div>

        
    

    
</body>
</html>