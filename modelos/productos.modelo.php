<?php

require_once "conexion.php";

class ModeloProductos{

	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function mdlIngresarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idmodelo,cod_producto,num_serie,idestado,estado_prestamo,observaciones,creado_por) VALUES (:idmodelo,:cod_producto,:num_serie,:idestado,:estado_prestamo,:observaciones,:creado_por)");

		$stmt->bindParam(":idmodelo", $datos["idmodelo"], PDO::PARAM_INT);
		$stmt->bindParam(":cod_producto", $datos["cod_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":num_serie", $datos["num_serie"], PDO::PARAM_STR);
		$stmt->bindParam(":idestado", $datos["idestado"], PDO::PARAM_INT);
		$stmt->bindParam(":estado_prestamo", $datos["estado_prestamo"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":creado_por", $datos["creado_por"], PDO::PARAM_INT);

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

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id asc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  ORDER BY $orden DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
	}

		/*=============================================
	MOSTRAR LISTA DE ESTADOS DE PRODUCTOS
	=============================================*/

	static public function mdlMostrarEstadoFisicoProducto($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item" );

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	

		$stmt = null;

	}


		//para validar no repetir codigo y numero de serie del producto
	static public function mdlMostrarProductosRepetidos($tabla, $item, $valor){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();
	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function mdlEditarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idmodelo=:idmodelo,cod_producto=:cod_producto,num_serie=:num_serie, idestado=:idestado,estado_prestamo=:estado_prestamo,observaciones=:observaciones,actualizado_por=:actualizado_por,fecha_actualizacion=:fecha_actualizacion WHERE id=:id");

		$stmt -> bindParam(":idmodelo", $datos["idmodelo"], PDO::PARAM_INT);
		$stmt -> bindParam(":cod_producto", $datos["cod_producto"], PDO::PARAM_STR);
		$stmt -> bindParam(":num_serie", $datos["num_serie"], PDO::PARAM_STR);
		$stmt -> bindParam(":idestado", $datos["idestado"], PDO::PARAM_INT);
		$stmt -> bindParam(":estado_prestamo", $datos["estado_prestamo"], PDO::PARAM_STR);
		$stmt -> bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt -> bindParam(":actualizado_por", $datos["actualizado_por"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha_actualizacion", $datos["fecha_actualizacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProducto($tabla, $datos){

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
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		

		$stmt = null;

	}




/*=============================================
	MOSTRAR TOTAL DE PRODCUTOS POR CATEGORIA
	=============================================*/

	static public function mdlMostrarTotalProductos(){

		

			$stmt = Conexion::conectar()->prepare("SELECT  cat.descripcion AS CATEGORIA,mar.descripcion AS MARCA,mo.descripcion AS MODELO,
			SUM(pro.estado_prestamo='OCUPADO') AS OCUPADO,
			sum(pro.estado_prestamo='DISPONIBLE') AS LIBRE,sum(pro.estado_prestamo='NO APLICA')AS 'NO APLICA',		
			COUNT(pro.idestado) AS TOTAL FROM producto pro 
			inner JOIN modelo mo
			ON pro.idmodelo=mo.id
			INNER JOIN marca mar
			ON mar.id=mo.idmarca
			INNER JOIN categoria cat
			ON  cat.id=mo.idcategoria
			GROUP BY cat.descripcion,mar.descripcion,mo.descripcion"
			);

			$stmt -> execute();

			return $stmt -> fetchAll();


		$stmt = null;

	}

	/*=============================================
	MOSTRAR ESTADOS FISICOS DE PRODUCTOS 
	=============================================*/

	static public function mdlMostrarTotalProductosPorEstados(){

		$stmt = Conexion::conectar()->prepare("SELECT  cat.descripcion AS CATEGORIA,mar.descripcion AS MARCA,mo.descripcion AS MODELO,
		SUM(es.descripcion='OPERATIVO')AS OPERATIVO,
		SUM(es.descripcion='MALOGRADO')AS MALOGRADO,
		SUM(es.descripcion='REPARACION INTERNA')AS REPARACION_INTERNA,
		SUM(es.descripcion='REPARACION GARANTIA')AS REPARACION_GARANTIA,
			SUM(es.descripcion='DESCUENTO POR MAL USO')AS DESCUENTO_MAL_USO,
		COUNT(pro.idestado) AS TOTAL
		 FROM producto pro 
			inner JOIN modelo mo
			ON pro.idmodelo=mo.id
			INNER JOIN marca mar
			ON mar.id=mo.idmarca
			INNER JOIN categoria cat
			ON  cat.id=mo.idcategoria
			INNER JOIN estado es
			ON pro.idestado=es.id
			GROUP BY cat.descripcion,mar.descripcion,mo.descripcion");
		
		$stmt -> execute();

		return $stmt -> fetchAll();


	$stmt = null;

}
 /*=============================================
	MOSTRAR ESTADOS DE PRESTAMOS DE PRODCUTOS POR CATEGORIA
	=============================================*/

	static public function mdlMostrarTotalProductosPorEstadosDePrestamo($categoria){

		$stmt = Conexion::conectar()->prepare("SELECT  cat.descripcion AS CATEGORIA,mar.descripcion AS MARCA,pro.estado_prestamo,COUNT(cat.descripcion) AS STOCK FROM producto pro 
		inner JOIN modelo mo
		ON pro.idmodelo=mo.id
		INNER JOIN marca mar
		ON mar.id=mo.idmarca
		INNER JOIN categoria cat
		ON  cat.id=mo.idcategoria
		GROUP BY cat.descripcion,mar.descripcion,pro.estado_prestamo
		HAVING cat.descripcion=:categoria"
		);
		$stmt -> bindParam(":categoria", $categoria, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();


	$stmt = null;

}




}