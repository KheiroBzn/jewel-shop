<div class="container-fluid page-body-wrapper px-0 mx-0 w-100">
    <div id="layoutSidenav" class="row mx-0 px-0">

        <div class="col-lg-2 col-md-3 col-sm-12 px-0">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading" hidden>Core</div>
                        <a class="nav-link" href="{{ route('user.index', $user->id) }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Ma page d'accueil
                        </a>
                        <a class="nav-link" href="{{ route('user.accountShow', $user->id) }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Mon compte
                        </a>
                        <a class="nav-link" href="{{ route('user.ordersShow', $user->id) }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-cart-shopping"></i></div>
                            Mes commandes
                        </a>
                        <a class="nav-link" href="index.html" hidden>
                            <div class="sb-nav-link-icon"><i class="fas fa-file-invoice"></i></div>
                            Mes factures
                        </a>
                        <a class="nav-link" href="index.html" hidden>
                            <div class="sb-nav-link-icon"><i class="fas fa-location-dot"></i></div>
                            Mon adresse de livraison
                        </a>
                        <div class="sb-sidenav-footer">
                            <a class="nav-link" href="{{ route('logout') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-right-from-bracket"></i></div>
                                Se déconnecter
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        
        <div id="layoutSidenav_content" class="col-lg-10 col-md-9 col-sm-12 mx-0">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Bienvenue {{ $client->prenom }}</h1>
                    <ul class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Profil: {{ $client->prenom }}</li>
                    </ul>
                    <div class="card mb-4">
                        
                    </div>
                </div>