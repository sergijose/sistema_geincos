<?php

if ($_SESSION["perfil"] == "Visitante") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}

?>




<div class="content-wrapper">

    <div class="row">

        <div class="col-lg-5 col-xs-6">

            <section class="content-header">

                <h1>

                   Ubicacion de Productos
                </h1>


            </section>

            <section class="content">


                <div class="box">

                    <div class="box-header with-border">

                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">

                            Agregar Ubicacion

                        </button>

                    </div>

                    <div class="box-body">

                        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                            <thead>

                                <tr>

                                    <th style="width:10px">#</th>
                                    <th>Producto</th>
                                    <th>Oficina</th>
                                    <th>Posicion</th>
                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                $item = null;
                                $valor = null;

                                $ubicacionProductos = ControladorProductoUbicacion::ctrMostrarProductoUbicacion($item, $valor);

                                foreach ($ubicacionProductos as $key => $value) {

                                    echo ' <tr>

                    <td>' . ($key + 1) . '</td>

                    <td class="text-uppercase">' . $value["codigo_producto"] . '</td>
                    <td class="text-uppercase">' . $value["ubicacion"] . '</td>
                    <td class="text-uppercase">' . $value["posicion"] . '</td>
                 

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarProductoUbicacion" idProductoUbicacion="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarProductoUbicacion"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarProductoUbicacion" idProductoUbicacion="' . $value["id"] . '"><i class="fa fa-times"></i></button>

                      </div>  

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


        <div class="col-lg-7 col-xs-6">

            <section class="content-header">

                <h1>

                    Estructura de la Ubicacion
                </h1>


            </section>

            <section class="content">


                <div class="box">

                    <div class="box-header with-border">

                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">

                            Agregar Ubicacion

                        </button>

                    </div>

                    <div class="box-body">

                       <img src="vistas/img/plantilla/plano-611.png" alt="">         
                    </div>

                </div>
            </section>

        </div>




    </div>





</div>



<!--=====================================
MODAL AGREGAR CATEGORÍA
======================================-->

<div id="modalAgregarCategoria" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar categoría</h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Ingresar categoría" required>
                                <input type="hidden" class="form-control input-lg" name="creado_por" value="<?php echo $_SESSION["id"]; ?>" required>
                            </div>

                        </div>

                    </div>

                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Guardar categoría</button>

                </div>

                <?php

                $crearCategoria = new ControladorCategorias();
                $crearCategoria->ctrCrearCategoria();

                ?>

            </form>

        </div>

    </div>

</div>

<!--=====================================
MODAL EDITAR CATEGORÍA
======================================-->

<div id="modalEditarCategoria" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar categoría</h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" required>

                                <input type="hidden" name="idCategoria" id="idCategoria" required>
                                <input type="hidden" class="form-control input-lg" name="actualizado_por" value="<?php echo $_SESSION["id"]; ?>" required>
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

                $editarCategoria = new ControladorCategorias();
                $editarCategoria->ctrEditarCategoria();

                ?>

            </form>

        </div>

    </div>

</div>

<?php

$borrarCategoria = new ControladorCategorias();
$borrarCategoria->ctrBorrarCategoria();

?>