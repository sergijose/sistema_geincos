<?php

class ControladorProductos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProductos($item, $valor, $orden){

		$tabla = "producto";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);

		return $respuesta;

    }
    static public function ctrMostrarEstadoProducto($item, $valor, $orden){

        $tabla = "estado";
		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);

		return $respuesta;

	}

	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrCrearProducto(){

		if(isset($_POST["nuevoModelo"])){

			if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevoModelo"]) &&
			   preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevoCodigo"]) &&	
			   preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevoEstado"]) &&
			   preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevoEstadoPrestamo"])){

		   		

				$tabla = "producto";

				$datos = array("idmodelo" => $_POST["nuevoModelo"],
							   "cod_producto" => $_POST["nuevoCodigo"],
							   "idestado" => $_POST["nuevoEstado"],
							   "estado_prestamo" => $_POST["nuevoEstadoPrestamo"]);

				$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El producto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "productos";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarProducto(){

		if(isset($_POST["editarModelo"])){

			if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editarModelo"]) &&
			   preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editarCodigo"]) &&	
			   preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editarEstado"]) &&
			   preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editarEstadoPrestamo"])){

				$tabla = "producto";

				$datos = array("idmodelo" => $_POST["editarModelo"],
							   "cod_producto" => $_POST["editarCodigo"],
							   "idestado" => $_POST["editarEstado"],
							   "estado_prestamo" => $_POST["editarEstadoPrestamo"],
							   "id" => $_POST["id"]);

				$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El producto ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "productos";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarProducto(){

		if(isset($_GET["idProducto"])){

			$tabla ="productos";
			$datos = $_GET["idProducto"];

			if($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/default/anonymous.png"){

				unlink($_GET["imagen"]);
				rmdir('vistas/img/productos/'.$_GET["codigo"]);

			}

			$respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "productos";

								}
							})

				</script>';

			}		
		}


	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function ctrMostrarSumaVentas(){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);

		return $respuesta;

	}


}