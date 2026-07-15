<?php

class Bd
{
 private static ?PDO $pdo = null;

 static function conexion(): PDO
 {
  if (self::$pdo === null) {

   self::$pdo = new PDO(
    // cadena de conexión
    "sqlite:" . __DIR__ . "/srvbd.db",
    // usuario
    null,
    // contraseña
    null,
    // Opciones: pdos no persistentes y lanza excepciones.
    [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );

   self::$pdo->exec(
    "CREATE TABLE IF NOT EXISTS CONSOLA (
        CON_ID INTEGER,
        CON_NOMBRE TEXT NOT NULL,
        CON_EMPRESA TEXT NOT NULL,
        CON_ANIO INTEGER NOT NULL,
        CONSTRAINT PK_CON PRIMARY KEY(CON_ID),
        CONSTRAINT UQ_CON_NOM UNIQUE(CON_NOMBRE),
        CONSTRAINT CHK_CON_NOM CHECK(LENGTH(CON_NOMBRE) > 0),
        CONSTRAINT CHK_CON_ANIO CHECK(CON_ANIO > 1950)
    )"
);
  }

  return self::$pdo;
 }
}
