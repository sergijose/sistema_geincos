<div id="back"></div>

<div class="login-box">



  <div class="login-box-body">

    <p class="login-box-msg"><strong>Ingresar al sistema</strong></p>
    <div class="login-logo">

      <img src="vistas/img/plantilla/logo-07.jpg" class="img-responsive" style="padding:30px 100px 0px 100px  ">

    </div>
    <form method="post">

      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      </div>

      <div class="row ">

        <div class="col-xs-4 ">

          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>

        </div>

      </div>

      

    </form>
    <?php

$login = new ControladorUsuarios();
$login->ctrIngresoUsuario();

?>
  </div>

</div>