<?php


require_once "../controladores/productos-cpu.controlador.php";
require_once "../modelos/productos-cpu.modelo.php";

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";



class AjaxProductosCpu{

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/	

	public $idProducto;
	public $traerProductos;
	public $codigoProducto;
	public $validarCodigo;


	public function ajaxValidarCodigoProductoCpu(){

		$item = "idproducto" ;
		$valor = $this->validarCodigo;

		$respuestacodigo = ControladorProductosCpu::ctrMostrarProductosRepetidosCpu($item, $valor);

		echo json_encode($respuestacodigo);

	}

	

	public function ajaxEditarProducto(){

		if($this->traerProductos == "ok"){

			$item = null;
			$valor = null;
			$orden = "id";
	  
			$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,
			  $orden);
	  
			echo json_encode($respuesta);
	  
	  
		  }else if($this->codigoProducto != ""){

			$item ="cod_producto";
			$valor = $this->codigoProducto;
			$orden = "id";
	  
			$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,
			  $orden);
	  
			echo json_encode($respuesta);
	  
		  }
		  
		 
		  else {

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
if(isset($_POST["nuevoCodProductoCpu"])){

	$marca = new AjaxProductosCpu();
	$marca -> idProducto = $_POST["nuevoCodProductoCpu"];
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

  /*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["codigoProducto"])){

	$traerProductos = new AjaxProductos();
	$traerProductos -> codigoProducto = $_POST["codigoProducto"];
	$traerProductos -> ajaxEditarProducto();
  
  }
   /*=============================================
TRAER CODIGO PRODUCTO = PARA VALIDAR NO REGISTRAR VARIAS VECES UN PRODUCTO CPU
=============================================*/ 

  if(isset( $_POST["validarCodigo"])){

	$valiProducto = new AjaxProductosCpu();
	$valiProducto -> validarCodigo = $_POST["validarCodigo"];
	$valiProducto -> ajaxValidarCodigoProductoCpu();

}
 