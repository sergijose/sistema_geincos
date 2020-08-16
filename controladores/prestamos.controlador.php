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
	EDITAR PRESTAMOS
	=============================================*/

	static public function ctrEditarPrestamo(){

		if(isset($_POST["idPrestamo"])){

            /*=============================================
			FORMATEAR TABLA DE PRODUCTOS 
			=============================================*/
			$tabla = "prestamo";

			$item = "id";
			$valor = $_POST["idPrestamo"];

			$traerPrestamo = ModeloPrestamos::mdlMostrarPrestamos($tabla, $item, $valor);

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

				$listaProductos = $traerPrestamo["producto"];
				$cambioProducto = false;


			}else{

				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;
			}

			if($cambioProducto){

				$productos =  json_decode($traerPrestamo["producto"], true);

				$totalProductosPrestados = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosPrestados, $value["codigo"]);
					
					$tablaProductos = "producto";
					$item1a = "estado_prestamo";
                    $valor1a = "DISPONIBLE";
                    $valorproducto = $value["id"];
				    
			    $nuevasPrestamos = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valorproducto);


				

					

				}

				
			
                    //ACTUALIZAR EL ESTADO DEL PRODUCTO AL REALIZAR EL PRESTAMO ACTUALIZADO

			$listaProductos_2 = json_decode($listaProductos, true);

			foreach ($listaProductos_2 as $key => $value) {

			   
				//con esto actualizo todos los productos que tienen ese id de la listaProductos
			    $tablaProductos_2 = "producto";
			    $valor_2 = $value["id"];
				$item1a_2 = "estado_prestamo";
				$valor1a_2 = "OCUPADO";
			    $nuevosPrestamos_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);


            }
        }
			/*=============================================
			GUARDAR EL PRESTAMO
			=============================================*/	

			
			

            $datos = array("idusuario"=>$_POST["idUsuario"],
                            "producto"=>$listaProductos,
						   "idempleado"=>$_POST["nuevoEmpleado"], 
						   "fecha_devolucion"=>$_POST["fechaDevolucion"],   
                           "observaciones"=>$_POST["editarObservacion"],
                           "id"=>$_POST["idPrestamo"]);

			$respuesta = ModeloPrestamos::mdlEditarPrestamo($tabla, $datos);

			if($respuesta == "ok"){
              
                echo'<script>
                
				swal({
					  type: "success",
					  title: "El prestamo se ha actualizado  correctamente",
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

					
						alertify.error("No se pudo Actualizar el prestamo ");
						

			  	</script>';
			}

		

	}
}

}