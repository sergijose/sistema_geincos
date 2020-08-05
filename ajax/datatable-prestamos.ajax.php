<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";


require_once "../controladores/modelos.controlador.php";
require_once "../modelos/modelos.modelo.php";


class TablaProductosPrestamos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProductosPrestamos(){

		$item = null;
    	$valor = null;
    	$orden = "id";

          $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
          


 		
  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){



            /*=============================================
 	 		TRAEMOS IMAGEN DEL MODELO
  			=============================================*/ 

              $item = "id";
              $valor = $productos[$i]["idmodelo"];
  
              $modelos = ControladorModelos::ctrMostrarModelo($item, $valor);
              $imagenProducto = "<img src='".$modelos["imagen"]."' width='40px'>";

		  	/*=============================================
 	 		TRAEMOS EL MODELO
  			=============================================*/ 

              $item = "id";
              $valor = $productos[$i]["idmodelo"];
  
              $modelos = ControladorModelos::ctrMostrarModelo($item, $valor);


              /*=============================================
 	 		TRAEMOS ESTADO DEL PRODUCTO
              =============================================*/ 
              
              $item = "id";
              $valor = $productos[$i]["idestado"];
              $order="id";
  
              $estadoProducto = ControladorProductos::ctrMostrarEstadoProducto($item, $valor,$order);

		  	/*=============================================
 	 		TRAEMOS ESTADO DEL PRESTAMO DEL PRODUCTO
              =============================================*/ 
        

  			if($productos[$i]["estado_prestamo"] =="OCUPADO"){

                $estadoPrestamoProducto = "<button class='btn btn-danger'>".$productos[$i]["estado_prestamo"]."</button>";

  			}else{

                $estadoPrestamoProducto = "<button class='btn btn-success'>".$productos[$i]["estado_prestamo"]."</button>";

  			}

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

		  	$botones =  "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id"]."'>Agregar</button></div>"; 

		  	$datosJson .='[
                  "'.($i+1).'",
                "'.$imagenProducto.'",
			      "'.$modelos["descripcion"].'",
			      "'.$productos[$i]["cod_producto"].'",
			      "'.$estadoProducto["descripcion"].'",
			      "'.$estadoPrestamoProducto.'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
        echo $datosJson;
        
        


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductosPrestamos = new TablaProductosPrestamos();
$activarProductosPrestamos -> mostrarTablaProductosPrestamos();
