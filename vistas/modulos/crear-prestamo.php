

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear Prestamo
    
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

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoUsuario" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idUsuario" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

                </div> 

                <!--=====================================
                ENTRADA PARA REGISTRAR A QUIEN SE LE ESTA HACIENDO EL PRESTAMO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <input type="text" class="form-control" id="nuevoEmpleado" value="pedro" readonly>
                    
                  </div>
                
                </div>
                 <!--=====================================
                ENTRADA PARA REGISTRAR FECHA PRESTAMO SERA AUTOMATICO
                ======================================--> 

                 <!--=====================================
                ENTRADA PARA REGISTRAR OBSERVACIONES
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <textarea class="form-control" name="nuevaObservacion" id="nuevaObservacion" placeholder="Escriba si existe alguna observacion"></textarea>
  
                  </div>
                
                </div>


                <!--=====================================
                ENTRADA DEL CLIENTE
                ====================================== 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                    <option value="">Seleccionar cliente</option>

                    <?php

                     /* $item = null;
                      $valor = null;

                      $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                       foreach ($categorias as $key => $value) {

                         echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                       }
                       */

                    ?>

                    </select>
                    
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                  
                  </div>
                
                </div> -->

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProducto">

                

                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>

                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

                

          
      
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar prestamo</button>

          </div>

        </form>

        <?php

          /*$guardarPrestamo = new ControladorPrestamos();
          $guardarPrestamo -> ctrCrearPrestamo();*/
          
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

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

