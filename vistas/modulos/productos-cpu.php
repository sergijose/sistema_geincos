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

      Administrar detalles de productos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar detalles de productos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProductoCpu">

          Agregar informacion

        </button>




      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaProductosCpu" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Codigo</th>
              <th>Tipo Disco</th>
              <th>Tamaño Disco</th>
              <th>Tipo Ram</th>
              <th>Tamaño Ram</th>
              <th>Procesador</th>
              <th>Sistema Operativo</th>
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

<div id="modalAgregarProductoCpu" class="modal fade" role="dialog">


  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar informacion del CPU</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">



            <!-- ENTRADA PARA SELECCIONAR CODIGO DE PRODUCTO DE LA CATEGORIA CPU -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-md" id="nuevoCodProductoCpu" name="nuevoCodProductoCpu" required>

                  <option value="">Seleccionar Codigo CPU</option>

                  <?php


                  $categoria = "CPU";


                  $codProducto = ControladorProductosCpu::ctrMostrarCodigoProductoCpu($categoria);

                  foreach ($codProducto as $key => $value) {

                    echo '<option value="' . $value["id"] . '">' . $value["cod_producto"] . '</option>';
                  }

                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR EL TIPO DE DISCO DURO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-md" id="nuevoTipoDisco" name="nuevoTipoDisco" required>

                  <option value="">Seleccionar tipo de disco</option>
                  <option value="MECANICO">MECANICO</option>
                  <option value="SOLIDO">SOLIDO</option>


                </select>

              </div>

            </div>



            <!-- ENTRADA PARA CANTIDAD DE DISCO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-signal"></i></span>

                <input type="number" class="form-control input-md" id="nuevaCantDisco" name="nuevaCantDisco" placeholder="Ingrese GB de disco duro" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR EL TIPO DE MEMORIA RAM -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-md" id="nuevoTipoRam" name="nuevoTipoRam" required>

                  <option value="">Seleccionar tipo de Memoria Ram</option>
                  <option value="DR4">DR4</option>
                  <option value="DR3">DR3</option>
                  <option value="DR2">DR2</option>
                  <option value="DR">DR</option>


                </select>

              </div>

            </div>



            <!-- ENTRADA PARA CANTIDAD DE MEMORIA RAM -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-signal"></i></span>

                <input type="number" class="form-control input-md" id="nuevaCantRam" name="nuevaCantRam" placeholder="Ingrese GB de Memoria Ram" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR EL TIPO DE PROCESADOR-->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-md" id="nuevoProcesador" name="nuevoProcesador" required>

                  <option value="">Seleccionar tipo de Procesador</option>
                  <option value="DR4">i9</option>
                  <option value="DR3">i7</option>
                  <option value="DR2">i5</option>
                  <option value="DR">i3</option>
                  <option value="DR">AMD</option>


                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR EL SISTEMA OPERATIVO-->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-md" id="nuevoSistemaOperativo" name="nuevoSistemaOperativo" required>

                  <option value="">Seleccionar Sistema Operativo</option>
                  <option value="DR4">WIN 10</option>
                  <option value="DR3">WIN 8</option>
                  <option value="DR2">WIN 7</option>
                  <option value="DR">LINUX</option>



                </select>

              </div>

            </div>

            <!-- ENTRADA PARA LAS OBSERVACIONES-->

            <div class="form-group">

              <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

<textarea class="form-control" id="nuevaObservacion" name="nuevaObservacion" cols="5" rows="2" placeholder="escriba aqui si tiene alguna observacion de este producto"  required></textarea>

              </div>

            </div>


          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Informacion</button>

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

                <select class="form-control input-lg" id="editarModelo" name="editarModelo" required>

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

                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" placeholder="Ingrese Codigo" required>
                <!-- oculto el id del producto para poder editar -->
                <input type="hidden" id="id" name="id" require>
              </div>

            </div>
            <!-- ENTRADA PARA EL NUMERO DE SERIE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" id="editarNumSerie" name="editarNumSerie" placeholder="editar numero de serie">

              </div>

            </div>

            <!-- ENTRADA PARA EL ESTADO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" id="editarEstado" name="editarEstado" required>

                  <option value="">Seleccionar estado del producto</option>

                  <?php

                  $item = null;
                  $valor = null;
                  $orden = "id";


                  $estado = ControladorProductos::ctrMostrarEstadoProducto($item, $valor, $orden);

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

                <select class="form-control input-lg" id="editarEstadoPrestamo" name="editarEstadoPrestamo" required>

                  <option value="">Seleccionar estado del prestamo</option>
                  <option value="DISPONIBLE">DISPONIBLE</option>
                  <option value="OCUPADO">OCUPADO</option>
                </select>

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