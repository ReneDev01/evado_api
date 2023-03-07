
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>D-bla| Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=" {{asset("/assets/plugins/fontawesome-free/css/all.min.css")}} ">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href=" {{asset("/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}} ">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{asset("/assets/dist_admin/css/adminlte.min.css")}} ">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a><b>D</b>-Bla</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{route("user.login")}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="phone" class="form-control" name="phone" placeholder="Telephone">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Se Connecter</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

      <center>
        <p class="mb-1">
          <a href="#">Mot de passe oublié??</a>
        </p>
      </center>
      <br>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src=" {{asset("assets/plugins/jquery/jquery.min.js")}} "></script>
<!-- Bootstrap 4 -->
<script src=" {{asset("assets/plugins/bootstrap/js/bootstrap.bundle.min.js")}} "></script>
<!-- AdminLTE App -->
<script src=" {{asset("assets/dist_admin/js/adminlte.min.js")}} "></script>
</body>
</html>