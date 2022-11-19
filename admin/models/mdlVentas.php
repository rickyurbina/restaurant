<?php

require_once "conexion.php";

class VentasModel {
  public static function mdlAgregarVenta($datosVenta) {
    $statement = Conexion::conectar() -> prepare("INSERT INTO ventas VALUES (null, :idCliente, :productos, :total, now());");

    $statement -> bindParam(":idCliente", $datosVenta['idCliente'], PDO::PARAM_INT);
    $statement -> bindParam(":productos", $datosVenta['productos'], PDO::PARAM_STR);
    $statement -> bindParam(":total", $datosVenta['total'], PDO::PARAM_STR);

    if ($statement -> execute()) {
      return "success";
    } else {
      return "error";
    }
  }

  public static function mdlListarVentas() {
    $statement = Conexion::conectar() -> prepare("SELECT * FROM ventas ORDER BY idVenta DESC;");

    $statement -> execute();

    return $statement -> fetchAll();
  }
}
