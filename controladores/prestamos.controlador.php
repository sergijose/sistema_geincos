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
	CREAR PRESTAMOS
	=============================================*/

	static public function ctrCrearPrestamo(){

		if(isset($_POST["nuevoUsuario"])){

			/*=============================================
			ACTUALIZAR LAS EL ESTADO DE PRESTAMO DE LOS PRODUCTOS 
			=============================================*/

			if($_POST["listaProductos"] == ""){

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

			foreach ($listaProductos as $key => $value) {

			   
				//con esto actualizo todos los productos que tienen ese id de la listaProductos
			    $tablaProductos = "producto";
			    $valor = $value["id"];
				$item1a = "estado_prestamo";
				$valor1a = "OCUPADO";
			    $nuevasPrestamos = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);


			}
			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "prestamo";

            $datos = array("idusuario"=>$_POST["idUsuario"],
                            "producto"=>$_POST["listaProductos"],
						   "idempleado"=>$_POST["nuevoEmpleado"],  
						   "observaciones"=>$_POST["nuevaObservacion"]);

			$respuesta = ModeloPrestamos::mdlIngresarPrestamo($tabla, $datos);

			if($respuesta == "ok"){
                var_dump($respuesta);
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
                var_dump($respuesta);
				echo'<script>

					
						alertify.error("No se pudo Prestar ");
						

			  	</script>';
			}

		}

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	


	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	
	/*=============================================
	RANGO FECHAS
	=============================================*/	

	



	

	

	

	
	

}