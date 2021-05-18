<?php
  if ($_SESSION["perfil" ] =="Visitante" ) {

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

        <button class="btn btn-primary" data-toggle="modal"
          data-target="#modalAgregarProductoCpu">

          Agregar informacion

        </button>




      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive
          tablaProductosCpu" width="100%">

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
        <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>"
        id="perfilOculto">


      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR PRODUCTO CPU
======================================-->
<div id="modalAgregarProductoCpu" class="modal fade" role="dialog">



  <div class="modal-dialog modal-lg">

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



            <div class="row">
              <div class="col-lg-6 col-xs-12">
                <!-- ENTRADA PARA SELECCIONAR CODIGO DE PRODUCTO DE LA CATEGORIA CPU -->
                <div class="form-group">
                  <label for="nuevoCodProductoCpu">Ingrese Codigo CPU</label>
                  <div class="input-group">


                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                    <select class="form-control input-md mi-selector2"
                      id="nuevoCodProductoCpu" name="nuevoCodProductoCpu"
                      required>

                      <option value="">Seleccionar Codigo CPU</option>

                      <?php


                        $categoria="CPU" ;


                        $codProducto=ControladorProductosCpu::ctrMostrarCodigoProductoCpu($categoria);
                        foreach ($codProducto as $key=> $value) {

                        echo '<option value="' . $value["id"] . '">' .
                          $value["cod_producto"] . '</option>';
                        }

                        ?>

                      </select>

                    </div>
                </div>
                </div>       

                <div class="col-lg-6 col-xs-12">
                  <!--=====================================
                ENTRADA PARA REGISTRAR A QUIEN PERTENECE ESTE CPU
                ======================================-->
                  <div class="form-group">
                    <label for="nuevoEmpleado">Asignado A:</label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <select class="form-control input-md mi-selector-cliente"
                        id="nuevoEmpleado" name="nuevoEmpleado">
                        <option value="">Seleccionar Empleado</option>

                        <?php

                          $item= null;
                          $valor= null;

                          $modelo=
                          ControladorEmpleados::ctrMostrarEmpleados($item,
                          $valor);

                          foreach ($modelo as $key=> $value) {

                          echo '<option value="' . $value["idempleado"] . '">'
                            . $value["nombres"] . " " . $value["ape_pat"] . " "
                            . $value["ape_mat"] ." " . $value["num_documento"] .
                            '</option>';
                          }

                          ?>

                        </select>


                      </div>


                    </div>

                  </div>

                </div> <!-- FIN DE LA PRIMERA FILA -->





                <!-- ENTRADA PARA SELECCIONAR EL TIPO DE DISCO DURO -->
                <div class="row">
                  <div class="col-lg-4 col-xs-12">

                    <div class="form-group">
                      <label for="nuevoTipoDisco">Ingrese tipo de disco</label>
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-th"></i></span>
                        <select class="form-control input-md"
                          id="nuevoTipoDisco" name="nuevoTipoDisco" required>
                          <option value="">Seleccionar tipo de disco</option>
                          <option value="MECANICO">MECANICO</option>
                          <option value="SOLIDO">SOLIDO</option>


                        </select>

                      </div>

                    </div>

                  </div>






                  <!-- ENTRADA PARA CANTIDAD DE DISCO -->
                  <div class="col-lg-4 col-xs-12">
                    <div class="form-group">
                      <label for="nuevaCantDisco">Ingrese cantidad de disco</label>
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-signal"></i></span>
                        <input type="number" class="form-control input-md"
                          id="nuevaCantDisco" name="nuevaCantDisco"
                          placeholder="Ingrese GB de disco duro" required>
                      </div>

                    </div>

                  </div>


                  <!-- ENTRADA PARA SELECCIONAR EL TIPO DE PROCESADOR-->
                  <div class="col-lg-4 col-xs-12">
                    <div class="form-group">
                      <label for="nuevoProcesador">Ingrese Procesador</label>
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-th"></i></span>
                        <select class="form-control input-md"
                          id="nuevoProcesador" name="nuevoProcesador" required>
                          <option value="">Seleccionar tipo de Procesador</option>
                          <option value="i9">i9</option>
                          <option value="i7">i7</option>
                          <option value="i5">i5</option>
                          <option value="i3">i3</option>
                          <option value="corel 2 duo">Corel 2 duo</option>
                          <option value="amd">AMD</option>
                        </select>

                      </div>

                    </div>

                  </div>

                </div> <!-- FIN DE ROW SEGUNDA FILA -->



                <div class="row">
                  <!-- ENTRADA PARA SELECCIONAR EL TIPO DE MEMORIA RAM -->
                  <div class="col-lg-4 col-xs-12">
                    <div class="form-group">
                      <label for="nuevoTipoRam">Ingrese tipo de memoria</label>
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-th"></i></span>
                        <select class="form-control input-md" id="nuevoTipoRam"
                          name="nuevoTipoRam" required>

                          <option value="">Seleccionar tipo de Memoria Ram</option>
                          <option value="DR4">DR4</option>
                          <option value="DR3">DR3</option>
                          <option value="DR2">DR2</option>
                          <option value="DR">DR</option>


                        </select>

                      </div>

                    </div>
                  </div>


                  <div class="col-lg-4 col-xs-12">
                    <!-- ENTRADA PARA CANTIDAD DE MEMORIA RAM -->

                    <div class="form-group">
                      <label for="nuevaCantRam">Ingrese cantidad de memoria</label>
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-signal"></i></span>
                        <input type="number" class="form-control input-md"
                          id="nuevaCantRam" name="nuevaCantRam"
                          placeholder="Ingrese GB de Memoria Ram" required>
                      </div>

                    </div>

                  </div>


                  <div class="col-lg-4 col-xs-12">
                    <!-- ENTRADA PARA SELECCIONAR EL SISTEMA OPERATIVO-->

                    <div class="form-group">
                      <label for="nuevoSistemaOperativo">Ingrese Sistema
                        Operativo</label>
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-th"></i></span>
                        <select class="form-control input-md"
                          id="nuevoSistemaOperativo"
                          name="nuevoSistemaOperativo" required>

                          <option value="">Seleccionar Sistema Operativo</option>
                          <option value="windows 10">WIN 10</option>
                          <option value="windows 8">WIN 8</option>
                          <option value="windows 7">WIN 7</option>
                          <option value="linux">LINUX</option>


                        </select>

                      </div>

                    </div>
                  </div>

                </div> <!-- FIN DE ROW DE LA TERCERA FILA-->


                <div class="row">





                  <div class="col-lg-4 col-xs-12">
                    <div class="form-group">
                      <label>Direccion Ip</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-laptop"
                            aria-hidden="true"></i></span>

                        <input type="text" class="form-control"
                          data-inputmask="'alias': 'ip'" data-mask=""
                          im-insert="true" name="nuevoIp" id="nuevoIp">
                      </div>
                      <!-- /.input group -->
                    </div>

                  </div>




                  <div class="col-lg-8 col-xs-12">
                    <!-- ENTRADA PARA LAS OBSERVACIONES-->


                    <div class="form-group">
                      <label for="nuevaObservacion">Describa alguna observacion</label>
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                        <textarea class="form-control" id="nuevaObservacion"
                          name="nuevaObservacion" cols="5" rows="5"
                          placeholder="escriba aqui si tiene alguna observacion
                          de este producto" required> </textarea>

                      </div>

                    </div>
                  </div>

                </div>



              </div> <!-- FIN DE FILA-->
            </div>

      

            <!--=====================================
        PIE DEL MODAL
        ======================================-->
            <div class="modal-footer">

              <button type="button" class="btn btn-default pull-left"
                data-dismiss="modal">Salir</button>

              <button type="submit" class="btn btn-primary">Guardar Informacion</button>
            </div>

          </form>

          <?php

            $crearProductoCpu= new ControladorProductosCpu();
            $crearProductoCpu->ctrCrearProductoCpu();

            ?>

          </div>

        </div>

     
      




      <!--=====================================
MODAL EDITAR PRODUCTO CPU
======================================-->
      <div id="modalEditarProductoCpu" class="modal fade" role="dialog">


        <div class="modal-dialog  modal-lg">

          <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">
              <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
              <div class="modal-header" style="background:#3c8dbc; color:white">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editar informacion del CPU</h4>

              </div>

              <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
              <div class="modal-body">

               
                <div class="box-body">



                  <div class="row">
                    <div class="col-lg-6 col-xs-12">
                      <!-- ENTRADA PARA SELECCIONAR CODIGO DE PRODUCTO DE LA CATEGORIA CPU -->
                      <div class="form-group">
                        <label for="editarCodProductoCpu">Ingrese Codigo CPU</label>
                        <div class="input-group">
      
      
                          <span class="input-group-addon"><i class="fa fa-th"></i></span>
                          <input type="text" class="form-control input-md"
                            id="editarCodProductoCpu" name="editarCodProductoCpu"
                            required readonly>
      
                           
      
                          </div>
      
                        </div>
      
                      </div>
      
      
                      <div class="col-lg-6 col-xs-12">
                        <!--=====================================
                      ENTRADA PARA REGISTRAR A QUIEN PERTENECE ESTE CPU
                      ======================================-->
                        <div class="form-group">
                          <label for="editarEmpleado">Asignado A:</label>
      
                          <div class="input-group">
      
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <select class="form-control input-md mi-selector-cliente"
                              id="editarEmpleado" name="editarEmpleado">
                              <option value="">Seleccionar Empleado</option>
      
                              <?php
      
                                $item= null;
                                $valor= null;
      
                                $modelo=
                                ControladorEmpleados::ctrMostrarEmpleados($item,
                                $valor);
      
                                foreach ($modelo as $key=> $value) {
      
                                echo '<option value="' . $value[" idempleado" ] . '">'
                                  . $value["nombres"] . " " . $value["ape_pat"] . " "
                                  . $value["ape_mat"] ." " . $value["num_documento"] .
                                  '</option>';
                                }
      
                                ?>
      
                              </select>
      
      
                            </div>
      
      
                          </div>
      
                        </div>
      
                      </div> <!-- FIN DE LA PRIMERA FILA -->
      
      
      
      
      
                      <!-- ENTRADA PARA SELECCIONAR EL TIPO DE DISCO DURO -->
                      <div class="row">
                        <div class="col-lg-4 col-xs-12">
      
                          <div class="form-group">
                            <label for="editarTipoDisco">Ingrese tipo de disco</label>
                            <div class="input-group">
      
                              <span class="input-group-addon"><i class="fa fa-th"></i></span>
                              <select class="form-control input-md"
                                id="editarTipoDisco" name="editarTipoDisco" required>
                                <option value="">Seleccionar tipo de disco</option>
                                <option value="MECANICO">MECANICO</option>
                                <option value="SOLIDO">SOLIDO</option>
      
      
                              </select>
      
                            </div>
      
                          </div>
      
                        </div>
      
      
      
      
      
      
                        <!-- ENTRADA PARA CANTIDAD DE DISCO -->
                        <div class="col-lg-4 col-xs-12">
                          <div class="form-group">
                            <label for="editarTipoDisco">Ingrese cantidad de disco</label>
                            <div class="input-group">
      
                              <span class="input-group-addon"><i class="fa fa-signal"></i></span>
                              <input type="number" class="form-control input-md"
                                id="editarCantDisco" name="editarCantDisco"
                                placeholder="Ingrese GB de disco duro" required>
                            </div>
      
                          </div>
      
                        </div>
      
      
                        <!-- ENTRADA PARA SELECCIONAR EL TIPO DE PROCESADOR-->
                        <div class="col-lg-4 col-xs-12">
                          <div class="form-group">
                            <label for="editarProcesador">Ingrese Procesador</label>
                            <div class="input-group">
      
                              <span class="input-group-addon"><i class="fa fa-th"></i></span>
                              <select class="form-control input-md"
                                id="editarProcesador" name="editarProcesador" required>
                                <option value="">Seleccionar tipo de Procesador</option>
                                <option value="i9">i9</option>
                                <option value="i7">i7</option>
                                <option value="i5">i5</option>
                                <option value="i3">i3</option>
                                <option value="corel 2 duo">Corel 2 duo</option>
                                <option value="amd">AMD</option>
                              </select>
      
                            </div>
      
                          </div>
      
                        </div>
      
                      </div> <!-- FIN DE ROW SEGUNDA FILA -->
      
      
      
                      <div class="row">
                        <!-- ENTRADA PARA SELECCIONAR EL TIPO DE MEMORIA RAM -->
                        <div class="col-lg-4 col-xs-12">
                          <div class="form-group">
                            <label for="editarTipoDisco">Ingrese tipo de memoria</label>
                            <div class="input-group">
      
                              <span class="input-group-addon"><i class="fa fa-th"></i></span>
                              <select class="form-control input-md" id="editarTipoRam"
                                name="editarTipoRam" required>
      
                                <option value="">Seleccionar tipo de Memoria Ram</option>
                                <option value="DR4">DR4</option>
                                <option value="DR3">DR3</option>
                                <option value="DR2">DR2</option>
                                <option value="DR">DR</option>
      
      
                              </select>
      
                            </div>
      
                          </div>
                        </div>
      
      
                        <div class="col-lg-4 col-xs-12">
                          <!-- ENTRADA PARA CANTIDAD DE MEMORIA RAM -->
      
                          <div class="form-group">
                            <label for="editarCantRam">Ingrese cantidad de memoria</label>
                            <div class="input-group">
      
                              <span class="input-group-addon"><i class="fa fa-signal"></i></span>
                              <input type="number" class="form-control input-md"
                                id="editarCantRam" name="editarCantRam"
                                placeholder="Ingrese GB de Memoria Ram" required>
                            </div>
      
                          </div>
      
                        </div>
      
      
                        <div class="col-lg-4 col-xs-12">
                          <!-- ENTRADA PARA SELECCIONAR EL SISTEMA OPERATIVO-->
      
                          <div class="form-group">
                            <label for="editarSistemaOperativo">Ingrese Sistema
                              Operativo</label>
                            <div class="input-group">
      
                              <span class="input-group-addon"><i class="fa fa-th"></i></span>
                              <select class="form-control input-md"
                                id="editarSistemaOperativo"
                                name="editarSistemaOperativo" required>
      
                                <option value="">Seleccionar Sistema Operativo</option>
                                <option value="windows 10">WIN 10</option>
                                <option value="windows 8">WIN 8</option>
                                <option value="windows 7">WIN 7</option>
                                <option value="linux">LINUX</option>
      
      
                              </select>
      
                            </div>
      
                          </div>
                        </div>
      
                      </div> <!-- FIN DE ROW DE LA TERCERA FILA-->
      
      
                      <div class="row">
      
      
      
      
      
                        <div class="col-lg-4 col-xs-12">
                          <div class="form-group">
                            <label><font style="vertical-align: inherit;"><font
                                  style="vertical-align: inherit;">Direccion IP:</font></font></label>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-laptop"
                                  aria-hidden="true"></i></span>
      
                              <input type="text" class="form-control"
                                data-inputmask="'alias': 'ip'" data-mask=""
                                im-insert="true" name="editarIp" id="editarIp">
                                <input type="hidden" id="id" name="id" require> <!-- /.id pára editar -->
                            </div>
                            <!-- /.input group -->
                          </div>
      
                        </div>
      
      
      
      
                        <div class="col-lg-8 col-xs-12">
                          <!-- ENTRADA PARA LAS OBSERVACIONES-->
      
      
                          <div class="form-group">
                            <label for="editarObservacion">Describa alguna observacion</label>
                            <div class="input-group">
      
                              <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                              <textarea class="form-control" id="editarObservacion"
                                name="editarObservacion" cols="5" rows="5"
                                placeholder="escriba aqui si tiene alguna observacion
                                de este producto" required> </textarea>
      
                            </div>
      
                          </div>
                        </div>
      
                      </div>
                    </div> <!-- FIN DE FILA-->
            </div>

            <!--=====================================
        PIE DEL MODAL
        ======================================-->
            <div class="modal-footer">

              <button type="button" class="btn btn-default pull-left"
                data-dismiss="modal">Salir</button>

              <button type="submit" class="btn btn-primary">Guardar Informacion</button>
            </div>

          </form>

          <?php

            $editarProductoCpu= new ControladorProductosCpu();
            $editarProductoCpu->ctrEditarProductoCpu();

            ?>

          </div>

        </div>

      </div>


      <!--=====================================
MODAL EDITAR PRODUCTO
======================================-->
      <?php

        $eliminarProductoCpu= new ControladorProductosCpu();
        $eliminarProductoCpu->ctrEliminarProductoCpu();

        ?>