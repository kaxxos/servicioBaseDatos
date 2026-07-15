<?php

require_once __DIR__ . "/../libservidorphp/manejaErrores.php";
require_once __DIR__ . "/../libservidorphp/recibeEnteroObligatorio.php";
require_once __DIR__ . "/../libservidorphp/recibeTextoObligatorio.php";
require_once __DIR__ . "/../libservidorphp/devuelveJson.php";
require_once __DIR__ . "/Bd.php";

$id = recibeEnteroObligatorio("id");
$nombre = recibeTextoObligatorio("nombre");
$compania = recibeTextoObligatorio("compania"); 
$anio = recibeTextoObligatorio("anio");         

$bd = Bd::conexion();
$stmt = $bd->prepare(
 "UPDATE CONSOLA
   SET
    CON_NOMBRE = TRIM(:CON_NOMBRE),
    CON_EMPRESA = TRIM(:CON_EMPRESA),
    CON_ANIO = :CON_ANIO
   WHERE
    CON_ID = :CON_ID"
);
$stmt->execute([
 ":CON_NOMBRE" => $nombre,
 ":CON_EMPRESA" => $compania,
 ":CON_ANIO" => $anio,
 ":CON_ID" => $id,
]);

devuelveJson([
 "id" => ["value" => $id],
 "nombre" => ["value" => $nombre],
 "compania" => ["value" => $compania], 
 "anio" => ["value" => $anio],         
]);