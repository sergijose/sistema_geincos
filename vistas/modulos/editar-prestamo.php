<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Editar Prestamo

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Crear Prestamo</li>

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

          <form role="form" method="post" class="formularioPrestamo">

            <div class="box-body">

              <div class="box">


                <?php

                $item = "id";
                $valor = $_GET["idPrestamo"];

                $prestamo = ControladorPrestamos::ctrMostrarPrestamos($item, $valor);
                  
                $itemUsuario = "id";
                $valorUsuario = $prestamo["idusuario"];

                $usuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                


                ?>
                <!--=====================================
                ENTRADA DEL USUARIO
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="nuevoUsuario" name="nuevoUsuario" value="<?php echo $usuario["nombre"]; ?>" readonly>

                    <input type="hidden" name="idUsuario" value="<?php echo $usuario["id"]; ?>">
                    <input type="hidden" name="idPrestamo" value="<?php echo $prestamo["id"]; ?>">

                  </div>

                </div>

                <!--=====================================
                ENTRADA PARA REGISTRAR A QUIEN SE LE ESTA HACIENDO EL PRESTAMO
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <input type="text" class="form-control" id="nuevoEmpleado" name="nuevoEmpleado" value= "<?php echo $prestamo["idempleado"]; ?>"readonly>

                  </div>

                </div>


                <!--=====================================
                ENTRADA PARA REGISTRAR OBSERVACIONES
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                    <textarea class="form-control" name="editarObservacion" id="nuevaObservacion" required><?php echo $prestamo["observaciones"]; ?></textarea>

                  </div>

                </div>
                  <!--=====================================
                ENTRADA PARA REGISTRAR FECHA DE DEVOLUCION
                ======================================-->
                <p>* Registre <b> FECHA DE DEVOLUCION </b> solo cuando no se tenga ningun pendiente</p>
                <div class="form-group  mostrarFecha" id="mostrarFecha" >

                 

                </div>



                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================-->

                <div class="form-group row nuevoProducto">

                <?php

                $listaProducto = json_decode($prestamo["producto"], true);

                foreach ($listaProducto as $key => $value) {

                  $item = "id";
                  $valor = $value["id"];
                  $orden = "id";

                  $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
                 
               
                  
                  echo '<div class="row" style="padding:5px 15px">
                  
                  <div class="col-xs-6" style="padding-right:0px">
                  <div class="input-group">
           <span class="input-group-addon">
         <button type="button" class="btn btn-danger btn-xs  quitarProducto" idProducto="'.$value["id"].'">
                  <i class="fa fa-times"></i></button></span>
   <input type="text" class="form-control nuevoCodigoProducto" idProducto="'.$value["id"].'" name="agregarProducto" value="'.$value["codigo"].'" readonly required>
                  </div>
                  </div>
                 
                  <div class="col-xs-6 estadoProducto" style="padding-left:0px"> 
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-thumbs-o-up"></i></span>
    <input type="text" class="form-control nuevoEstadoProducto"name="nuevoEstadoProducto" value="'.$respuesta["estado_prestamo"].'" readonly required>
                  </div>
                  </div> 
                  </div>';
                }


                ?>


                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>



              </div>

            </div>

            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right">Guardar cambios</button>

            </div>

          </form>

          <?php

          $editarPrestamo = new ControladorPrestamos();
          $editarPrestamo->ctrEditarPrestamo();

          ?>

        </div>

      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-8 hidden-md hidden-sm hidden-xs">

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