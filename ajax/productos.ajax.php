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
	public $traerProductos;

	public function ajaxEditarProducto(){

		if($this->traerProductos == "ok"){

			$item = null;
			$valor = null;
			$orden = "id";
	  
			$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,
			  $orden);
	  
			echo json_encode($respuesta);
	  
	  
		  }else {

			$item = "id";
		$valor = $this->idProducto;
        $orden = "id";
		$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,$orden);

		echo json_encode($respuesta);

		  }

		

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
/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerProductos"])){

	$traerProductos = new AjaxProductos();
	$traerProductos -> traerProductos = $_POST["traerProductos"];
	$traerProductos -> ajaxEditarProducto();
  
  }