<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} | Register</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <p><b>Medix</b></p>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      @if (session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if (session('failed'))
          <div class="alert alert-danger">{{ session('failed') }}</div>
      @endif
      <p class="login-box-msg">Register here</p>
      
      <form action="{{ route('register') }}" method="POST">
        @csrf
        
        {{-- Name --}}
        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
          </div>
        </div>
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror

        {{-- Birth Date --}}
        <div class="input-group mb-3">
          <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date') }}" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-calendar"></span></div>
          </div>
        </div>
        @error('birth_date') <small class="text-danger">{{ $message }}</small> @enderror

        {{-- Phone --}}
        <div class="input-group mb-3">
          <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-phone"></span></div>
          </div>
        </div>
        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror

        {{-- Golongan Darah --}}
        <div class="input-group mb-3">
          <select name="blood_type" class="form-control" required>
            <option value="" disabled selected>Pilih Golongan Darah</option>
            <option value="A" {{ old('blood_type') == 'A' ? 'selected' : '' }}>A</option>
            <option value="B" {{ old('blood_type') == 'B' ? 'selected' : '' }}>B</option>
            <option value="AB" {{ old('blood_type') == 'AB' ? 'selected' : '' }}>AB</option>
            <option value="O" {{ old('blood_type') == 'O' ? 'selected' : '' }}>O</option>
          </select>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-tint"></span></div>
          </div>
        </div>
        @error('blood_type') <small class="text-danger">{{ $message }}</small> @enderror

        {{-- Address --}}
        <div class="input-group mb-3">
          <input type="text" name="address" class="form-control" placeholder="Address" value="{{ old('address') }}" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-map-marker-alt"></span></div>
          </div>
        </div>
        @error('address') <small class="text-danger">{{ $message }}</small> @enderror

        {{-- Hidden Role (Default: Patient) --}}
        <input type="hidden" name="role" value="patient">

        {{-- Password --}}
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" id="password" required>
          <div class="input-group-append show-password">
            <div class="input-group-text"><span class="fas fa-lock" id="password-lock"></span></div>
          </div>
        </div>
        @error('password') <small class="text-danger">{{ $message }}</small> @enderror

        {{-- Confirm Password --}}
        <div class="input-group mb-3">
          <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" id="confirm-password" required>
          <div class="input-group-append show-confirm-password">
            <div class="input-group-text"><span class="fas fa-lock" id="confirm-password-lock"></span></div>
          </div>
        </div>
        @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror

        {{-- Submit Button --}}
        <div class="row">
          <div class="col-4 offset-8">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
        </div>
      </form>

      {{-- Already have an account? --}}
      <p class="mt-3 mb-1">Already have an account?</p>
      <p class="mb-0">
        <a href="{{ route('login') }}" class="text-center">Login here!</a>
      </p>
    </div>
  </div>
</div>

{{-- Scripts --}}
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<script>
    // Toggle Password Visibility
    $('.show-password').on('click', function(){
        let passwordField = $('#password');
        let passwordIcon = $('#password-lock');
        if(passwordField.attr('type') === 'password'){
            passwordField.attr('type', 'text');
            passwordIcon.attr('class', 'fas fa-unlock');
        } else {
            passwordField.attr('type', 'password');
            passwordIcon.attr('class', 'fas fa-lock');
        }
    });

    $('.show-confirm-password').on('click', function(){
        let confirmPasswordField = $('#confirm-password');
        let confirmPasswordIcon = $('#confirm-password-lock');
        if(confirmPasswordField.attr('type') === 'password'){
            confirmPasswordField.attr('type', 'text');
            confirmPasswordIcon.attr('class', 'fas fa-unlock');
        } else {
            confirmPasswordField.attr('type', 'password');
            confirmPasswordIcon.attr('class', 'fas fa-lock');
        }
    });
</script>
</body>
</html>
