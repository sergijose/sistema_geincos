<?php

require_once "conexion.php";

class ModeloPedidos
{

  /*======================================= 
  MOSTRAR VENTAS 
  =============================================*/
  // static public function mdlMostrarVentas($tabla, $item, $valor, $idUsuario)
  // {
  //   if ($item != null) {
  //     $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $idUsuario = :$idUsuario $item = :$item ORDER BY id ASC");
  //     $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
  //     $stmt->bindParam(":" . $idUsuario, $idUsuario, PDO::PARAM_INT);
  //     $stmt->execute();
  //     return $stmt->fetch();
  //   } else {
  //     $stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM $tabla");
  //     $stmt->execute();
  //     return $stmt->fetchAll();
  //   }
  //   // $stmt -> close();
  //   $stmt = null;
  // }
/*======================================= 
MOSTRAR VENTAS CON FILTRO DE VENDEDOR 
=============================================*/
  static public function mdlMostrarPedido($tabla, $item, $valor)
  {

    if ($item != null) {

      // Aquí se compara con el valor que viene dinamico que vendria siendo id_vendedor
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");
      // Aquí se pasa el parametro con los valores...
      $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
      // Esto no sirve acá
      // $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
      $stmt->execute();

      return $stmt->fetchAll();
    } else {

      $stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(fecha_registro, '%d/%m/%Y') AS fecha_registro FROM $tabla");
      $stmt->execute();
      return $stmt->fetchAll();
    }

    // $stmt -> close();
    $stmt = null;
  }


  /*=============================================
	REGISTRO DE PEDIDO
	=============================================*/
  static public function mdlIngresarPedido($tabla, $datos)
  {

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo,id_usuario,id_empleado,productos,area_solicitante,descripcion) VALUES (:codigo,:id_usuario, :id_empleado,:productos,:area_solicitante, :descripcion)");

    $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
    $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
    $stmt->bindParam(":id_empleado", $datos["id_empleado"], PDO::PARAM_INT);
    $stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
    $stmt->bindParam(":area_solicitante", $datos["area_solicitante"], PDO::PARAM_STR);
    $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
    if ($stmt->execute()) {

      return "ok";
    } else {

      return "error";
    }

    // $stmt->close();
    $stmt = null;
  }

  /*=============================================
  EDITAR VENTA
  =============================================
  static public function mdlEditarPedido($tabla, $datos)
  {

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  id_usuario = :id_usuario, id_empleado = :id_empleado,destino=:destino,productos = :productos,descripcion = :descripcion WHERE id = :id");
    $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
    $stmt->bindParam(":id_empleado", $datos["id_empleado"], PDO::PARAM_INT);
    $stmt->bindParam(":destino", $datos["destino"], PDO::PARAM_STR);
    $stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);   
    $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
    $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

    if ($stmt->execute()) {
      return "ok";
    } else {
      return "error";
    }

    // $stmt->close();
    $stmt = null;
  }
  */
  /*=============================================
  ELIMINAR VENTA
  =============================================*/
  static public function mdlEliminarPedido($tabla, $datos)
  {

    $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
    $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

    if ($stmt->execute()) {

      return "ok";
    } else {

      return "error";
    }
    // $stmt -> close();
    $stmt = null;
  }
  /*================================ 
  RANGO FECHAS 
  =============================================*/
  static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal)
  {

    if ($fechaInicial == null) {
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");
      $stmt->execute();
      return $stmt->fetchAll();
    } else if ($fechaInicial == $fechaFinal) {

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");
      $stmt->bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetchAll();
    } else {

      $fechaActual = new DateTime();
      $fechaActual->add(new DateInterval("P1D"));
      $fechaActualMasUno = $fechaActual->format("Y-m-d");

      $fechaFinal2 = new DateTime($fechaFinal);
      $fechaFinal2->add(new DateInterval("P1D"));
      $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

      if ($fechaFinalMasUno == $fechaActualMasUno) {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
      } else {


        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");
      }

      // $stmt -> execute();
      return $stmt->fetchAll();
    }
  }
  /*=============================================
  SUMAR EL TOTAL DE VENTAS
  =============================================*/
  static public function mdlSumaTotalVentas($tabla)
  {

    $stmt = Conexion::conectar()->prepare("SELECT SUM(neto) as total FROM $tabla");
    $stmt->execute();
    return $stmt->fetch();

    // $stmt -> close();
    $stmt = null;
  }

  static public function mdlSumaTotalVentasXdia($tabla, $fechaInicial, $fechaFinal)
  {

    $stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla WHERE fecha BETWEEN :fechaInicial AND :fechaFinal");
    $stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
    $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);

    $stmt->execute();

    return $stmt->fetch();
    

    // $stmt -> close();
    $stmt = null;
  }
}
