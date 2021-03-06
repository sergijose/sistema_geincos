<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Prestamo

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Prestamo</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">
      


      <div class="box-header with-border">
      <?php
      if ($_SESSION["perfil"] == "Administrador" ||$_SESSION["perfil"] == "Especial") {

      echo '<a href="crear-prestamo">

          <button class="btn btn-primary">

            Agregar Prestamo

          </button>


        </a>';
      }
        ?>

          <?php

          if (isset($_GET["fechaInicial"])) {

            echo '<a href="vistas/modulos/descargar-prestamo.php?prestamo=prestamo&fechaInicial=' . $_GET["fechaInicial"] . '&fechaFinal=' . $_GET["fechaFinal"] . '">';
          } else {

            echo '<a href="vistas/modulos/descargar-prestamo.php?prestamo=prestamo">';
          }

          ?>

          <button class="btn btn-success">Descargar reporte en Excel</button>

          </a>



        <button type="button" class="btn btn-default pull-right" id="daterange-btn">

          <span>
            <i class="fa fa-calendar"></i>

            <?php

            if (isset($_GET["fechaInicial"])) {

              echo $_GET["fechaInicial"] . " - " . $_GET["fechaFinal"];
            } else {

              echo 'Rango de fecha';
            }

            ?>
          </span>

          <i class="fa fa-caret-down"></i>

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <!--<th>Usuario</th>-->
              <th>Empleado</th>
              <th>Producto</th>
              <th>F_Prestamo</th>
              <th>F_Devolucion</th>
              <th>observacion_prestamo</th>
              <th>observacion_devolucion</th>
              <th style="width:10px">estado</th>
              <th style="width:10px">Acciones</th>

            </tr>

          </thead>

          <tbody>
            <?php




            if (isset($_GET["fechaInicial"])) {

              $fechaInicial = $_GET["fechaInicial"];
              $fechaFinal = $_GET["fechaFinal"];
            } else {

              $fechaInicial = null;
              $fechaFinal = null;
            }

            $respuesta = ControladorPrestamos::ctrRangoFechasPrestamos($fechaInicial, $fechaFinal);

            foreach ($respuesta as $key => $value) {

              echo '<tr>

             <td>' . ($key + 1) . '</td>';



              $itemUsuario = "id";
              $valorUsuario = $value["idusuario"];

              $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

              //echo '<td>' . $respuestaUsuario["nombre"] . '</td>';



              $itemEmpleado = "idempleado";
              $valorEmpleado = $value["idempleado"];
              $respuestaEmpleado = ControladorEmpleados::ctrMostrarEmpleados($itemEmpleado, $valorEmpleado);
              
              echo '<td>' . $respuestaEmpleado["nombres"]." ".$respuestaEmpleado["ape_pat"]." ".$respuestaEmpleado["ape_mat"].'</td>';
              
              $item = "id";
              $valor = $value["idproducto"];
              $order = "id";

              $respuestaProducto = ControladorProductos::ctrMostrarProductos($item, $valor, $order);

              echo '<td>' . $respuestaProducto["cod_producto"] . '</td>';
               echo '<td>' . $value["fecha_prestamo"] . '</td>
              <td>' . $value["fecha_devolucion"] . '</td>
              <td>' . $value["observacion_prestamo"] . '</td>
              <td>' . $value["observacion_devolucion"] . '</td>';

              if ($value["estado_prestamo"] == "PENDIENTE") {
                echo '<td><button class="btn btn-danger btn-xs" >' . $value["estado_prestamo"] . '</button></td>';
              } else {

                echo '<td><button class="btn btn-success btn-xs">' . $value["estado_prestamo"] . '</button></td>';
              }

              echo ' <td>

          <div class="btn-group">

            <button class="btn btn-info btn-xs btnImprimirPrestamo" idPrestamo="' . $value["id"] . '">

              <i class="fa fa-print"></i>

            </button>';
            if ($_SESSION["perfil"] == "Administrador" ||$_SESSION["perfil"] == "Especial" ) {

              if ($value["fecha_devolucion"] == null) {
                echo '<button class="btn btn-warning btn-xs btnEditarPrestamo" idPrestamo="' . $value["id"] . '" data-toggle="modal" data-target="#modalDevolverProducto" data-toggle="tooltip" title="Devolver Producto"><i class="fa fa-pencil"></i></button>';
              } else {
                echo '<button class="btn btn-warning btn-xs btnEditarPrestamo" idPrestamo="' . $value["id"] . '" data-toggle="modal" data-target="#modalDevolverProducto" data-toggle="tooltip" title="Devolver Producto" disabled><i class="fa fa-pencil" ></i></button>';
              }

              if ($value["estado_prestamo"] == "PENDIENTE") {
                echo '<button class="btn btn-danger btn-xs btnEliminarPrestamo" idPrestamo="' . $value["id"] . '" disabled><i class="fa fa-times"></i></button>';
              } else {
                echo '<button class="btn btn-danger btn-xs btnEliminarPrestamo" idPrestamo="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
              }
            }

              echo '</div> 

        </td>

      </tr>';
            }

            ?>


          </tbody>

        </table>

      </div>

    </div>


  </section>

</div>

<!--=====================================
MODAL REGISTRO DE DEVOLUCION
======================================-->

<div id="modalDevolverProducto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Devolver Producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA REGISTRAR LA FECHA DE DEVOLUCION -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="date" class="form-control input-lg" name="fechaDevolucion" required>

                <input type="hidden" name="idPrestamo" id="idPrestamo" name="idPrestamo">
                <input type="hidden" name="idProducto" id="idProducto" name="idProducto">

              </div>




            </div>
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-commenting-o"></i></span>

                <input type="text" class="form-control input-lg" name="observacionDevolucion" required>
              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

        <?php

        $devolverProducto = new ControladorPrestamos();
        $devolverProducto->ctrDevolverProducto();

        ?>

      </form>

    </div>

  </div>

</div>
<?php

$eliminarPrestamo = new ControladorPrestamos();
$eliminarPrestamo->ctrEliminarPrestamo();

?>

<!--==============================
PARA MENSAJE AL ESTAR SITUADO EN EL BOTON DEVOLVER
 ------------------------------ -->
<script>
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>