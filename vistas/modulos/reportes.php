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

          <div class="col-md-12 col-xs-12">
            <h3 class="box-title">PERSONAL CON PRESTAMOS PENDIENTES</h3>
            <table class="table-hover dt-responsive tablas " width="100%">

              <thead>

                <tr>

                  <th style="width:10px">#</th>
                  <th>Empleado</th>
                  <th>Productos</th>
                  <th>Num Documento</th>

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
                  
                  $productos=json_decode($value["productos"],true);
               echo '<td>';
                foreach($productos as $key=>$valueProductos){
 
                 echo ($valueProductos["codigo"].'<br>');
                }
                echo '</td>';
                  echo '<td class="text-uppercase">' . $EmpleadoPrestamo["num_documento"] . '</td>';

                  echo ' </tr>';
                }

                ?>

              </tbody>

            </table>


            <div class="box-header with-border box box-success">
        </div>


          </div>
         


          <div class="col-lg-12 col-xs-12 ">
    <h3 class="box-title">ESTADO DE PRESTAMO DE PRODUCTOS</h3>
    <table class="table-hover   dt-responsive tablas" width="100%">

      <thead>

        <tr>

          <th style="width:10px">#</th>
          <th>CATEGORIA</th>
          <th>MARCA</th>
          <th>MODELO</th>
          <th>OCUPADO</th>
          <th>DISPONIBLE PRESTAMO</th>
          <th>NO APLICA PRESTAMO</th>
          <th >TOTAL</th>

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
                     <td class="text-uppercase">' . $value["MODELO"] . '</td>
                     <td>' . $value["OCUPADO"] . '</td>
                     <td>' . $value["LIBRE"] . '</td>
                     <td>' . $value["NO APLICA"] . '</td>
                    <td>' . $value["TOTAL"] . '</td>
                   
                   
                     
 
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
        

        <div class="col-lg-12 col-xs-12">
    <h3 class="box-title">ESTADO FISICO DE PRODUCTOS</h3>
    <table class="table-hover   dt-responsive tablas" width="100%">

      <thead>

        <tr>

          <th style="width:10px">#</th>
          <th>CATEGORIA</th>
          <th>MARCA</th>
          <th>MODELO</th>
          <th>OPERATIVOS</th>
          <th>MALOGRADOS</th>
          <th>REPARACION INTERNA</th>
          <th>REPARACION GARANTIA</th>
          <th>DSCTO POR MAL USO</th>
          <th>TOTAL</th>

        </tr>

      </thead>

      <tbody>

        <?php


        $productosEstados = ControladorProductos::ctrMostrarTotalProductosPorEstados();


        foreach ($productosEstados  as $key => $value) {

          echo ' <tr>

                   <td>' . ($key + 1) . '</td>

                 
                   <td class="text-uppercase">' . $value["CATEGORIA"] . '</td>
                   <td class="text-uppercase">' . $value["MARCA"] . '</td>
                   <td class="text-uppercase">' . $value["MODELO"] . '</td>
                   <td>' . $value["OPERATIVO"] . '</td>
                   <td>' . $value["MALOGRADO"] . '</td>
                   <td>' . $value["REPARACION_INTERNA"] . '</td>
                    <td>' . $value["REPARACION_GARANTIA"] . '</td>
                    <td>' . $value["DESCUENTO_MAL_USO"] . '</td>
                  <td class="text-uppercase">' . $value["TOTAL"] . '</td>
                   

                 </tr>';
        }

        ?>

      </tbody>

    </table>




  </div>

        

 <div class="col-md-6 col-xs-12">
             
             <?php
 
             include "inicio/productos-sistema-operativo.php";
 
             ?>
 
            </div>

            </div>

        

      

      </div>

     





      </div>



  </section>

</div>