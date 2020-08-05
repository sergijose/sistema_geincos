
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

                if(isset($_GET["fechaInicial"])){

                  echo $_GET["fechaInicial"]." - ".$_GET["fechaFinal"];
                
                }else{
                 
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
           <th>Disponibilidad</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        
               
        </tbody>

       </table>

       
       

      </div>

    </div>

  </section>

</div>




