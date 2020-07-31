<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxProductos{

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/	

	public $idProducto;

	public function ajaxEditarProducto(){

		$item = "id";
		$valor = $this->idProducto;
        $orden = "id";
		$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,$orden);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR PRODUCTO
=============================================*/	
if(isset($_POST["idProducto"])){

	$marca = new AjaxProductos();
	$marca -> idProducto = $_POST["idProducto"];
	$marca -> ajaxEditarProducto();
}
