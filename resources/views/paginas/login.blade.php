<body class="login-page" style="min-height: 512.391px;">

  <div class="login-box">

    <div class="login-logo">

      Sistema Inversiones Mana Azur Hashem

    </div>

    <!-- /.login-logo -->

    <div class="card">

      <div class="card-body login-card-body">

        <p class="login-box-msg">Iniciar Sesión</p>

        <form method="POST" action="{{ route('login') }}">
          @csrf

          {{-- email --}}

          <div class="input-group mb-3">
            
              <div class="input-group-append">
                
                <div class="input-group-text">
                  
                  <i class="fas fa-envelope"></i>

                </div>

              </div>

              <input id="email" type="email" class="form-control email_login @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

          </div>

          {{-- password --}}

          <div class="input-group mb-3">
            
              <div class="input-group-append">
                
                <div class="input-group-text">
                  
                  <i class="fas fa-key"></i>

                </div>

              </div>

              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

          </div>

          <div class="text-center">
            
            <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>

          </div>
      </form>
    
    </div>
  </div>

<script src="{{url('/')}}/js/login.js"></script>

</body>