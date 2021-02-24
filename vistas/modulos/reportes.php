<?php
if ($_SESSION["perfil"] == "Visitante") {

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
                  <th>Num Documento</th>
                  <th>Cod Producto</th>

                </tr>

              </thead>

              <tbody>

                <?php
                $item = "estado_prestamo";
                $valor = "PENDIENTE";
                $prestamosEmpleado = ControladorPrestamos::ctrMostrarPrestamosPendiente($item, $valor);


                foreach ($prestamosEmpleado as $key => $value) {

                  echo ' <tr>
 
                     <td>' . ($key + 1) . '</td>';

                  $item = "idempleado";
                  $valor = $value["idempleado"];
                  $EmpleadoPrestamo = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

                  echo '<td class="text-uppercase">' . $EmpleadoPrestamo["nombres"] . " " . $EmpleadoPrestamo["ape_pat"] . " " . $EmpleadoPrestamo["ape_mat"] . '</td>';
                  echo '<td class="text-uppercase">' . $EmpleadoPrestamo["num_documento"] . '</td>';

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



          <div class="col-md-6 col-xs-12 ">
            <h3 class="box-title">STOCK DE PRODUCTOS</h3>
            <table class="table table-bordered table-striped dt-responsive" width="100%">

              <thead>

                <tr>

                  <th style="width:10px">#</th>
                  <th>CATEGORIA</th>
                  <th>MARCA</th>
                  <th>STOCK</th>

                </tr>

              </thead>

              <tbody>

                <?php

                $productosTotal = ControladorProductos::ctrMostrarTotalProductos();



                foreach ($productosTotal  as $key => $value) {
                  echo ' <tr>
 
                     <td>' . ($key + 1) . '</td>
 
                     <td class="text-uppercase">' . $value["CATEGORIA"] . '</td>
                     <td class="text-uppercase">' . $value["MARCA"] . '</td>

                    <td>' . $value["STOCK"] . '</td>
                     
 
                   </tr>';
                }

                ?>

              </tbody>

            </table>

          </div>
          <!--  FIN DE PRIMERA FILA-->






        </div>

        
        <div class="box-header with-border box box-success">
        </div>

        <!--  SEGUNDA FILA DE REPORTES-->

        <div class="row">
        

          <div class="col-md-4 col-xs-12">
            <h3 class="box-title">ESTADOS DE AUDIFONOS</h3>
            <table class="table table-bordered table-striped dt-responsive" width="100%">

              <thead>

                <tr>

                  <th style="width:10px">#</th>
                  <th>CATEGORIA</th>
                  <th>MARCA</th>
                  <th>ESTADO</th>
                  <th>TOTAL</th>

                </tr>

              </thead>

              <tbody>

                <?php
                $categoria = "AUDIFONO";

                $productosEstados = ControladorProductos::ctrMostrarTotalProductosPorEstados($categoria);


                foreach ($productosEstados  as $key => $value) {

                  echo ' <tr>
 
                     <td>' . ($key + 1) . '</td>
 
                   
                     <td class="text-uppercase">' . $value["CATEGORIA"] . '</td>
                     <td class="text-uppercase">' . $value["MARCA"] . '</td>
                     <td class="text-uppercase">' . $value["ESTADO"] . '</td>

                    <td>' . $value["CANTIDAD"] . '</td>
                     
 
                   </tr>';
                }

                ?>

              </tbody>

            </table>




          </div>

          <div class="col-md-4 col-xs-12">
            <h3 class="box-title">ESTADOS DE CPU</h3>
            <table class="table table-bordered table-striped dt-responsive" width="100%">

              <thead>

                <tr>

                  <th style="width:10px">#</th>
                  <th>CATEGORIA</th>
                  <th>MARCA</th>
                  <th>ESTADO</th>
                  <th>TOTAL</th>

                </tr>

              </thead>

              <tbody>

                <?php
                $categoria = "CPU";

                $productosEstados = ControladorProductos::ctrMostrarTotalProductosPorEstados($categoria);


                foreach ($productosEstados  as $key => $value) {

                  echo ' <tr>
 
                     <td>' . ($key + 1) . '</td>
 
                   
                     <td class="text-uppercase">' . $value["CATEGORIA"] . '</td>
                     <td class="text-uppercase">' . $value["MARCA"] . '</td>
                     <td class="text-uppercase">' . $value["ESTADO"] . '</td>

                    <td>' . $value["CANTIDAD"] . '</td>
                     
 
                   </tr>';
                }

                ?>

              </tbody>

            </table>




          </div>

          <div class="col-md-4 col-xs-12">
            <h3 class="box-title">ESTADOS DE MONITOR</h3>
            <table class="table table-bordered table-striped dt-responsive" width="100%">

              <thead>

                <tr>

                  <th style="width:10px">#</th>
                  <th>CATEGORIA</th>
                  <th>MARCA</th>
                  <th>ESTADO</th>
                  <th>TOTAL</th>

                </tr>

              </thead>

              <tbody>

                <?php
                $categoria = "MONITOR";

                $productosEstados = ControladorProductos::ctrMostrarTotalProductosPorEstados($categoria);


                foreach ($productosEstados  as $key => $value) {

                  echo ' <tr>
 
                     <td>' . ($key + 1) . '</td>
 
                   
                     <td class="text-uppercase">' . $value["CATEGORIA"] . '</td>
                     <td class="text-uppercase">' . $value["MARCA"] . '</td>
                     <td class="text-uppercase">' . $value["ESTADO"] . '</td>

                    <td>' . $value["CANTIDAD"] . '</td>
                     
 
                   </tr>';
                }

                ?>

              </tbody>

            </table>




          </div>

        </div>

        <div class="box-header with-border box box-success">
        </div>

          <!--  TERCERA FILA DE REPORTES-->

          <div class="row">
        

        <div class="col-md-4 col-xs-12">
          <h3 class="box-title">ESTADOS DE PRESTAMO DE AUDIFONOS</h3>
          <table class="table table-bordered table-striped dt-responsive" width="100%">

            <thead>

              <tr>

                <th style="width:10px">#</th>
                <th>CATEGORIA</th>
                <th>MARCA</th>
                <th>ESTADO PRESTAMO</th>
                <th>TOTAL</th>

              </tr>

            </thead>

            <tbody>

              <?php
              $categoria = "AUDIFONO";

              $productosEstadosPrestamo = ControladorProductos::ctrMostrarTotalProductosPorEstadoDePrestamo($categoria);


              foreach ($productosEstadosPrestamo  as $key => $value) {

                echo ' <tr>

                   <td>' . ($key + 1) . '</td>

                 
                   <td class="text-uppercase">' . $value["CATEGORIA"] . '</td>
                   <td class="text-uppercase">' . $value["MARCA"] . '</td>
                   <td class="text-uppercase">' . $value["estado_prestamo"] . '</td>

                  <td>' . $value["STOCK"] . '</td>
                   

                 </tr>';
              }

              ?>

            </tbody>

          </table>




        </div>

        <div class="col-md-4 col-xs-12">
          <h3 class="box-title">ESTADO DE PRESTAMO DE CPU</h3>
          <table class="table table-bordered table-striped dt-responsive" width="100%">

            <thead>

              <tr>

                <th style="width:10px">#</th>
                <th>CATEGORIA</th>
                <th>MARCA</th>
                <th>ESTADO PRESTAMO</th>
                <th>TOTAL</th>

              </tr>

            </thead>

            <tbody>

              <?php
              $categoria = "CPU";

              $productosEstadosPrestamo  = ControladorProductos::ctrMostrarTotalProductosPorEstadoDePrestamo($categoria);


              foreach ($productosEstadosPrestamo   as $key => $value) {

                echo ' <tr>

                   <td>' . ($key + 1) . '</td>

                 
                   <td class="text-uppercase">' . $value["CATEGORIA"] . '</td>
                   <td class="text-uppercase">' . $value["MARCA"] . '</td>
                   <td class="text-uppercase">' . $value["estado_prestamo"] . '</td>

                  <td>' . $value["STOCK"] . '</td>
                   

                 </tr>';
              }

              ?>

            </tbody>

          </table>




        </div>

        <div class="col-md-4 col-xs-12">
          <h3 class="box-title">ESTADOS DE PRESTAMO DE MONITOR</h3>
          <table class="table table-bordered table-striped dt-responsive" width="100%">

            <thead>

              <tr>

                <th style="width:10px">#</th>
                <th>CATEGORIA</th>
                <th>MARCA</th>
                <th>ESTADO PRESTAMO</th>
                <th>TOTAL</th>

              </tr>

            </thead>

            <tbody>

              <?php
              $categoria = "MONITOR";

              $productosEstadosPrestamo  = ControladorProductos::ctrMostrarTotalProductosPorEstadoDePrestamo($categoria);


              foreach ($productosEstadosPrestamo   as $key => $value) {

                echo ' <tr>

                   <td>' . ($key + 1) . '</td>

                 
                   <td class="text-uppercase">' . $value["CATEGORIA"] . '</td>
                   <td class="text-uppercase">' . $value["MARCA"] . '</td>
                   <td class="text-uppercase">' . $value["estado_prestamo"] . '</td>

                  <td>' . $value["STOCK"] . '</td>
                   

                 </tr>';
              }

              ?>

            </tbody>

          </table>




        </div>

      </div>








      </div>



  </section>

</div>