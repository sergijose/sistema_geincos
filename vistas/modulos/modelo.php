<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar modelo
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar modelo</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarModelo">
          
          Agregar modelo

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Categoria</th>
           <th>Marca</th>
           <th>Modelo</th>
           <th>Imagen</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $modelo = ControladorModelos::ctrMostrarModelo($item, $valor);

          foreach ($modelo as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["categoria"].'</td>
                    <td class="text-uppercase">'.$value["marca"].'</td>
                    <td class="text-uppercase">'.$value["descripcion"].'</td>';
                    
                    if($value["imagen"] != ""){

                      echo '<td><img src="'.$value["imagen"].'" class="img-thumbnail" width="40px" data-toggle="modal" data-target="#modalMostrar" id="'.$value["id"].'"></td>';
  
                    }else{
  
                      echo '<td><img src="vistas/img/modelos/default/anonymous.png" class="img-thumbnail"  width="40px" data-toggle="modal" data-target="#modalMostrar" id="'.$value["id"].'"></td>';
  
                    }
  

                    echo '<td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarModelo" idModelo="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarModelo"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarModelo" idModelo="'.$value["id"].'"><i class="fa fa-times"></i></button>

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

<!--=====================================
MODAL MOSTRAR IMAGEN MARCAS
======================================-->
<div id="modalMostrar" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">IMAGEN</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            <img src="<?php echo $value["imagen"]; ?>" width="200px" id="editarimagen">
            <input type="text"  name="idModelo" id="idModelo" required>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-center" data-dismiss="modal">Salir</button>

         

        </div>

     

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL AGREGAR MODELO
======================================-->

<div id="modalAgregarModelo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data" >

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar modelo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LA CATEGORIA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>
                  
                  <option value="">Seleccionar Categoria</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categoria as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

                  <!-- ENTRADA PARA LA MARCA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevaMarca" name="nuevaMarca" required>
                  
                  <option value="">Selecionar marca</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $marca = ControladorMarcas::ctrMostrarMarca($item, $valor);

                  foreach ($marca as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>


            <!-- ENTRADA PARA EL DESCRIPCION DEL MODELO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoModelo" placeholder="Ingresar Modelo" required>

              </div>

            </div>
                <!-- ENTRADA PARA FOTO DEL MODELO -->
            <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaFoto" name="nuevaImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/modelos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                  <br>
                  <br>
            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar marca</button>

        </div>

        <?php

          $crearModelo = new ControladorModelos();
          $crearModelo -> ctrCrearModelo();

        ?>

      </form>

    </div>

  </div>

</div>






<!--=====================================
MODAL EDITAR MODELO
======================================-->

<div id="modalEditarModelo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar modelo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EDITAR LA CATEGORIA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="editarCategoria" name="editarCategoria" required>
                  
                  <option value="">Seleccionar Categoria</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categoria as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

                  <!-- ENTRADA PARA EDITAR LA MARCA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="editarMarca" name="editarMarca" required>
                  
                  <option value="">Selecionar marca</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $marca = ControladorMarcas::ctrMostrarMarca($item, $valor);

                  foreach ($marca as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>


            <!-- ENTRADA PARA EDITAR DESCRIPCION DEL MODELO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarModelo" id="editarModelo" require>

              </div>

            </div>
                <!-- ENTRADA PARA EDITAR FOTO DEL MODELO -->
            <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaFoto" name="editarImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/modelos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
              <input type="hidden" name="imagenActual" id="imagenActual">
              <input type="hidden"  name="idModelo" id="idModelo" >   
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

        $editarModelo = new ControladorModelos();
        $editarModelo -> ctrEditarModelo();

?>       
     

      </form>

    </div>

  </div>

</div>




