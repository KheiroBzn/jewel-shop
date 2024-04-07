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
                    <h4 class="font-weight-light">Réinitialiser le mot de passe</h4>

                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif

                    <form class="pt-3" action="{{ route('forget.password.post') }}" method="POST">
                        @csrf
                        <input type="text" name="target" value="{{ $target }}" hidden>
                        <div class="form-group">
                            <label for="email_address" hidden>Email</label>
                            <input type="text" id="email_address" class="form-control form-control-lg"
                                name="email" placeholder="Email" required autofocus>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                Envoyer le lien de réinitialisation<br>du mot de passe
                            </button>
                        </div>
                    </form>

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