@auth
    {{ redirect()->to('admin')->send() }}
@endauth
@guest
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Admin | Connexion</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ url('vendors/feather/feather.css') }}">
        <link rel="stylesheet" href="{{ url('vendors/ti-icons/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ url('vendors/css/vendor.bundle.base.css') }}">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ url('css/vertical-layout-light/style.css') }}">
        <!-- endinject -->
        <link rel="shortcut icon" href="{{ url('images/favicon.png') }}" />
    </head>

    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth px-0">
                    <div class="row w-100 mx-0">
                        <div class="col-lg-1 mx-auto"></div>
                        <div class="col-lg-6 mx-auto">
                            <img class="w-100" src="{{ url('images/dashboard/login.png') }}">
                        </div>
                        <div class="col-lg-4 mx-auto my-auto">
                            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                                <h4>Bienvenue dans l'espace Admin</h4>
                                <h6 class="font-weight-light">Réinitialiser le mot de passe</h6>

                                @if (Session::has('message'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('message') }}
                                    </div>
                                @endif

                                <form class="pt-3" action="{{ route('admin.forget.password.post') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email_address" hidden>Email</label>
                                        <input type="text" id="email_address" class="form-control form-control-lg"
                                            name="email" placeholder="Email" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            Envoyer le lien de réinitialisation du mot de passe
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
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="{{ url('vendors/js/vendor.bundle.base.js') }}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="{{ url('js/off-canvas.js') }}"></script>
        <script src="{{ url('js/hoverable-collapse.js') }}"></script>
        <script src="{{ url('js/template.js') }}"></script>
        <script src="{{ url('js/settings.js') }}"></script>
        <script src="{{ url('js/todolist.js') }}"></script>
        <!-- endinject -->
    </body>

    </html>
@endguest
