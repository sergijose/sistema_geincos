<?php

class ControladorProductoUbicacion{

	/*=============================================
	CREAR CATEGORIAS
	=============================================*/

	static public function ctrCrearProductoUbicacion(){

		if(isset($_POST["nuevoProductoUbicacion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoProductoUbicacion"])){

				$tabla = "ubicacion_productos";
			
			

				$datos = array(
					"id_producto" => $_POST["nuevoProductoUbicacion"],
					"id_ubicacion" => $_POST["nuevaUbicacion"],
					"posicion" => $_POST["nuevaPosicion"],
					"creado_por" => $_POST["creado_por"]

				);


				$respuesta = ModeloProductoUbicacion::mdlIngresarProductoUbicacion($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Se agrego la ubicacion de este Producto",
						  showConfirmButton: true,
						  allowOutsideClick: false,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "ubicacion-productos";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Este producto no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  allowOutsideClick: false,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ubicacion-productos";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR UBICACION DE PRODUCTOS
	=============================================*/

	static public function ctrMostrarProductoUbicacion($item, $valor){

		$tabla = "ubicacion_productos";

		$respuesta = ModeloProductoUbicacion::mdlMostrarProductoUbicacion($tabla, $item, $valor);

		return $respuesta;
	
	}


	static public function ctrMostrarUbicacionLista($item, $valor){

		$tabla = "ubicacion";

		$respuesta = ModeloProductoUbicacion::mdlMostrarUbicacionLista($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR UBICACION DE PRODUCTOS
	=============================================*/

	static public function ctrEditarCategoria(){

		if(isset($_POST["editarCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])){

				$tabla = "categoria";
				date_default_timezone_set('America/Bogota');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$fechaActual = $fecha . ' ' . $hora;

				$datos = array("categoria"=>$_POST["editarCategoria"],
				"actualizado_por"=>$_POST["actualizado_por"],
				"fecha_actualizacion"=>$fechaActual,
				  "id"=>$_POST["idCategoria"]);

				$respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido cambiada correctamente",
						  showConfirmButton: true,
						  allowOutsideClick: false,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categorias";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarCategoria(){

		if(isset($_GET["idCategoria"])){

			$tabla ="Categoria";
			$datos = $_GET["idCategoria"];

			$respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido borrada correctamente",
						  showConfirmButton: true,
						  allowOutsideClick: false,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';
			}
		}
		
	}
}
