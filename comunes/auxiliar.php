<?php



function conectar()
{
    return new PDO('pgsql:host=localhost;dbname=colegio', 'colegio', 'colegio');

}

function cabecera()
{ ?>
    <nav style="margin: 4px; padding: 4px; text-align: left; border: 1px solid;">
        <a href="/alumnos/">Alumnos</a>
    </nav><?php
}

function pie()
{
    if (isset($_COOKIE['acepta_cookies'])) {
        return;
    } ?>
    <form action="/comunes/cookies.php" method="get" style="border: 1px solid; margin-top: 1em; padding: 0.5ex 1.5ex">
        <p align="right">
            Este sitio usa cookies.
            <button type="submit">Aceptar</button>
        </p>
    </form><?php
}

function obtener_parametro($par, $array) 
{
    return isset($array[$par]) ? trim($array[$par]) : null;

}

function obtener_post($par)
{
    return obtener_parametro($par, $_POST);
}

function obtener_get($par)
{
    return obtener_parametro($par, $_GET);
}

function obtener_parametros(array $par, array $array): array
{
    $res = [];

    foreach ($par as $p) {
        $res[$p] = obtener_parametro($p, $array);
    }

    return $res;
}

function insertar_error($campo, $mensaje, &$error)

{
    if (!isset($error[$campo])) {
        $error[$campo] = [];
    }

    $error[$campo][] = $mensaje;
}

function mostrar_errores($campo, $error) 
{
    if (isset($error[$campo])) {
        foreach($error[$campo] as $mensaje)  { ?>
        <ul> 
             <li> <?= $mensaje ?> </li>
        </ul><?php
        }
    }
}

function validar_digitos($codigo, $campo, &$error)
{
    if (!is_numeric($codigo)) {
        insertar_error(
            $campo,
            'El campo no tiene un valor numérico válido',
            $error
        );
    }
}


function validar_codigo($codigo, &$error)
{
    validar_digitos($codigo, 'codigo', $error);
    validar_longitud($codigo, 'codigo', 1, 3, $error);
    if (!isset($error['codigo'])) {
        validar_existe_codigo_alumno($codigo, $error);
    }


}


function validar_longitud($cadena, $campo, $min, $max, &$error)
{
    $long = mb_strlen($cadena);

    if ($long < $min || $long > $max ) {
        insertar_error(
            $campo,
            'La longitud del campo es incorrecta',
            $error
        );
    }
}

function validar_nombre($nombre, &$error) {
    validar_longitud($nombre, 'nombre', 1, 255, $error);
}


function hay_errores($error)
{
    return !empty($error);
}


function comprobar_parametros(array $par): bool

{
    foreach ($par as $v) {
        if($v === null) {
            return false;
        }
    }

    return true;
}

function volver() {
    header("Location: /index.php");
}

function hh($x)
{
    return htmlspecialchars($x ?? '', ENT_QUOTES | ENT_SUBSTITUTE);
}

function volver_alumnos() {
    header("Location: index.php");
}

?>