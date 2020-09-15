<?php



class ControladorPrestamos{

	/*=============================================
	MOSTRAR Prestamos
	=============================================*/

	static public function ctrMostrarPrestamos($item, $valor){

		$tabla = "prestamo";

		$respuesta = ModeloPrestamos::mdlMostrarPrestamos($tabla, $item, $valor);

		return $respuesta;

	}



	/*=============================================
	MOSTRAR PRESTAMOS PENDIENTES POR EMPLEADO
	=============================================*/

	static public function ctrMostrarPrestamosPendiente($item, $valor){

		$tabla = "prestamo";

		$respuesta = ModeloPrestamos::mdlMostrarPrestamosPendiente($tabla, $item, $valor);

		return $respuesta;

	}
	/*=============================================
	CREAR PRESTAMOS
	=============================================*/

	static public function ctrCrearPrestamo(){

		if(isset($_POST["nuevoUsuario"])){

			/*=============================================
			ACTUALIZAR LAS EL ESTADO DE PRESTAMO DE LOS PRODUCTOS 
			=============================================*/

			if($_POST["listaProductos2"] == "" or $_POST["listaProductos2"]=="[]" ){

					echo'<script>

				swal({
					  type: "error",
					  title: "El prestamo no procede si no se elige uno",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "crear-prestamo";

								}
							})

				</script>';

				return;
			}


			$listaProductos = json_decode($_POST["listaProductos"], true);
			$listaProductos2 = json_decode($_POST["listaProductos2"], true);

			foreach ($listaProductos as $key => $value) {

			   
				//con esto actualizo todos los productos que tienen ese id de la listaProductos
			    $tablaPrestamo = "producto";
			    $valor = $value["id"];
				$item1a = "estado_prestamo";
				$valor1a = "OCUPADO";
			    $nuevasPrestamos = ModeloProductos::mdlActualizarProducto($tablaPrestamo, $item1a, $valor1a, $valor);


			}
			foreach ($listaProductos2 as $key => $value) {
				$valorCaja=$value["id"];
				$valorObservaciones=$value["observacion"];
			   /*=============================================
			GUARDAR EL PRESTAMO
			=============================================*/	

			$tabla = "prestamo";

            $datos = array("idusuario"=>$_POST["idUsuario"],
                            "idproducto"=>$valorCaja,
						   "idempleado"=>$_POST["nuevoEmpleado"],  
						   "observacion_prestamo"=>$valorObservaciones,
						   "estado_prestamo"=>"PENDIENTE"
						);
						 
			$respuesta = ModeloPrestamos::mdlIngresarPrestamo($tabla, $datos);

			}
			
			if($respuesta == "ok"){
                echo'<script>
                
				swal({
					  type: "success",
					  title: "El prestamo se ha guardado  correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "prestamos";

								}
							})

				</script>';

            }
            else{
               
				echo'<script>

					
						alertify.error("No se pudo Prestar ");
						

			  	</script>';
			}

		}

	}
	

	static public function ctrDevolverProducto(){

		if(isset($_POST["observacionDevolucion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ, ]+$/', $_POST["observacionDevolucion"])){

				$tabla = "prestamo";
				date_default_timezone_set('America/Bogota');

						$fecha = $_POST["fechaDevolucion"];
						$hora = date('H:i:s');

						$fechaDevolucion = $fecha.' '.$hora;

				$datos = array("fecha_devolucion"=>$fechaDevolucion,
								"observacion_devolucion"=>$_POST["observacionDevolucion"],
								"estado_prestamo"=>"FINALIZADO",
							   "id"=>$_POST["idPrestamo"]);

				$respuesta = ModeloPrestamos::mdlDevolverProducto($tabla, $datos);

				if($respuesta == "ok"){
					$tablaProducto="producto";
					$valor =$_POST["idProducto"];
					$item1a = "estado_prestamo";
					$valor1a = "DISPONIBLE";
					$devolucion = ModeloProductos::mdlActualizarProducto($tablaProducto, $item1a, $valor1a, $valor);
					echo'<script>

					swal({
						  type: "success",
						  title: "Se registro la devolucion del producto",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "prestamos";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "La devolucion no se ha podido registrar",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "prestamos";

							}
						})

			  	</script>';

			}

		}

	}
		//eliminar prestamo

	static public function ctrEliminarPrestamo(){

		if(isset($_GET["idPrestamo"])){

			$tabla ="prestamo";
			$datos = $_GET["idPrestamo"];

			$respuesta = ModeloPrestamos::mdlEliminarPrestamos($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>
					
				swal({
					  type: "success",
					  title: "El prestamo ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "prestamos";

								}
							})

				</script>';

			}		
		}


	}



	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasPrestamos($fechaInicial, $fechaFinal){

		$tabla = "prestamo";

		$respuesta = ModeloPrestamos::mdlRangoFechasPrestamos($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}


	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporte(){

		if(isset($_GET["prestamo"])){

			$tabla = "prestamo";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$prestamo = ModeloPrestamos::mdlRangoFechasPrestamos($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$prestamo = ModeloPrestamos::mdlMostrarPrestamos($tabla, $item, $valor);

			}


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["prestamo"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");
		
			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>USUARIO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>EMPLEADO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>F_PRESTAMO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>F_DEVOLUCION</td>
					<td style='font-weight:bold; border:1px solid #eee;'>OBS_PRESTAMO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>OBS_DEVOLUCION</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>ESTADO_PRESTAMO</td>		
					</tr>");

			foreach ($prestamo as $row => $item){

				$usuario = ControladorUsuarios::ctrMostrarUsuarios("id", $item["idusuario"]);
				$producto = ControladorProductos::ctrMostrarProductos("id", $item["idproducto"],"id");

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$usuario["nombre"]."</td> 
			 			<td style='border:1px solid #eee;'>".$producto["cod_producto"]."</td>
						 <td style='border:1px solid #eee;'>".$item["idempleado"]."</td>
						 <td style='border:1px solid #eee;'>".substr($item["fecha_prestamo"],0,10)."</td>
						 <td style='border:1px solid #eee;'>".substr($item["fecha_devolucion"],0,10)."</td>
						 <td style='border:1px solid #eee;'>".$item["observacion_prestamo"]."</td>
						 <td style='border:1px solid #eee;'>".$item["observacion_devolucion"]."</td>
						 <td style='border:1px solid #eee;'>".$item["estado_prestamo"]."</td>
						
						 </tr>");


			}
			
			echo "</table>";

		}

	}




    
}

