@auth
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row navbar-dark">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center bg-dark">
                <a class="navbar-brand brand-logo mr-5" href="{{ route('home.index') }}"><img
                        src="{{ url('images/logo/logo.svg') }}" class="mr-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="{{ route('home.index') }}"><img
                        src="{{ url('images/logo/logo-mini.svg') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item">
                        <h4>Bienvenue {{ $admin->nom }}</h4>
                    </li>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="{{ url('images/faces/face0.jpg') }}" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ route('profile.index') }}">
                                <i class="ti-settings text-primary"></i>
                                Paramètres
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="ti-power-off text-primary"></i>
                                Se déconnecter
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <div class="container-fluid page-body-wrapper px-0 mx-0">
            <div id="layoutSidenav" >
                
                <div id="layoutSidenav_nav" >
                    <nav class="sb-sidenav sb-sidenav-dark sidebar-offcanvas active" id="sidebar" >
                        <div class="sb-sidenav-menu">
                            <div class="nav">
                                <div class="sb-sidenav-menu-heading" hidden>Core</div>
                                <a class="nav-link nav-item" href="{{ route('admin.index') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-gauge"></i></div>
                                    Tableau de board
                                </a>
                                <a class="nav-link" href="{{ route('products.index') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-gem"></i></div>
                                    Produits
                                </a>
                                <a class="nav-link" href="{{ route('clients.index') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Clients
                                </a>
                                <a class="nav-link" href="{{ route('orders.index') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-cart-shopping"></i></div>
                                    Commandes
                                </a>
                                <a class="nav-link" href="{{ route('invoices.index') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-file-invoice"></i></div>
                                    Factures
                                </a>
                                <a class="nav-link" href="{{ route('promotions.index') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-rectangle-ad"></i></div>
                                    Promotions
                                </a>
                                <a class="nav-link" href="{{ route('suppliers.index') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-boxes-packing"></i></div>
                                    Fournisseurs
                                </a>
                                <a class="nav-link" href="{{ route('supply.index') }}" hidden>
                                    <div class="sb-nav-link-icon"><i class="fas fa-clock-rotate-left"></i></div>
                                    Approvisionnements
                                </a>
                                <a class="nav-link" href="{{ route('statistics.index') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-chart-pie"></i></div>
                                    Statistiques
                                </a>                                
                                <div class="sb-sidenav-footer">
                                    <a class="nav-link" href="{{ route('home.index') }}" target="_blank">
                                        <div class="sb-nav-link-icon">
                                            <i class="fas fa-angle-left"></i>
                                        </div>
                                        Revenir au site
                                    </a>
                                    <a class="nav-link" href="{{ route('profile.index') }}">
                                        <div class="sb-nav-link-icon">
                                            <i class="fas fa-cog"></i>
                                        </div>
                                        Paramètres
                                    </a>
                                    <a class="nav-link" href="{{ route('logout') }}">
                                        <div class="sb-nav-link-icon">
                                            <i class="fas fa-right-from-bracket"></i>
                                        </div>
                                        Se déconnecter
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>    
    
                <div id="layoutSidenav_content" >

                    <main class="">
                        <div class="container bg-light vw-100 pr-4">
                            <ul class="breadcrumb mb-1 bg-light bg-gradient border border-0">
                                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Accueil</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Tableau de board</a> | Admin : {{ $admin->prenom }}</li>
                            </ul>
                            <div class="card">
                                
                            </div>
                        </div>

                        <div class="container bg-light vw-100 pr-4">

@endauth
