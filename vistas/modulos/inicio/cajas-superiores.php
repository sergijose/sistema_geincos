<?php

$item = null;
$valor = null;
$orden = "id";

$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
$totalUsuarios = count($usuarios);

$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
$totalCategorias = count($categorias);

$empleados = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);
$totalEmpleados = count($empleados);

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
$totalProductos = count($productos);

?>




<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-green">

    <div class="inner">

      <h3><?php echo number_format($totalCategorias); ?></h3>

      <p>Categorías</p>

    </div>

    <div class="icon">

      <i class="ion ion-clipboard"></i>

    </div>

    <a href="categorias" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">

    <div class="inner">

      <h3><?php echo number_format($totalEmpleados); ?></h3>

      <p>Empleados</p>

    </div>

    <div class="icon">

      <i class="ion ion-person-add"></i>

    </div>

    <a href="empleados" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-red">

    <div class="inner">

      <h3><?php echo number_format($totalProductos); ?></h3>

      <p>Productos</p>

    </div>

    <div class="icon">

      <i class="ion ion-ios-cart"></i>

    </div>

    <a href="productos" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-green">

    <div class="inner">

      <h3><?php echo number_format($totalUsuarios); ?></h3>

      <p>Usuarios</p>

    </div>

    <div class="icon">

      <i class="ion ion-ios-person-outline"></i>

    </div>

    <a href="usuarios" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>





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
          <th>UBICADO EN OFICINA</th>
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
                     <td>' . $value["EN OFICINA"] . '</td>
                    <td>' . $value["TOTAL"] . '</td>
                   
                   
                     
 
                   </tr>';
        }

        ?>

      </tbody>

    </table>

  </div>
  

