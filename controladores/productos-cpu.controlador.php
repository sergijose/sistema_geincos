<?php

class ControladorProductosCpu
{

	/*=============================================
	MOSTRAR DETALLE PRODUCTOS-CPU
	=============================================*/

	static public function ctrMostrarProductosCpu($item, $valor, $orden)
	{

		$tabla = "producto_cpu";

		$respuesta = ModeloProductosCpu::mdlMostrarProductosCpu($tabla, $item, $valor, $orden);

		return $respuesta;
	}

		/*=============================================
	MOSTRAR CODIGO DE PRODUCTOS DE LA CATEGORIA CPU
	=============================================*/

	static public function ctrMostrarCodigoProductoCpu($cat)
	{

		

		$respuesta = ModeloProductosCpu::mdlMostrarCodigoProductoCpu($cat);

		return $respuesta;
	}



	/*=============================================
	MOSTRAR PRODUCTOS REPETIDOS CODIGO Y NUMERO DE SERIE
	=============================================*/

	static public function ctrMostrarProductosRepetidos($item, $valor)
	{

		$tabla = "producto";

		$respuesta = ModeloProductos::mdlMostrarProductosRepetidos($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR ESTADO DEL PRODUCTO
	=============================================*/
	static public function ctrMostrarEstadoProducto($item, $valor, $orden)
	{

		$tabla = "estado";
		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR TOTAL DE PRODUCTOS
	=============================================*/

	static public function ctrMostrarTotalProductos()
	{

		$respuesta = ModeloProductos::mdlMostrarTotalProductos();

		return $respuesta;
	}
	/*=============================================
	MOSTRAR TOTAL DE ESTADOS DEPRODUCTOS POR CATEGORIA PARA EL REPORTE
	=============================================*/

	static public function ctrMostrarTotalProductosPorEstados($categoria)
	{

		$respuesta = ModeloProductos::mdlMostrarTotalProductosPorEstados($categoria);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR TOTAL DE ESTADOS  DE PRESTAMOS  DEPRODUCTOS POR CATEGORIA PARA EL REPORTE
	=============================================*/

	static public function ctrMostrarTotalProductosPorEstadoDePrestamo($categoria)
	{

		$respuesta = ModeloProductos::mdlMostrarTotalProductosPorEstadosDePrestamo($categoria);

		return $respuesta;
	}

	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrCrearProducto()
	{
	


		if (isset($_POST["nuevoModelo"])) {

			if (
				preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevoModelo"]) &&
				preg_match('/^[-a-zA-Z0-9 ]+$/', $_POST["nuevoCodigo"]) &&
				//preg_match('/^[-a-zA-Z0-9 ]+$/', $_POST["nuevoNumSerie"]) &&	
				preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevoEstado"]) &&
				preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevoEstadoPrestamo"])
			) {

				//var_dump($_FILES["barcode1"]["tmp_name"]);
				//return


				$tabla = "producto";


				$datos = array(
					"idmodelo" => $_POST["nuevoModelo"],
					"cod_producto" => strtoupper($_POST["nuevoCodigo"]),
					"num_serie" => strtoupper($_POST["nuevoNumSerie"]),
					"idestado" => $_POST["nuevoEstado"],
					"estado_prestamo" => $_POST["nuevoEstadoPrestamo"]
				);

				$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					alertify.success("Agregado con exito");

						</script>';
				}
			} else {

				echo '<script>

				alertify.error("No se pudo agregar ");
						})

			  	</script>';
			}
		}
	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarProducto()
	{

		if (isset($_POST["editarModelo"])) {

			if (
				preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editarModelo"]) &&
				preg_match('/^[-a-zA-Z0-9 ]+$/', $_POST["editarCodigo"]) &&
				//  preg_match('/^[-a-zA-Z0-9 ]+$/', $_POST["editarNumSerie"]) &&
				preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editarEstado"]) &&
				preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editarEstadoPrestamo"])
			) {

				$tabla = "producto";

				$datos = array(
					"idmodelo" => $_POST["editarModelo"],
					"cod_producto" => $_POST["editarCodigo"],
					"num_serie" => $_POST["editarNumSerie"],
					"idestado" => $_POST["editarEstado"],
					"estado_prestamo" => $_POST["editarEstadoPrestamo"],
					"id" => $_POST["id"]
				);

				$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					alertify.success("Actualizado con exito");

						</script>';
				}
			} else {

				echo '<script>

					
						alertify.error("No se pudo Actualizar ");
						

			  	</script>';
			}
		}
	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarProducto()
	{

		if (isset($_GET["idProducto"])) {

			$tabla = "producto";
			$datos = $_GET["idProducto"];

			$respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>
					
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
