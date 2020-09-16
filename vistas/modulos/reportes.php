<?php
if($_SESSION["perfil"] == "Visitante" ){

echo '<script>

  window.location = "inicio";

</script>';

return;

}

?>
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Reportes de Prestamos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Reportes de Prestamos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border box box-success">


      </div>

      <div class="box-body">

        <div class="row">

          <div class="col-md-6 col-xs-12">
            <h3 class="box-title">Lista de personal que tienen prestamos pendientes</h3>
            <table class="table table-bordered table-striped dt-responsive tablas " width="100%">

              <thead>

                <tr>

                  <th style="width:10px">#</th>
                  <th>Empleado</th>
                  <th>Producto</th>

                </tr>

              </thead>

              <tbody>

                <?php
                $item = "estado_prestamo";
                $valor = "PENDIENTE";
                $prestamosEmpleado = ControladorPrestamos::ctrMostrarPrestamosPendiente($item, $valor);


                foreach ($prestamosEmpleado as $key => $value) {

                  echo ' <tr>
 
                     <td>' . ($key + 1) . '</td>
 
                     <td class="text-uppercase">' . $value["idempleado"] . '</td>';

                  $item2 = "id";
                  $valor2 = $value["idproducto"];
                  $order = "id";

                  $respuestaProducto = ControladorProductos::ctrMostrarProductos($item2, $valor2, $order);

                  echo '<td>' . $respuestaProducto["cod_producto"] . '</td>
                     
 
                   </tr>';
                }

                ?>

              </tbody>

            </table>




          </div>



          <div class="col-md-2 col-xs-12 ">
            <h3 class="box-title">Cantidad de productos</h3>
            <table class="table table-bordered table-striped dt-responsive" width="100%">

              <thead>

                <tr>

                  <th style="width:10px">#</th>
                  <th>CATEGORIA</th>
                  <th>TOTAL</th>

                </tr>

              </thead>

              <tbody>

                <?php
                $item = null;
                $valor = null;
                $productosTotal = ControladorProductos::ctrMostrarTotalProductos($item, $valor);


                foreach ($productosTotal  as $key => $value) {

                  echo ' <tr>
 
                     <td>' . ($key + 1) . '</td>
 
                     <td class="text-uppercase">' . $value["descripcion"] . '</td>

                    <td>' . $value["total"] . '</td>
                     
 
                   </tr>';
                }

                ?>

              </tbody>

            </table>

          </div>


          <div class="col-md-2 col-xs-12 ">
            <h3 class="box-title">Total productos ocupados</h3>
            <table class="table table-bordered table-striped dt-responsive" width="100%">

              <thead>

                <tr>

                  <th style="width:10px">#</th>
                  <th>CATEGORIA</th>
                  <th>TOTAL</th>

                </tr>

              </thead>

              <tbody>

                <?php
                $item = "estado_prestamo";
                $valor = "OCUPADO";
                $productosOcupados = ControladorProductos::ctrMostrarTotalProductos($item, $valor);


                foreach ($productosOcupados  as $key => $value) {

                  echo ' <tr>
 
                     <td>' . ($key + 1) . '</td>
 
                     <td class="text-uppercase">' . $value["descripcion"] . '</td>

                    <td>' . $value["total"] . '</td>
                     
 
                   </tr>';
                }

                ?>

              </tbody>

            </table>




          </div>

          <div class="col-md-2 col-xs-12 ">
            <h3 class="box-title">Total productos Libres</h3>
            <table class="table table-bordered table-striped dt-responsive" width="100%">

              <thead>

                <tr>

                  <th style="width:10px">#</th>
                  <th>CATEGORIA</th>
                  <th>TOTAL</th>

                </tr>

              </thead>

              <tbody>

                <?php
                $item = "estado_prestamo";
                $valor = "DISPONIBLE";
                $productosLibres = ControladorProductos::ctrMostrarTotalProductos($item, $valor);


                foreach ($productosLibres  as $key => $value) {

                  echo ' <tr>
 
                     <td>' . ($key + 1) . '</td>
 
                     <td class="text-uppercase">' . $value["descripcion"] . '</td>

                    <td>' . $value["total"] . '</td>
                     
 
                   </tr>';
                }

                ?>

              </tbody>

            </table>




          </div>


        </div>

      

  </section>

</div>