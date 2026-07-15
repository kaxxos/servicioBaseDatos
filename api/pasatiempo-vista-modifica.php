<?php

require_once __DIR__ . "/../libservidorphp/manejaErrores.php";
require_once __DIR__ . "/../libservidorphp/recibeEnteroObligatorio.php";
require_once __DIR__ . "/../libservidorphp/validaEntidadObligatoria.php";
require_once __DIR__ . "/../libservidorphp/devuelveJson.php";
require_once __DIR__ . "/Bd.php";

$id = recibeEnteroObligatorio("id");

$bd = Bd::conexion();

$stmt = $bd->prepare("SELECT * FROM CONSOLA WHERE CON_ID = :CON_ID");
$stmt->execute([":CON_ID" => $id]);
$modelo = $stmt->fetch(PDO::FETCH_ASSOC);


$modelo = validaEntidadObligatoria("Consola", $modelo);


devuelveJson([
 "id" => ["value" => $id],
 "nombre" => ["value" => $modelo["CON_NOMBRE"]],
 "compania" => ["value" => $modelo["CON_EMPRESA"]],
 "anio" => ["value" => $modelo["CON_ANIO"]],
]);