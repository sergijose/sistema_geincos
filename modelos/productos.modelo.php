<?php

require_once "conexion.php";

class ModeloProductos{

	/*=============================================
	CREAR MODELO
	=============================================*/

	static public function mdlIngresarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idcategoria,idmarca,descripcion,imagen) VALUES (:idcategoria,:idmarca,:descripcion,:imagen)");

		$stmt->bindParam(":idcategoria", $datos["idcategoria"], PDO::PARAM_INT);
		$stmt->bindParam(":idmarca", $datos["idmarca"], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);

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
	EDITAR MODELO
	=============================================*/

	static public function mdlEditarModelo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idcategoria=:idcategoria, idmarca=:idmarca, descripcion=:descripcion, imagen=:imagen WHERE id=:id");

		$stmt -> bindParam(":idcategoria", $datos["idcategoria"], PDO::PARAM_INT);
		$stmt -> bindParam(":idmarca", $datos["idmarca"], PDO::PARAM_INT);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
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

