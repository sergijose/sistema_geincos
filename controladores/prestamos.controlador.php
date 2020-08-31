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

				$datos = array("fecha_devolucion"=>$_POST["fechaDevolucion"],
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
    
}

