@auth
  <script>window.location = "{{ route('home.index') }}";</script>
@endauth
@guest

    @extends('layouts.layout')
    @section('title', 'Connexion')
    @section('content')

      <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
              <div class="col-lg-1 mx-auto"></div>
              <div class="col-lg-6 mx-auto p-3">
                <img class="w-100" src="{{ url('images/auth/auth.png') }}">
              </div>
              <div class="col-lg-4 mx-auto my-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                  <h4 class="font-weight-light">Connectez-vous pour continuer</h4>
                  <form class="pt-3" action="{{ route('hundleLogin') }}" method="POST">
                    @csrf
                    <input type="text" name="target" value="{{ $target }}" hidden>
                    <div class="form-group">
                      <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                      @error('email')
                        <div class="form-error">
                            {{$message}}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Mot de passe">
                      @error('password')
                        <div class="form-error">
                            {{$message}}
                        </div>
                      @enderror
                    </div>
                    <div class="mt-3">
                      <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="SE CONNECTER">
                    </div>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                      <div class="form-check">
                        <label class="form-check-label text-muted">
                          <input type="checkbox" name="remember" class="form-check-input">
                          Se souvenir de moi
                        </label>
                      </div>
                      <a href="{{ route('forget.password.get', $target) }}" class="auth-link text-black">Mot de passe oublié?</a>
                    </div>
                  </form>

                  <div class="my-2 align-items-center">
                    <div class="text-center">
                      <h4>Nouveau?</h4>
                    </div>
                    <div>
                      <a href="{{ route('sign', $target) }}" class="btn btn-secondary btn-block btn-lg font-weight-medium">S'INSCRIRE</a>
                    </div>
                  </div>

                </div>
              </div>
              <div class="col-lg-1 mx-auto"></div>          
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
    @endsection
@endguest