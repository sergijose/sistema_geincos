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

      Editar Prestamo

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Editar Prestamo</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->

      <div class="col-lg-4 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioPrestamo" id="formularioPrestamo">

            <div class="box-body">

              <div class="box" id="cajaPadre">

                <?php

                $item = "id";
                $valor = $_GET["idPrestamo"];

                $prestamo = ControladorPrestamos::ctrMostrarPrestamos($item, $valor);

                $itemUsuario = "id";
                $valorUsuario = $prestamo["idusuario"];
                $usuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                $itemEmpleado = "idempleado";
                $valorEmpleado = $prestamo["idempleado"];
                $empleado = ControladorEmpleados::ctrMostrarEmpleados($itemEmpleado, $valorEmpleado);

                ?>


                <!--=====================================
                ENTRADA DEL USUARIO
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="nuevoUsuario" name="idUsuario" value="<?php echo $usuario["nombre"]; ?>" readonly>

                    <input type="hidden" name="idUsuario" value="<?php echo $usuario["id"]; ?>">

                    <input type="hidden" name="idPrestamo" value="<?php echo $valor; ?>">

                  </div>

                </div>
                <!--=====================================
                ENTRADA DEL CODIGO DE PRESTAMO
                ======================================-->

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>



                    <input type="text" class="form-control" id="nuevoPrestamo" name="editarPrestamo" value="<?php echo $prestamo["codigo_prestamo"]; ?>" readonly>





                  </div>

                </div>

                <!--=====================================
                ENTRADA PARA REGISTRAR A QUIEN SE LE ESTA HACIENDO EL PRESTAMO
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select class="form-control input-md mi-selector" id="nuevoEmpleado" name="nuevoEmpleado" required>

                      <option value="<?php echo $empleado["idempleado"]; ?>"><?php echo $empleado["nombres"] . " " . $empleado["ape_pat"] . " " . $empleado["ape_mat"]; ?></option>

                      <?php

                      $item = null;
                      $valor = null;

                      $modelo = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

                      foreach ($modelo as $key => $value) {

                        echo '<option value="' . $value["idempleado"] . '">' . $value["nombres"] . " " . $value["ape_pat"] . " " . $value["ape_mat"] . '</option>';
                      }

                      ?>

                    </select>
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarEmpleado" data-dismiss="modal">Agregar cliente</button></span>

                  </div>


                </div>


                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================-->

                <div class="form-group row nuevoProducto" >

                  <?php
                  $listaProducto = json_decode($prestamo["productos"], true);

                  foreach ($listaProducto as $key => $value) {


                    echo '<div class="row" style="padding:5px 15px">
                  
                    <div class="col-xs-6" style="padding-right:0px" >
                    <div class="input-group" >
        <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto eliminarBoton"  idProducto="' .  $value["id"] . '">
                    <i class="fa fa-times"></i></button></span>
               <input type="text" class="form-control nuevoCodigoProducto " idProducto="' .  $value["id"] . '" name="agregarProducto" value="' .  $value["codigo"] . '" readonly required>
                    </div>
                    </div>
                  
                    <div class="col-xs-6 estadoProducto" style="padding-left:0px">
                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-thumbs-o-up"></i></span>
              <input type="text" class="form-control nuevoEstadoProducto"name="nuevoEstadoProducto" value="DISPONIBLE" readonly required>
                    </div>
                    </div>
                    </div>';
                  }



                  ?>

                </div>

                <input type="hidden" id="listaProductosPrestamos" name="listaProductos">

                <input type="hidden" class="form-control input-lg" name="actualizado_por" value="<?php echo $_SESSION["id"]; ?>" required>


                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>



              </div>

              <!--=====================================
               ENTRADA PARA INGRESAR LAS OBSERVACIONES DEL PRESTAMO
                ======================================-->

              <div class="form-group">
                <p><b>Escriba algun comentario para este prestamo<b /></p>
                <div class="input-group">


                  <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                  <textarea class="form-control" id="observacionPrestamo" name="observacionPrestamo" cols="5" rows="2" placeholder="observaciones del prestamo"><?php echo $prestamo["observacion_prestamo"]; ?></textarea>
              

                </div>

              </div>
              <div class="box-footer">

                <button type="submit" class="btn btn-primary pull-right" id="guardarPrestamo">Guardar prestamo</button>

              </div>

          </form>

          <?php

          $guardarPrestamo = new ControladorPrestamos();
          $guardarPrestamo->ctrEditarPrestamo();

          ?>

          <div class="form-group">
          <form role="form" method="post" class="formularioPrestamo">

            <input type="checkbox" id="cbovalidar" value="second_checkbox" onChange="comprobar(this);"> <label for="cbovalidar">Finalizar Prestamo</label>
            <input type="hidden" class="form-control" name="editarPrestamoFinalizar" value="<?php echo $prestamo["codigo_prestamo"]; ?>" >

            <input type="hidden" id="listaProductos" name="listaProductos">
            <input type="hidden" class="form-control input-lg" name="finalizado_por" value="<?php echo $_SESSION["id"]; ?>" required>
            

            <div class="input-group" readonly style="display:none" id="caja">


              <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

              <textarea class="form-control" id="observacionDevolucion" name="observacionDevolucion" cols="5" rows="2" placeholder="observaciones de la devolucion del prestamo" readonly style="display:none" required></textarea>

            </div>
            <button type="submit" class="btn btn-danger pull-left" id="btnFinalizar"readonly style="display:none">Finalizar</button>   
            <?php

              $finalizarPrestamo = new ControladorPrestamos();
              $finalizarPrestamo->ctrfinalizarPrestamo();

?>

          </div>
          
          </form>



        </div>


      </div>

    </div>
   


    <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

    <div class="col-lg-8 hidden-md hidden-sm hidden-xs" id="tablaProductos">

      <div class="box box-warning">

        <div class="box-header with-border"></div>

        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablaPrestamos">

            <thead>

              <tr>
                <th style="width: 10px">#</th>
                <th>Imagen</th>
                <th>Modelo</th>
                <th>Código del Producto</th>
                <th>Estado Producto</th>
                <th>Estado del Prestamo</th>
                <th>Acciones</th>
              </tr>

            </thead>

          </table>

        </div>

      </div>


    </div>

</div>

</section>

</div>

<div id="modalAgregarEmpleado" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Empleado</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
            <!-- ENTRADA PARA EL APELLIDO PATERNO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoApePat" placeholder="Ingresar apellido paterno" required>

              </div>

            </div>
            <!-- ENTRADA PARA EL APELLIDO MATERNO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoApeMat" placeholder="Ingresar apellido materno" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoNombres" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="number" min="0" class="form-control input-lg" name="nuevoNumDocumento" id="nuevoNumDocumento" placeholder="Ingresar documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL ESTADO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>


                <select class="form-control input-lg" id="nuevoEstado" name="nuevoEstado" required>

                  <option value="">Seleccionar estado del empleado</option>
                  <option value="1">ACTIVADO</option>
                  <option value="2">DESACTIVADO</option>
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

          <button type="submit" class="btn btn-primary">Guardar empleado</button>

        </div>

      </form>

      <?php

      $crearEmpleado = new ControladorEmpleados();
      $crearEmpleado->ctrCrearEmpleados();

      ?>

    </div>

  </div>

</div>