<?php

require_once "conexion.php";

class ModeloProductos{

	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function mdlIngresarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idmodelo,cod_producto,idestado,estado_prestamo) VALUES (:idmodelo,:cod_producto,:idestado,:estado_prestamo)");

		$stmt->bindParam(":idmodelo", $datos["idmodelo"], PDO::PARAM_INT);
		$stmt->bindParam(":cod_producto", $datos["cod_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":idestado", $datos["idestado"], PDO::PARAM_INT);
		$stmt->bindParam(":estado_prestamo", $datos["estado_prestamo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProductos($tabla, $item, $valor,$orden){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  ORDER BY $orden DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	

		$stmt = null;

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function mdlEditarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idmodelo=:idmodelo,cod_producto=:cod_producto, idestado=:idestado,estado_prestamo=:estado_prestamo WHERE id=:id");

		$stmt -> bindParam(":idmodelo", $datos["idmodelo"], PDO::PARAM_INT);
		$stmt -> bindParam(":cod_producto", $datos["cod_producto"], PDO::PARAM_STR);
		$stmt -> bindParam(":idestado", $datos["idestado"], PDO::PARAM_INT);
		$stmt -> bindParam(":estado_prestamo", $datos["estado_prestamo"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}

	/*=============================================
	BORRAR MODELO	
	=============================================*/

	static public function mdlBorrarModelo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}
