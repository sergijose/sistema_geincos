<?php

require_once "../controladores/modelos.controlador.php";
require_once "../modelos/modelos.modelo.php";

class AjaxUsuarios{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $idModelo;

	public function ajaxEditarUsuario(){

		$item = "id";
		$valor = $this->idModelo;

		$respuesta = ControladorModelos::ctrMostrarModelo($item, $valor);

		echo json_encode($respuesta);

	}

	

	/*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/	

	public $validarUsuario;

	public function ajaxValidarUsuario(){

		$item = "usuario";
		$valor = $this->validarUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["idModelo"])){

	$editar = new AjaxUsuarios();
	$editar -> idModelo = $_POST["idModelo"];
	$editar -> ajaxEditarUsuario();

}





