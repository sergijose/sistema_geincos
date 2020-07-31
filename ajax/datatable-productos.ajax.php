<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/modelos.controlador.php";
require_once "../modelos/modelos.modelo.php";


class TablaProductos
{

	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/

	public function mostrarTablaProductos()
	{

		$item = null;
		$valor = null;
		$orden = "id";

		$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

		if (count($productos) == 0) {

			echo '{"data": []}';

			return;
		}

		$datosJson = '{
		  "data": [';

		for ($i = 0; $i < count($productos); $i++) {

			/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/

			//	$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";

			/*=============================================
 	 		TRAEMOS EL MODELO
  			=============================================*/

			$item = "id";
			$valor = $productos[$i]["idmodelo"];

			$modelos = ControladorModelos::ctrMostrarModelo($item, $valor);


			/*=============================================
 	 		ESTADO DEL PRODUCTO
  			=============================================*/


			$item = "id";
			$valor = $productos[$i]["idestado"];
			$order = "id";

			$estadoProducto = ControladorProductos::ctrMostrarEstadoProducto($item, $valor, $order);

			/*=============================================
 	 		ESTADO DEL PRESTAMO DEL PRODUCTO
  			=============================================*/

			if ($productos[$i]["estado_prestamo"] == "DISPONIBLE") {

				$estado = "<button class='btn btn-success'>DISPONIBLE</button>";
			} else {

				$estado = "<button class='btn btn-danger'>OCUPADO</button>";
			}

			/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/
			$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='" . $productos[$i]["id"] . "' idModelo='" . $productos[$i]["idmodelo"] . "'idEstado='" . $productos[$i]["idestado"] . "' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='" . $productos[$i]["id"] . "' codigo='" . $productos[$i]["cod_producto"] . "'><i class='fa fa-times'></i></button></div>";


			$datosJson .= '[
			      "' . ($i + 1) . '",
                  "' . $modelos["descripcion"] . '",
                  "' . $productos[$i]["cod_producto"] . '",
                  "' . $estadoProducto["descripcion"] . '",
                  "' . $estado . '",
			      "' . $botones . '"
			    ],';
		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .=   '] 

		 }';

		echo $datosJson;
	}
}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$activarProductos = new TablaProductos();
$activarProductos->mostrarTablaProductos();
