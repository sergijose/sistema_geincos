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

      Administrar productos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar productos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">

          Agregar producto

        </button>

        <a href="productos-cpu">

          <button class="btn btn-primary">

            Ver Detalle de CPU

          </button>
        </a>


      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Categoria</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Código</th>
              <th>Numero de Serie</th>
              <th>Estado Fisico</th>
              <th>Observaciones</th>
              <th>Disp.Prestamo</th>
              <th>Fecha_Registro</th>
              <th>Acciones</th>

            </tr>

          </thead>

        </table>
        <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">


      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">


  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">



            <!-- ENTRADA PARA SELECCIONAR MODELO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-md" id="nuevoModelo" name="nuevoModelo" required>

                  <option value="">Seleccionar Modelo</option>

                  <?php

                  $item = null;
                  $valor = null;


                  $modelo = ControladorModelos::ctrMostrarModelo($item, $valor);

                  foreach ($modelo as $key => $value) {

                    echo '<option value="' . $value["id"] . '">' . $value["categoria"] . "| " . $value["marca"] . "| " . $value["descripcion"] . '</option>';
                  }

                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL CÓDIGO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-md" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingrese Codigo" required>
                <input type="hidden" class="form-control input-md" name="creado_por" value="<?php echo $_SESSION["id"]; ?>" required>
              </div>

            </div>
            <!-- ENTRADA PARA EL NUMERO DE SERIE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-md" id="nuevoNumSerie" name="nuevoNumSerie" placeholder="Ingrese numero de serie">

              </div>

            </div>
            <!-- ENTRADA PARA EL ESTADO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-md" id="nuevoEstado" name="nuevoEstado" required>

                  <option value="">Seleccionar estado del producto</option>

                  <?php

                  $item = null;
                  $valor = null;



                  $estado = ControladorProductos::ctrMostrarEstadoFisicoProducto($item, $valor);

                  foreach ($estado as $key => $value) {


                    echo '<option value="' . $value["id"] . '">' . $value["descripcion"] . '</option>';
                  }

                  ?>

                </select>

              </div>

            </div>


            <!-- ENTRADA PARA ESTADO DE PRESTAMO DEL PRODUCTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-md" id="nuevoEstadoPrestamo" name="nuevoEstadoPrestamo" required>

                  <option value="">Seleccionar estado del prestamo</option>
                  <option value="DISPONIBLE">DISPONIBLE</option>
                  <option value="OCUPADO">OCUPADO</option>
                  <option value="NO APLICA">NO APLICA</option>
                  <option value="EN OFICINA">EN OFICINA</option>
                </select>

              </div>

            </div>
            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-clipboard"></i></span>

                <input type="text" class="form-control input-md" id="nuevaObservaciones" name="nuevaObservaciones" placeholder="Ingresar observaciones o notas">

              </div>

            </div>

            <!-- ENTRADA PARA IMAGEN CODIGO DE BARRAS DEL PRODUCTO 

  <div class="form-group">

<div class="input-group">
<input type="file" name="barcode1">
  <img id="barcode"  name="barcode" ></img>
 </input>  
</div> 

</div>-->


          </div>
        </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar producto</button>

        </div>

      </form>

      <?php

      $crearProducto = new ControladorProductos();
      $crearProducto->ctrCrearProducto();

      ?>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">


  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">



            <!-- ENTRADA PARA EDITAR  SELECCIONAR MODELO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-md" id="editarModelo" name="editarModelo" required>

                  <option value="">Seleccionar Modelo</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $modelo = ControladorModelos::ctrMostrarModelo($item, $valor);

                  foreach ($modelo as $key => $value) {

                    echo '<option value="' . $value["id"] . '">' . $value["categoria"] . "| " . $value["marca"] . "| " . $value["descripcion"] . '</option>';
                  }

                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL CÓDIGO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-md" id="editarCodigo" name="editarCodigo" placeholder="Ingrese Codigo" required>
                <!-- oculto el id del producto para poder editar -->
                <input type="hidden" id="id" name="id" require>
                <input type="hidden" class="form-control input-md" name="actualizado_por" value="<?php echo $_SESSION["id"]; ?>" required>


              </div>

            </div>
            <!-- ENTRADA PARA EL NUMERO DE SERIE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-md" id="editarNumSerie" name="editarNumSerie" placeholder="editar numero de serie">

              </div>

            </div>

            <!-- ENTRADA PARA EL ESTADO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-md" id="editarEstado" name="editarEstado" required>

                  <option value="">Seleccionar estado del producto</option>

                  <?php

                  $item = null;
                  $valor = null;



                  $estado = ControladorProductos::ctrMostrarEstadoFisicoProducto($item, $valor);

                  foreach ($estado as $key => $value) {


                    echo '<option value="' . $value["id"] . '">' . $value["descripcion"] . '</option>';
                  }

                  ?>

                </select>

              </div>

            </div>


            <!-- ENTRADA PARA ESTADO DE PRESTAMO DEL PRODUCTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-md" id="editarEstadoPrestamo" name="editarEstadoPrestamo" required>

                  <option value="">Seleccionar estado del prestamo</option>
                  <option value="DISPONIBLE">DISPONIBLE</option>
                  <option value="OCUPADO">OCUPADO</option>
                  <option value="NO APLICA">NO APLICA</option>
                  <option value="EN OFICINA">EN OFICINA</option>
                </select>

              </div>

            </div>

                      <!-- ENTRADA PARA LA DESCRIPCIÓN -->

            <div class="form-group">

<div class="input-group">

  <span class="input-group-addon"><i class="fa fa-clipboard"></i></span>

  <input type="text" class="form-control input-md" id="editarObservaciones" name="editarObservaciones" placeholder="Ingresar descripción o notas">

</div>

</div>


          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Actualizar producto</button>

        </div>

      </form>

      <?php

      $editarProducto = new ControladorProductos();
      $editarProducto->ctrEditarProducto();

      ?>

    </div>

  </div>

</div>
<?php

$eliminarProducto = new ControladorProductos();
$eliminarProducto->ctrEliminarProducto();

?>