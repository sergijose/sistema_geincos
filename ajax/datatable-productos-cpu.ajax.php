
<?php

require_once "../controladores/productos-cpu.controlador.php";
require_once "../modelos/productos-cpu.modelo.php";

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/modelos.controlador.php";
require_once "../modelos/modelos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaProductosCpu
{

	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/

	public function mostrarTablaProductosCpu()
	{

		$item = null;
		$valor = null;
		$orden = "id";

		$productosCpu = ControladorProductosCpu::ctrMostrarProductosCpu($item, $valor, $orden);

		if (count($productosCpu) == 0) {

			echo '{"data": []}';

			return;
		}

		$datosJson = '{
		  "data": [';

		for ($i = 0; $i < count($productosCpu); $i++) {

			/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/

			//	$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";

				/*=============================================
 	 		SVG codigo barras
  			=============================================*/

				//$codigo_barras = "<img class='barcodetabla' id='".$productos[$i]["cod_producto"]."'>";

				
				

			/*=============================================
 	 		TRAEMOS EL CODIGO DEL PRODUCTO
  			=============================================*/

			$item = "id";
			$valor = $productosCpu[$i]["idproducto"];
			$order = "id";
			$Producto = ControladorProductos::ctrMostrarProductos($item, $valor,$order);

			
			/*=============================================
 	 		ESTADO DEL PRODUCTO
  			=============================================


			$item = "id";
			$valor = $productos[$i]["idestado"];
			$order = "id";

			$estadoProducto = ControladorProductos::ctrMostrarEstadoProducto($item, $valor, $order);
			*/



			/*=============================================
 	 		ESTADO DEL PRESTAMO DEL PRODUCTO
  			=============================================

			if ($productos[$i]["estado_prestamo"] == "DISPONIBLE") {

				$estado = "<button class='btn  btn-xs btn-success'>DISPONIBLE</button>";
			} else {

				$estado = "<button class='btn   btn-xs btn-danger'>OCUPADO</button>";
			}

			*/

			/*=============================================
 	 		TRAEMOS LAS ACCIONES
			  =============================================*/
			  
			  if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial"){
				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProductoCpu' idProductoCpu='" . $productosCpu[$i]["id"] ."' data-toggle='modal' data-target='#modalEditarProductoCpu'><i class='fa fa-pencil'></i></button></div>";


			}else{
			$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProductoCpu' idProductoCpu='" . $productosCpu[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarProductoCpu'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProductoCpu' idProductoCpu='" . $productosCpu[$i]["id"] . "'><i class='fa fa-times'></i></button></div>";
		}

			$datosJson .= '[
			      "' . ($i + 1) . '",
                  "' . $Producto["cod_producto"]. '",
				  "' . $productosCpu[$i]["tipo_disco"] . '",
				  "' . $productosCpu[$i]["cant_disco"] . '",
				  "' . $productosCpu[$i]["tipo_ram"] . '",
                  "' .$productosCpu[$i]["cant_ram"] .'",
				  "' .$productosCpu[$i]["procesador"] .'",
				  "' .$productosCpu[$i]["sistema_operativo"] .'",
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
$activarProductosCpu = new TablaProductosCpu();
$activarProductosCpu->mostrarTablaProductosCpu();
