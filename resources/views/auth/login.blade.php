<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | {{config('app.name')}}</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/dist/css/adminlte.min.css">
  <style>
    body {
      background-color: #1977cc !important;
    }
    .login-box {
      width: 400px;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }
    .btn-primary {
      background-color: #1977cc;
      border-color: #1977cc;
    }
    .btn-primary:hover {
      background-color: #125a9c;
      border-color: #125a9c;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h1><b>Medix</b></h1>
    </div>
    <div class="card-body">
      @if(session('failed'))
        <div class="alert alert-danger">
            {{ session('failed') }}
        </div>
      @endif
      <form action="/login" method="post">
        @csrf
        @error('email')
          <small class="text-danger">{{$message}}</small>                
        @enderror
        <div class="input-group mb-3">
          <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Username/Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('password')
          <small class="text-danger">{{$message}}</small>                
        @enderror
        <div class="input-group mb-3">
          <input type="password" name="password" value="{{old('password')}}" class="form-control" placeholder="Password" id="password">
          <div class="input-group-append show-password" data-id="password">
            <div class="input-group-text">
              <span class="fas fa-lock" id="password-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" value="{{old('remember') ?? 0}}" id="remember">
              <label for="remember">
                Ingat Saya
              </label>
            </div>
          </div>
        </div>
        <div class="social-auth-links text-center mt-2 mb-3">
          <button type="submit" class="btn btn-block btn-primary">
            Login
          </button>
        </div>
      </form>
      <p class="mb-1">
        <a href="/register">Belum punya akun? Daftar disini.</a>
      </p>
    </div>
  </div>
</div>
<script src="{{asset('AdminLTE')}}/plugins/jquery/jquery.min.js"></script>
<script src="{{asset('AdminLTE')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('AdminLTE')}}/dist/js/adminlte.min.js"></script>
<script>
  $('#remember').prop('checked', "{{old('remember')}}");
  $('#remember').on('click', function(){
    $(this).val(parseInt($(this).val()) ? 0 : 1);
  })  
  $('.show-password').on('click', function(){
    let input = $('#' + $(this).data('id'));
    let icon = $('#' + $(this).data('id') + '-lock');
    if(input.attr('type') == 'password'){
      input.attr('type', 'text');
      icon.attr('class', 'fas fa-unlock')
    }else{
      input.attr('type', 'password');
      icon.attr('class', 'fas fa-lock')
    }
  })
</script>
</body>
</html>