<?php

require_once "conexion.php";

class ModeloPrestamos{

	/*=============================================
	MOSTRAR PRESTAMO
	=============================================*/

	static public function mdlMostrarPrestamos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha_prestamo DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
	
		$stmt = null;

	}

	/*=============================================
	MOSTRAR PRESTAMO PENDIENTES POR EMPLEADO
	=============================================*/

	static public function mdlMostrarPrestamosPendiente($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item ORDER BY idempleado ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
	
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE PRESTAMO
	=============================================*/

	static public function mdlIngresarPrestamo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idusuario,idproducto,idempleado,observacion_prestamo,estado_prestamo) VALUES (:idusuario,:idproducto,:idempleado,:observacion_prestamo,:estado_prestamo)");

		$stmt->bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_INT);
		$stmt->bindParam(":idproducto", $datos["idproducto"], PDO::PARAM_STR);
		$stmt->bindParam(":idempleado", $datos["idempleado"], PDO::PARAM_INT);
		$stmt->bindParam(":observacion_prestamo", $datos["observacion_prestamo"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_prestamo", $datos["estado_prestamo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}

	/*=============================================
	EDITAR PRESTAMO
	=============================================*/

	static public function mdlDevolverProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha_devolucion=:fecha_devolucion,observacion_devolucion =:observacion_devolucion,estado_prestamo=:estado_prestamo WHERE id = :id");

		$stmt->bindParam(":fecha_devolucion", $datos["fecha_devolucion"], PDO::PARAM_STR);
		$stmt->bindParam(":observacion_devolucion", $datos["observacion_devolucion"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_prestamo", $datos["estado_prestamo"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}

	/*=============================================
	ELIMINAR PRESTAMO
	=============================================*/

	static public function mdlEliminarPrestamos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt = null;

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasPrestamos($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_prestamo like '%$fechaFinal%'");

			$stmt -> bindParam(":fecha_prestamo", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_prestamo BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_prestamo BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	
	

	
}