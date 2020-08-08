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
      console.log(respuesta);
      var codigo = respuesta["cod_producto"];
      var estado_prestamo = respuesta["estado_prestamo"];

      /*=============================================
					  EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
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
          '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="' +
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
      );
    },
  });
});
