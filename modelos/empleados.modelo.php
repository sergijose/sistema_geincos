<?php

require_once "conexion.php";

class ModeloEmpleado{

	/*=============================================
	CREAR EMPLEADO
	=============================================*/

	static public function mdlIngresarEmpleado($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ape_pat,ape_mat,nombres,num_documento,estado) VALUES (:ape_pat,:ape_mat,:nombres,:num_documento,:estado)");

		$stmt->bindParam(":ape_pat", $datos["ape_pat"], PDO::PARAM_STR);
		$stmt->bindParam(":ape_mat", $datos["ape_mat"], PDO::PARAM_STR);
		$stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
		$stmt->bindParam(":num_documento", $datos["num_documento"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}
		$stmt = null;

	}

	/*=============================================
	MOSTRAR EMPLEADO
	=============================================*/

	static public function mdlMostrarEmpleado($tabla, $item, $valor){

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

		$stmt = null;

	}

	/*=============================================
	EDITAR EMPLEADO
	=============================================*/

	static public function mdlEditarEmpleado($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET ape_pat = :ape_pat, ape_mat = :ape_mat, nombres = :nombres, num_documento = :num_documento,estado=:estado  WHERE idempleado = :idempleado");
		$stmt->bindParam(":ape_pat", $datos["ape_pat"], PDO::PARAM_STR);
		$stmt->bindParam(":ape_mat", $datos["ape_mat"], PDO::PARAM_STR);
		$stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
		$stmt->bindParam(":num_documento", $datos["num_documento"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":idempleado", $datos["idempleado"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

	
		$stmt = null;

	}

	/*=============================================
	ELIMINAR EMPLEADO
	=============================================*/

	static public function mdlEliminarEmpleado($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idempleado = :idempleado");

		$stmt -> bindParam(":idempleado", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

	

		$stmt = null;

	}

	

}