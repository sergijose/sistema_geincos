<?php

require_once "../../../controladores/prestamos.controlador.php";
require_once "../../../modelos/prestamos.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/modelos.controlador.php";
require_once "../../../modelos/modelos.modelo.php";

require_once "../../../controladores/categorias.controlador.php";
require_once "../../../modelos/categorias.modelo.php";

require_once "../../../controladores/marcas.controlador.php";
require_once "../../../modelos/marcas.modelo.php";

class imprimirPrestamo{

public $id;

public function traerImpresionPrestamo(){

//TRAEMOS LA INFORMACIÓN DEL PRESTAMO

$itemPrestamo = "id";
$valorPrestamo = $this->id;
$respuestaPrestamo = ControladorPrestamos::ctrMostrarPrestamos($itemPrestamo, $valorPrestamo);

$fechaPrestamo = substr($respuestaPrestamo["fecha_prestamo"],0,-8);
$fechaDevolucion = substr($respuestaPrestamo["fecha_devolucion"],0,-8);
$observacionPrestamo = $respuestaPrestamo["observacion_prestamo"];
$observacionDevolucion = $respuestaPrestamo["observacion_devolucion"];
$estadoPrestamo = $respuestaPrestamo["estado_prestamo"];
$empleado = $respuestaPrestamo["idempleado"];
//TRAEMOS LA INFORMACIÓN DEL USUARIO
$itemUsuario = "id";
$valorUsuario = $respuestaPrestamo["idusuario"];

$respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

//TRAEMOS LA INFORMACIÓN DEL PRODUCTO
$orden="id";
$itemProducto = "id";
$valorProducto = $respuestaPrestamo["idproducto"];

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto,$orden);

//TRAEMOS LA INFORMACIÓN DEL MODELO
$itemModelo = "id";
$valorModelo = $respuestaProducto["idmodelo"];

$respuestaModelo = ControladorModelos::ctrMostrarModelo($itemModelo, $valorModelo);


//TRAEMOS LA INFORMACIÓN DE LA CATEGORIA
$itemCategoria = "id";
$valorCategoria = $respuestaModelo["idcategoria"];

$respuestaCategoria = ControladorCategorias::ctrMostrarCategorias($itemCategoria, $valorCategoria);

//TRAEMOS LA INFORMACIÓN DE LA MARCA
$itemMarca = "id";
$valorMarca = $respuestaModelo["idmarca"];

$respuestaMarca = ControladorMarcas::ctrMostrarMarca($itemMarca, $valorMarca);


//TRAEMOS LA INFORMACIÓN DEL CLIENTE


//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:150px"><img src="images/logo-geincos.png"></td>

			<td style="background-color:white; width:140px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					Dirección:Jr camana #780 of 611 lima lima
					

				</div>

			</td>

			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					serviciosgenerales@geincos.com
					<br>
					Teléfono:943 540 293	
								
					
				</div>
				
			</td>

			<td style="background-color:white; width:110px; text-align:center; color:red"><br><br>FORMATO DE PRESTAMO<br></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');


// ---------------------------------------------------------


$bloque2 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:370px">

				Empleado: $empleado

			</td>

			<td style="border: 1px solid #666; background-color:white; width:170px; ">
			
				Fecha prestamo  :$fechaPrestamo

			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:370px">Usuario: $respuestaUsuario[nombre]</td>
			<td style="border: 1px solid #666; background-color:white; width:170px">Fecha devolucion:$fechaDevolucion</td>

		</tr>

		<tr>

			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

		

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');


$bloque3 = <<<EOF


		<table>
	
	<tr>
		
		<td style="width:540px">Descripcion del Producto</td>
	
	</tr>

		</table>

		<table>

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:120px; text-align:center">CATEGORIA</td>
		<td style="border: 1px solid #666; background-color:white; width:140px; text-align:center">MODELO</td>
		<td style="border: 1px solid #666; background-color:white; width:140px; text-align:center">MARCA</td>
		<td style="border: 1px solid #666; background-color:white; width:140px; text-align:center">COD PRODUCTO</td>
		</tr>

		</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------
$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:120px; text-align:center">$respuestaCategoria[descripcion]</td>
		<td style="border: 1px solid #666; background-color:white; width:140px; text-align:center">$respuestaModelo[descripcion]</td>
		<td style="border: 1px solid #666; background-color:white; width:140px; text-align:center">$respuestaMarca[descripcion]</td>
		<td style="border: 1px solid #666; background-color:white; width:140px; text-align:center">$respuestaProducto[cod_producto]</td>

		</tr>
		<tr>

		<td style="width:540px"><img src="images/back.jpg"></td>
	
	</tr>
	

	</table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');



// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table >
		
		<tr>
			
			<td style="width:540px;">Observaciones</td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:540px">

				Inicio del Prestamo: $observacionPrestamo

			</td>
		</tr>

		<tr>
			<td style="border: 1px solid #666; background-color:white; width:540px;">
			
				Final del Prestamo: $observacionDevolucion

			</td>

		</tr>
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:540px;">
		
			Estado del Prestamo: $estadoPrestamo

		</td>

	</tr>

		
	

	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');




//SALIDA DEL ARCHIVO 

$pdf->Output('prestamo.pdf', 'D');

}

}

$factura = new imprimirPrestamo();
$factura -> id = $_GET["id"];
$factura -> traerImpresionPrestamo();

?>