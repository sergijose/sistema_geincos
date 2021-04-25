/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/

$.ajax({
	url: "ajax/datatable-productos.ajax.php",
	success: function (respuesta) {
		//	console.log("respuesta", respuesta);
	},
});

var perfilOculto = $("#perfilOculto").val();


$(".tablaProductos").DataTable({
	ajax: "ajax/datatable-productos.ajax.php?perfilOculto=" + perfilOculto,
	deferRender: true,
	retrieve: true,
	processing: true,
	language: {
		sProcessing: "Procesando...",
		sLengthMenu: "Mostrar _MENU_ registros",
		sZeroRecords: "No se encontraron resultados",
		sEmptyTable: "Ningún dato disponible en esta tabla",
		sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
		sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
		sInfoPostFix: "",
		sSearch: "Buscar:",
		sUrl: "",
		sInfoThousands: ",",
		sLoadingRecords: "Cargando...",
		oPaginate: {
			sFirst: "Primero",
			sLast: "Último",
			sNext: "Siguiente",
			sPrevious: "Anterior",
		},
		oAria: {
			sSortAscending: ": Activar para ordenar la columna de manera ascendente",
			sSortDescending:
				": Activar para ordenar la columna de manera descendente",
		},
	},
});

/*=============================================
REVISAR SI EL CODIGO DEL PRODUCTO YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoCodigo").change(function(){

	$(".alert").remove();


	var codigo = $(this).val();

	var datos = new FormData();
	datos.append("validarCodigo", codigo);

	 $.ajax({
	    url:"ajax/productos.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoCodigo").parent().after('<div class="alert alert-warning">Este codigo de producto  ya existe en la base de datos</div>');

	    		$("#nuevoCodigo").val("");

	    	}

	    }

	})
})

/*=============================================
REVISAR SI EL NUMERO DE SERIE YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoNumSerie").change(function(){

	$(".alert").remove();
	var serie = $(this).val();

	var datos = new FormData();
	datos.append("validarSerie", serie);

	 $.ajax({
	    url:"ajax/productos.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoNumSerie").parent().after('<div class="alert alert-warning">Este numero de serie  ya existe en la base de datos</div>');

	    		$("#nuevoNumSerie").val("");

	    	}

	    }

	})
})


/*=============================================
EDITAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function () {
	var idProducto = $(this).attr("idProducto");

	var datos = new FormData();
	datos.append("idProducto", idProducto);

	$.ajax({
		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			var datosModelo = new FormData();
			datosModelo.append("idModelo", respuesta["idmodelo"]);

			$.ajax({
				url: "ajax/modelos.ajax.php",
				method: "POST",
				data: datosModelo,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (respuesta) {
					
					$("#editarModelo").val(respuesta["id"]);
					//  $("#editarModelo").html(respuesta["descripcion"]);
				},
			});
			var datosEstado = new FormData();
			datosEstado.append("idEstado", respuesta["idestado"]);

			$.ajax({
				url: "ajax/estados.ajax.php",
				method: "POST",
				data: datosEstado,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (respuesta) {
					;
					$("#editarEstado").val(respuesta["id"]);
					// $("#editarEstado").html(respuesta["descripcion"]);
				},
			});

			$("#editarCodigo").val(respuesta["cod_producto"]);
			$("#editarNumSerie").val(respuesta["num_serie"]);

			$("#editarEstadoPrestamo").val(respuesta["estado_prestamo"]);
			//para editar producto -capturando el id
			$("#id").val(respuesta["id"]);
			
		},
	});
});

/*=============================================
ELIMINAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on(
	"click",
	"button.btnEliminarProducto",
	function () {
		var idProducto = $(this).attr("idProducto");
		swal({
			title: "¿Está seguro de borrar el producto?",
			text: "¡Si no lo está puede cancelar la accíón!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			cancelButtonText: "Cancelar",
			confirmButtonText: "Si, borrar producto!",
		}).then(function (result) {
			if (result.value) {
				window.location =
					"index.php?ruta=productos&idProducto=" +
					idProducto;
			}
		});
	}
);



//para llenar atributo del svg el codigo del producto
$("#nuevoCodigo").change(function(){
	var codigo = $(this).val();
	$("#barcode").attr("codigobarras", codigo);
	JsBarcode("#barcode",codigo.toString(),{
		format:"CODE39",
		lineColor: "#000",
		width:2,
		height:80,
		displayValue:true
		
	})

})


//var codigo_barras=document.querySelectorAll("barcodetabla");
//console.log("barras",codigo_barras);



