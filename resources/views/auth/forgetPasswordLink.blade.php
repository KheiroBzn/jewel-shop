@auth
    <script>
        window.location = "{{ route('home.index') }}";
    </script>
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

                            <form action="{{ route('reset.password.post') }}" method="POST">
                                @csrf
                                <input type="text" name="target" value="{{ $target }}" hidden>
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group">
                                    <label for="email_address" hidden>Email</label>
                                    <input type="text" id="email_address" class="form-control form-control-lg"
                                        name="email" placeholder="Email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password" hidden>Mot de passe</label>
                                    <input type="password" id="password" class="form-control form-control-lg"
                                        name="password" placeholder="Mot de passe" required autofocus>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" hidden>Confirmer le mot de passe</label>
                                    <input type="password" id="password-confirm" class="form-control form-control-lg"
                                        name="password_confirmation" placeholder="Confirmer le mot de passe" required
                                        autofocus>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        Réinitialiser le mot de passe
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
