<?php

class ControladorEmpleados{

	/*=============================================
	CREAR EMPLEADOS
	=============================================*/

	static public function ctrCrearEmpleados(){

		if(isset($_POST["nuevoNombres"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApePat"]) &&
              preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApeMat"]) && 
              preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombres"]) && 
               preg_match('/^[0-9]+$/', $_POST["nuevoNumDocumento"])&& 
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoEstado"])){

			   	$tabla = "empleado";

			   	$datos = array("ape_pat"=>$_POST["nuevoApePat"],
					           "ape_mat"=>$_POST["nuevoApeMat"],
					           "nombres"=>$_POST["nuevoNombres"],
                               "num_documento"=>$_POST["nuevoNumDocumento"],
                               "estado"=>$_POST["nuevoEstado"]);
                            

			   	$respuesta = ModeloEmpleado::mdlIngresarEmpleado($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Empleado ha sido registrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "empleados";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El empleado no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "empleados";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarEmpleados($item, $valor){

		$tabla = "empleado";

		$respuesta = ModeloEmpleado::mdlMostrarEmpleado($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR EMPLEADO
	=============================================*/

	static public function ctrEditarEmpleado(){

		if(isset($_POST["editarApePat"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApePat"]) &&
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApeMat"]) &&
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombres"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarNumDocumento"]) &&
               preg_match('/^[0-9]+$/', $_POST["editarEstado"])  ){

			   	$tabla = "empleado";

			   	$datos = array("ape_pat"=>$_POST["editarApePat"],
			   				   "ape_mat"=>$_POST["editarApeMat"],
					           "nombres"=>$_POST["editarNombres"],
					           "num_documento"=>$_POST["editarNumDocumento"],
					           "estado"=>$_POST["editarEstado"],
					           "idempleado"=>$_POST["idEmpleado"] );
                               

			   	$respuesta = ModeloEmpleado::mdlEditarEmpleado($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El empleado ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "empleados";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El empleado no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "empleados";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	ELIMINAR EMPLEADO
	=============================================*/

	static public function ctrEliminarEmpleado(){

		if(isset($_GET["idEmpleado"])){

			$tabla ="empleado";
			$datos = $_GET["idEmpleado"];

			$respuesta = ModeloEmpleado::mdlEliminarEmpleado($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El empleado ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "empleados";

								}
							})

				</script>';

			}		

		}

	}

}

