<?php
session_start();

require 'auxiliar.php';

$pdo = conectar();

$id = obtener_post('id');

if (!isset($id)) {
    return volver_alumnos();
}

borrar_alumno($id, $pdo);

