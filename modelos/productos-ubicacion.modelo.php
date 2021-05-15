<?php

require_once "conexion.php";

class ModeloProductoUbicacion{

	/*=============================================
	CREAR UBICACION DE PRODUCTOS
	=============================================*/

	static public function mdlIngresarProductoUbicacion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_producto,id_ubicacion,posicion,creado_por) VALUES (:id_producto,:id_ubicacion,:posicion,:creado_por)");

		$stmt->bindParam(":id_producto",$datos["id_producto"],PDO::PARAM_INT);
		$stmt->bindParam(":id_ubicacion", $datos["id_ubicacion"], PDO::PARAM_INT);
		$stmt->bindParam(":posicion", $datos["posicion"], PDO::PARAM_INT);
		$stmt->bindParam(":creado_por", $datos["creado_por"], PDO::PARAM_INT);
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}

	/*=============================================
	MOSTRAR PRODUCTOS UBICACION
	=============================================*/

	static public function mdlMostrarProductoUbicacion($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla
			");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}


		$stmt = null;

	}

	/*=============================================
	MOSTRAR  LISTA DE UBICACION 
	=============================================*/

	static public function mdlMostrarUbicacionLista($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}
	/*=============================================
	EDITAR CATEGORIA
	=============================================

	static public function mdlEditarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :categoria,actualizado_por=:actualizado_por,fecha_actualizacion=:fecha_actualizacion WHERE id = :id");

		$stmt -> bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":actualizado_por", $datos["actualizado_por"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha_actualizacion", $datos["fecha_actualizacion"], PDO::PARAM_STR);
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
	BORRAR CATEGORIA
	=============================================

	static public function mdlBorrarCategoria($tabla, $datos){

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

