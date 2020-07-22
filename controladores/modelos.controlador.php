<?php

class ControladorModelos{

	/*=============================================
	CREAR MODELOS
	=============================================*/
/*
	static public function ctrCrearModelo(){

		if(isset($_POST["nuevaMarca"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaMarca"])){

				$tabla = "marca";

				$datos = $_POST["nuevaMarca"];

				$respuesta = ModeloMarcas::mdlIngresarMarca($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La nueva MARCA ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "modelos";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La marca no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "modelos";

							}
						})

			  	</script>';

			}

		}

	}
	*/

	/*=============================================
	MOSTRAR MODELOS
	=============================================*/

	static public function ctrMostrarModelo($item, $valor){

		$tabla = "modelo";

		$respuesta = ModeloModelos::mdlMostrarModelos($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR MARCA
	=============================================*/

	/*
	static public function ctrEditarModelo(){

		if(isset($_POST["editarMarca"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarMarca"])){

				$tabla = "marca";

				$datos = array("marca"=>$_POST["editarMarca"],
							   "id"=>$_POST["idMarca"]);

				$respuesta = ModeloModelos::mdlEditarModelo($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La  MARCA ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "modelos";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La MARCA no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "modelos";

							}
						})

			  	</script>';

			}

		}

	}
*/
	/*=============================================
	BORRAR MARCA
	=============================================*/

	/*
	static public function ctrBorrarModelo(){

		if(isset($_GET["idMarca"])){

			$tabla ="marca";
			$datos = $_GET["idMarca"];

			$respuesta = ModeloModelos::mdlBorrarModelo($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La marca ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "modelos";

									}
								})

					</script>';
			}
		}
		
	}
	*/
}
