<!--
<div id="back"></div>-->
<!--
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

  </div>

</div>

-->

<!DOCTYPE html>
<html>

<head>
  <title>Formulario de inicio de sesión</title>
  <!-- Incluimos los archivos de Bootstrap CSS y JS -->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.0/dist/css/bootstrap.min.css">

  <style>
    .form-control:focus {
      border-color: #6c757d;
      box-shadow: none;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #0069d9;
      border-color: #0062cc;
    }

    .bg-image {
      background-image: url("vistas/img/plantilla/logo4.jpg");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      margin-top: 40px;
      box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
      height: 500px;
      overflow: hidden;

    }

    .btn-custom {
      display: inline-block;
      font-weight: 400;
      color: #212529;
      text-align: center;
      vertical-align: middle;
      user-select: none;
      background-color: #007bff;
      border-color: #007bff;
      padding: .375rem .75rem;
      font-size: 1.5rem;
      line-height: 1.5;
      border-radius: .25rem;
      transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .btn-custom:hover {
      color: #fff;
      background-color: #0069d9;
      border-color: #0062cc;

    }

    .lead-custom {
      font-size: 1.25rem;
      font-weight: 300;
    }

    .login-form {
      margin-top: 50px;
      /* ajusta la separación entre el formulario y la imagen */


    }
    .form-control {
  display: block;
  width: 100%;
  padding: 0.375rem 0.75rem;
  font-size: 1.4rem;
  font-weight: 400;
  line-height: 1.5;
  color: #212529;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
 
}
  </style>
</head>

<body class="bootstrap-5">
  <div class="container">
    <div class="row">
      <div class="col-md-3 login-form">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center">Iniciar sesión</h4>
          </div>
          <div class="card-body">
            <form method="post">
              <div class="mb-3">
                <label for="usuario" class="lead-custom">Usuario:</label>
                <input type="text" class="form-control" id="ingUsuario" name="ingUsuario" />
              </div>
              <div class="mb-3">
                <label for="contrasena" class="lead-custom">Contraseña:</label>
                <input type="password" class="form-control" id="ingPassword" name="ingPassword" />
              </div>
              <div style="display: flex; justify-content: center; align-items: center;">
                <button type="submit" class="btn btn-custom" style="text-align: center;">
                  Iniciar sesión
                </button>
              </div>
              <?php

              $login = new ControladorUsuarios();
              $login->ctrIngresoUsuario();

              ?>
            </form>
          </div>
        </div>
      </div>
      <div id="miDiv" class="col-md-9 bg-image" style="opacity: 1;">

        <!-- aquí va la imagen de fondo -->

      </div>
    </div>
  </div>
</body>

</html>