<?php

require_once "conexion.php";

class ModeloModelos{

	/*=============================================
	CREAR MARCA
	=============================================*/

	static public function mdlIngresarModelo($tabla, $datos){

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

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR MODELOS
	=============================================*/

	static public function mdlMostrarModelos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT mo.id,cat.descripcion AS categoria,mar.descripcion AS marca,mo.descripcion,mo.imagen FROM $tabla mo
			INNER JOIN categoria cat
			ON mo.idcategoria=cat.id
			INNER JOIN marca mar
			ON mar.id=mo.idmarca");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	

		$stmt = null;

	}

	/*=============================================
	EDITAR MODELO
	=============================================*/

	static public function mdlEditarModelo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idcategoria=:idcategoria,idmarca=:idmarca,descripcion=:descripcion,imagen=:imagen WHERE id = :id");

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


		$stmt = null;

	}

	/*=============================================
	BORRAR MARCA	
	=============================================*/
/*
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
*/
}

