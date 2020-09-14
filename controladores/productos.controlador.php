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
	
	/*=============================================
	MOSTRAR ESTADO DEL PRODUCTO
	=============================================*/
    static public function ctrMostrarEstadoProducto($item, $valor, $orden){

        $tabla = "estado";
		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR TOTAL DE PRODUCTOS
	=============================================*/

	static public function ctrMostrarTotalProductos($item, $valor){

		$tabla = "producto";

		$respuesta = ModeloProductos::mdlMostrarTotalProductos($tabla, $item, $valor);

		return $respuesta;

    }
  

	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrCrearProducto(){

		if(isset($_POST["nuevoModelo"])){

			if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevoModelo"]) &&
			   preg_match('/^[-a-zA-Z0-9 ]+$/', $_POST["nuevoCodigo"]) &&	
			   preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevoEstado"]) &&
			   preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevoEstadoPrestamo"])){

		   		

				$tabla = "producto";

				$datos = array("idmodelo" => $_POST["nuevoModelo"],
							   "cod_producto" => strtoupper($_POST["nuevoCodigo"]),
							   "idestado" => $_POST["nuevoEstado"],
							   "estado_prestamo" => $_POST["nuevoEstadoPrestamo"]);

				$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					alertify.success("Agregado con exito");

						</script>';

				}


			}else{

				echo'<script>

				alertify.error("No se pudo agregar ");
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

					alertify.success("Actualizado con exito");

						</script>';

				}


			}else{

				echo'<script>

					
						alertify.error("No se pudo Actualizar ");
						

			  	</script>';
			}
		}

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarProducto(){

		if(isset($_GET["idProducto"])){

			$tabla ="producto";
			$datos = $_GET["idProducto"];

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

	


}