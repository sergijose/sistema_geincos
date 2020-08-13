//esto nos servira para comprobar si nuestro json esta bien estructurado
$.ajax({
  url: "ajax/datatable-prestamos.ajax.php",
  success: function (respuesta) {
    //console.log("respuesta", respuesta);
  },
});

$(".tablaPrestamos").DataTable({
  ajax: "ajax/datatable-prestamos.ajax.php",
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
AGREGANDO PRODUCTOS PARA EL PRESTAMO DESDE LA TABLA
=============================================*/
$(".tablaPrestamos tbody").on("click", "button.agregarProducto", function () {
  var idProducto = $(this).attr("idProducto");

  $(this).removeClass("btn-primary agregarProducto");

  $(this).addClass("btn-default");

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
     
      var codigo = respuesta["cod_producto"];
      var estado_prestamo = respuesta["estado_prestamo"];

      /*=============================================
					  EVITAR AGREGAR PRODUTO CUANDO EL ESTADO DEL PRESTAMO ESTÁ OCUPADO
       =============================================*/

      if (estado_prestamo == "OCUPADO") {
        swal({
          title: "Este producto esta ocupado",
          type: "error",
          confirmButtonText: "¡Cerrar!",
        });

        $("button[idProducto='" + idProducto + "']").addClass(
          "btn-primary agregarProducto"
        );

        return;
      }

      $(".nuevoProducto").append(
        '<div class="row" style="padding:5px 15px">' +
          "<!-- Codigo del producto -->" +
          '<div class="col-xs-6" style="padding-right:0px">' +
          '<div class="input-group">' +
          '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs  quitarProducto" idProducto="' +
          idProducto +
          '"><i class="fa fa-times"></i></button></span>' +
          '<input type="text" class="form-control nuevoCodigoProducto" idProducto="' +
          idProducto +
          '" name="agregarProducto" value="' +
          codigo +
          '" readonly required>' +
          "</div>" +
          "</div>" +
          "<!-- Estado del producto -->" +
          '<div class="col-xs-6 estadoProducto" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<span class="input-group-addon"><i class="fa fa-thumbs-o-up"></i></span>' +
          '<input type="text" class="form-control nuevoEstadoProducto"name="nuevoEstadoProducto" value="' +
          estado_prestamo +
          '" readonly required>' +
          "</div>" +
          "</div>" +
          "</div>"
      )
      listarProductos();
      localStorage.removeItem("quitarProducto");
      
    }
    
  })
  
});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaPrestamos").on("draw.dt", function(){

	if(localStorage.getItem("quitarProducto") != null){

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for(var i = 0; i < listaIdProductos.length; i++){

			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');

		}


	}


})

/*=============================================
QUITAR PRODUCTOS DEL PRESTAMO Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto=[];
localStorage.removeItem("quitarProducto");
$(".formularioPrestamo").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");
/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
  =============================================*/
    if(localStorage.getItem("quitarProducto")== null){
      idQuitarProducto = [];

    }else{
      idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

    }
    idQuitarProducto.push({"idProducto":idProducto});
    localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	listarProductos();

})


/*=============================================
AGREGANDO PRODUCTOS DESDE EL BOTÓN PARA DISPOSITIVOS
=============================================*/

var numProducto = 0;

$(".btnAgregarProducto").click(function(){
  numProducto ++;
	

	var datos = new FormData();
	datos.append("traerProductos", "ok");

	$.ajax({

		url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      	    
      	    	$(".nuevoProducto").append(

                '<div class="row" style="padding:5px 15px">' +
                "<!-- Codigo del producto -->" +
                '<div class="col-xs-6" style="padding-right:0px">' +
                '<div class="input-group">' +
                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto=" "'+ 
                '"><i class="fa fa-times"></i></button></span>' +
                '<select class="form-control nuevoCodigoProducto"  id="producto'+numProducto+'" idProducto name="nuevaDescripcionProducto" required>'+

	              '<option>Seleccione el producto</option>'+

	              '</select>'+  
                "</div>" +
                "</div>" +
                "</div>");


	        // AGREGAR LOS PRODUCTOS AL SELECT 

	         respuesta.forEach(funcionForEach);

	         function funcionForEach(item, index){

            if (item.estado_prestamo != "OCUPADO") {

		         	$("#producto"+numProducto).append(

						'<option idProducto="'+item.id+'" value="'+item.cod_producto+'">'+item.cod_producto+'</option>'
		         	)
            }
           
		         
		         	        

	         }
          
        	


      	}

	})
  
})

/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioPrestamo").on("change", "select.nuevoCodigoProducto", function(){

  var codigoProducto = $(this).val();

  var nuevaDescripcionProducto = $(this).parent().parent().parent().children().children().children(".nuevoCodigoProducto");
	
	var datos = new FormData();
    datos.append("codigoProducto", codigoProducto);


	  $.ajax({

     	url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      	    //console.log(respuesta);
      	    $(nuevaDescripcionProducto).attr("idProducto", respuesta["id"]);	  
  	      // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductos()

      	}

      })
})










      



/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){

	var listaProductos = [];

	var codigo = $(".nuevoCodigoProducto");


	for(var i = 0; i < codigo.length; i++){

		listaProductos.push({ "id" : $(codigo[i]).attr("idProducto"), 
							  "codigo" : $(codigo[i]).val()})

	}
console.log(listaProductos);
  $("#listaProductos").val(JSON.stringify(listaProductos)); 
  

}