<!-- Start Main Top -->
<div class="main-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="text-slid-box">
                    <div id="offer-box" class="carouselTicker">

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="right-phone-box">
                    <p>Appelez-nous :- <a href="#"> +213 43 00 00 00</a></p>
                </div>
                <div class="our-link">
                    <ul>
                        <li><a href="#">Tlemcen, Algérie</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main Top -->

<!-- Start Main Top -->
<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header w-25">
                <div class="row">
                    <div class="col-lg-0 col-sm-12">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu"
                            aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div class="col-lg-12 col-sm-0">
                        <a class="navbar-brand" href="{{ route('home.index') }}"><img src="{{ url('images/logo.png') }}" class="logo img-fluid pt-1"
                            alt=""></a>
                    </div>
                </div>                
                
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="nav-item active"><a class="nav-link" href="{{ route('home.index') }}">Accueil</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about.index') }}">A propos-nous</a>
                    </li>
                    <li class="dropdown megamenu-fw">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Produits</a>
                        <ul class="dropdown-menu megamenu-content" role="menu">
                            <li>
                                <div class="row">

                                    @foreach ($categories as $cat)
                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                                            <div class="shop-cat-box">
                                                <img class="img-fluid" src="{{ url($cat->emplacement .'/'. $cat->nom .'.jpg') }}" alt="" />
                                                <a class="btn hvr-hover" href="{{ route('products.home', $cat->id) }}">{{ $cat->nom }}</a>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <!-- end row -->
                            </li>
                        </ul>
                    </li>
                    @auth
                        @if ( auth()->user()->role === 0 )
                            <li class="nav-item">
                                <a href="{{ route('admin.index') }}" class="nav-link">Tableau de board</a>
                            </li>                            
                        @else
                            <li class="dropdown" hidden>
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Boutique</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Panier</a></li>                            
                                    <li><a href="#">Commandes</a></li>
                                    <li><a href="#">Factures</a></li>
                                    <li><a href="#">Liste de souhaits</a></li>
                                    <li><a href="#">Adresse de livraison</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact.index') }}">Contactez-nous</a>
                            </li>
                        @endif                             
                    @endauth

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact.index') }}">Contactez-nous</a>
                        </li>
                    @endguest
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->

            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i></a>
                        <div class="dropdown-menu w-75">

                            @auth
                                @if ( auth()->user()->role === 0 )
                                    <a href="{{ route('admin.index') }}" class="dropdown-item">Tableau de board</a>
                                @else
                                    <a href="{{ route('user.index', auth()->user()->id) }}" class="dropdown-item">Mon profil</a>
                                @endif
                                <a href="{{ route('logout') }}" class="dropdown-item">Se déconnecter</a>                               
                            @endauth

                            @guest
                                <a href="{{ route('login', 'index') }}" class="dropdown-item">Se connecter</a>
                                <a href="{{ route('sign', 'index') }}" class="dropdown-item">S'inscrire</a>
                            @endguest
                            
                        </div>
                    </li>
                    <li class="side-menu">
                        <a href="{{ route('cart') }}">
                            <i class="fa fa-shopping-bag"></i>
                            @php $cart_count = count((array) session('cart')); @endphp
                            @if ( $cart_count > 0 )
                                <span class="badge badge-danger p-1 ml-2">{{ count((array) session('cart')) }}</span>
                            @endif                            
                        </a>
                    </li>
                    <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                </ul>
            </div>
            <!-- End Atribute Navigation -->
        </div>
        <!-- Start Side Menu -->
        <div class="side">
            <a href="#" class="close-side"><i class="fa fa-times"></i></a>
            <li class="cart-box">
                <ul class="cart-list">

                    @if(session('cart'))                        
                        @foreach(session('cart') as $id => $details)
                            <li>
                                <a href="{{ route('products.show', [$details['categorieID'], $id]) }}" class="photo">
                                    <img src="{{ url($details['image']) }}" class="cart-thumb" alt="" />
                                </a>
                                <h6><a href="{{ route('products.show', [$details['categorieID'], $id]) }}">{{ $details['name'] }}</a></h6>
                                <p>{{ $details['quantity'] }}x - <span class="price">{{ number_format($details['price'], 2)." DA " }}</span></p>
                            </li>
                        @endforeach
                        <li class="total">
                            @php $total = 0 @endphp
                            @foreach((array) session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                            @endforeach
                            <span class="float-right"><strong>Total</strong>: {{ number_format($total, 2)." DA " }}</span>
                            <a href="{{ route('cart') }}" class="btn btn-default hvr-hover btn-cart">VOIR PANIER</a>                    
                        </li>
                    @else
                        <li class="total text-center">
                            <span class=""><strong>Votre panier est vide!</strong></span>                   
                        </li>
                    @endif
                    
                </ul>
            </li>
        </div>
        <!-- End Side Menu -->
    </nav>
    <!-- End Navigation -->
</header>
<!-- End Main Top -->

<!-- Start Top Search -->
<div class="top-search">
    <div class="container">
        <form action="{{ route('home.search') }}" class="input-group w-50 mx-auto">
            <button class="input-group-addon" type="submit"><i class="fa fa-search"></i></button>
            <input type="text" class="form-control" placeholder="Rechercher" name="homeSearch">
            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
        </form>
    </div>
</div>
<!-- End Top Search -->
