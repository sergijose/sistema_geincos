<?php

class ControladorProductos
{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProductos($item, $valor, $orden)
	{

		$tabla = "producto";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);

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
	MOSTRAR TOTAL DE ESTADOS DE PRODUCTOS PARA EL REPORTE
	=============================================*/

	static public function ctrMostrarTotalProductosPorEstados()
	{

		$respuesta = ModeloProductos::mdlMostrarTotalProductosPorEstados();

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
					"estado_prestamo" => $_POST["nuevoEstadoPrestamo"],
					"creado_por" => $_POST["creado_por"]
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
				date_default_timezone_set('America/Bogota');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$fechaActual = $fecha . ' ' . $hora;

				$datos = array(
					"idmodelo" => $_POST["editarModelo"],
					"cod_producto" => $_POST["editarCodigo"],
					"num_serie" => $_POST["editarNumSerie"],
					"idestado" => $_POST["editarEstado"],
					"estado_prestamo" => $_POST["editarEstadoPrestamo"],
					"actualizado_por"=>$_POST["actualizado_por"],
					"fecha_actualizacion"=>$fechaActual,
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
					  allowOutsideClick: false,
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
