<?php

require_once __DIR__ . "/../libservidorphp/manejaErrores.php";
require_once __DIR__ . "/../libservidorphp/recibeTextoObligatorio.php";
require_once __DIR__ . "/../libservidorphp/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";

$nombre = recibeTextoObligatorio("nombre");
$compania = recibeTextoObligatorio("compania"); 
$anio = recibeTextoObligatorio("anio");       

$bd = Bd::conexion();
$stmt = $bd->prepare(
 "INSERT INTO CONSOLA (
    CON_NOMBRE, 
    CON_EMPRESA, 
    CON_ANIO
   ) values (
    TRIM(:CON_NOMBRE),
    TRIM(:CON_EMPRESA),
    :CON_ANIO
   )"
);
$stmt->execute([
 ":CON_NOMBRE" => $nombre,
 ":CON_EMPRESA" => $compania,
 ":CON_ANIO" => $anio
]);
$id = $bd->lastInsertId();

$query = http_build_query(["id" => $id]);
devuelveCreated(
 "/api/pasatiempo-vista-modifica.php?$query",
 [
  "id" => ["value" => $id],
  "nombre" => ["value" => $nombre],
  "compania" => ["value" => $compania], 
  "anio" => ["value" => $anio],         
 ]
);