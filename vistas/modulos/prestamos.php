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

        <a href="crear-prestamo">

          <button class="btn btn-primary">

            Agregar Prestamo

          </button>

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
              <th>Usuario</th>
              <th>Producto</th>
              <th>Empleado</th>
              <th>Fecha_Prestamo</th>
              <th>Fecha_Devolucion</th>
              <th>Comentario</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>
            <?php


            $item=null;
            $valor=null;
            $respuesta = ControladorPrestamos::ctrMostrarPrestamos($item, $valor);

            foreach ($respuesta as $key => $value) {

              echo '<tr>

             <td>' . ($key + 1) . '</td>';


              $itemUsuario = "id";
              $valorUsuario = $value["idusuario"];

              $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

              echo '<td>' . $respuestaUsuario["nombre"] . '</td>';
             
//str_replace( str_split('{}[])""'),"",$value["producto"])
              echo '<td>' .str_replace( str_split('{}[])""'),"",$value["idproducto"]). '</td>
              
              <td>' . $value["idempleado"]. '</td>

              <td>' . $value["fecha_prestamo"]. '</td>
              <td>' . $value["fecha_devolucion"]. '</td>
              <td>' . $value["observaciones"]. '</td>

        <td>

          <div class="btn-group">

            <a class="btn btn-success" >xml</a>
              
            <button class="btn btn-info btnImprimirFactura" codigoVenta="">

              <i class="fa fa-print"></i>

            </button>';

             

                echo '<button class="btn btn-warning btnEditarPrestamo" idPrestamo="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

            <button class="btn btn-danger btnEliminarVenta" idVenta=""><i class="fa fa-times"></i></button>';
              

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