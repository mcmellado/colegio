<?php

require '../comunes/auxiliar.php';

function validar_existe_codigo_alumno($codigo, &$error) : bool
{
    return validar_existe(
        'alumnos',
        'codigo',
        $codigo,
        'codigo',
        $error
    );
}

function validar_existe($tabla, $columna, $valor, $campo, &$error) : bool
{
    $pdo = conectar();
    $sent = $pdo->prepare("SELECT COUNT(*)
                            FROM $tabla
                            WHERE $columna = :$columna");
    
    $sent->execute([":$columna" => $valor]);
    $cuantos = $sent->fetchColumn();
    if ($cuantos !== 0) {
        insertar_error($campo, 'La fila ya existe', $error);
        return false;
    }
    return true;
}


function matricular_alumnos($nombre, $codigo, $pdo)
{
    $sent = $pdo->prepare("INSERT INTO alumnos (nombre, codigo)
                            VALUES(:nombre, :codigo)");

    $sent->execute([
        ':nombre' => $nombre,
        ':codigo' => $codigo
    ]);

}

function mismo_codigo($id, $codigo, $pdo)
{
    $sent = $pdo->prepare("SELECT COUNT(*)
                            FROM alumnos
                            WHERE id = :id AND codigo = :codigo");
    $sent->execute([':id' => $id, ':codigo' => $codigo]);
    $total = $sent->fetchColumn();
    if ($total == 0) {
        return false;
    }
    return true;
}

function validar_codigo_modificar($id, $codigo, $pdo, &$error)
{
    if(!mismo_codigo($id, $codigo, $pdo)){
        validar_digitos($codigo, 'codigo', $error);
        validar_longitud($codigo, 'codigo', 1, 3, $error);
        if (!isset($error['codigo'])) {
            validar_existe_codigo_alumno($codigo, $error);
        }
    }
}

function modificar_alumnos($codigo, $nombre, $id, $pdo)
{
    $sent = $pdo->prepare("UPDATE alumnos
                            SET codigo = :codigo,
                            nombre = :nombre
                            WHERE id = :id");

    $sent->execute([
        ':nombre' => $nombre,
        ':codigo' => $codigo,
        ':id' => $id
    ]);

}

function borrar_alumno($id, $pdo) {

    $pdo = conectar();
    $sent = $pdo->prepare("DELETE FROM alumnos WHERE id = :id");
    $sent->execute([':id' => $id]);
    volver_alumnos();
}

?>