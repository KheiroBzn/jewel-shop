@extends('layouts.layout')
@section('title', $categorie->nom.' | '.$product->nom)
@section('content')

    <!-- Start All Title Box -->
    <div class="all-title-box"
        style="background: url('{{ url($categorie->emplacement .'/banner/'. $categorie->nom .'.jpg') }}') no-repeat center center;background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{ $product->nom }}</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Accueil</a></li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('products.home', $categorie->id) }}">{{ $categorie->nom }}</a></li>
                        <li class="breadcrumb-item active">{{ $product->nom }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img class="d-block w-100"
                                    src="{{ url('images/jewelry/' . $product->categorie . '/' . $product->nom . '/' . $product->nom . ' img1.jpg') }}"
                                    alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100"
                                    src="{{ url('images/jewelry/' . $product->categorie . '/' . $product->nom . '/' . $product->nom . ' img2.jpg') }}"
                                    alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100"
                                    src="{{ url('images/jewelry/' . $product->categorie . '/' . $product->nom . '/' . $product->nom . ' img3.jpg') }}"
                                    alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carousel-example-1" role="button"
                            data-slide="prev">
                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                            <span class="sr-only">Précédent</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button"
                            data-slide="next">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                            <span class="sr-only">Suivant</span>
                        </a>
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-1" data-slide-to="0" class="active">
                                <img class="d-block w-100 img-fluid"
                                    src="{{ url('images/jewelry/' . $product->categorie . '/' . $product->nom . '/' . $product->nom . ' img1.jpg') }}"
                                    alt="" />
                            </li>
                            <li data-target="#carousel-example-1" data-slide-to="1">
                                <img class="d-block w-100 img-fluid"
                                    src="{{ url('images/jewelry/' . $product->categorie . '/' . $product->nom . '/' . $product->nom . ' img2.jpg') }}"
                                    alt="" />
                            </li>
                            <li data-target="#carousel-example-1" data-slide-to="2">
                                <img class="d-block w-100 img-fluid"
                                    src="{{ url('images/jewelry/' . $product->categorie . '/' . $product->nom . '/' . $product->nom . ' img3.jpg') }}"
                                    alt="" />
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2>{{ $product->nom }}</h2>

                        @php
                            $old_price = '';
                            $new_price = number_format($product->prix_vente, 2)." DA";
                        @endphp

                        @foreach ($current_promotions as $promotion)
                            @if ( $promotion->id_article == $product->id )
                                <div class="type-lb">
                                    <p class="sale">Promotion: -{{ $promotion->reduction }}%</p>
                                </div>
                                @php
                                    $old_price = number_format($promotion->ancien_prix_vente, 2)." DA ";
                                    $new_price = number_format($promotion->nouveau_prix_vente, 2)." DA";
                                @endphp
                                @break
                            @endif
                        @endforeach 

                        <h5><del>{{ $old_price }}</del>{{ $new_price }}</h5>

                        <p class="available-stock">
                            <span> En stock ( {{ $product->stock }} ) </a></span>
                        </p>
                        <h4>Description:</h4>
                        <p>{{ $product->description }}</p>
                        <ul hidden>
                            <li>
                                <div class="form-group quantity-box">
                                    <label class="control-label">Quantité</label>
                                    <input class="form-control" value="0" min="0"
                                        max="{{ $product->stock }}" type="number">
                                </div>
                            </li>
                        </ul>

                        <div class="price-box-bar">
                            <div class="cart-and-bay-btn">
                                <a href="{{ route('add.to.cart', $product->id) }}" class="btn hvr-hover">Ajouter au panier</a>
                            </div>
                        </div>

                        <div class="add-to-btn">
                            <div class="share-bar">
                                <a class="btn hvr-hover" href="#"><i class="fab fa-facebook"
                                        aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="#"><i class="fab fa-instagram"
                                        aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="#"><i class="fab fa-linkedin"
                                        aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp"
                                        aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Produits similaires</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                    </div>
                    <div class="featured-products-box owl-carousel owl-theme">

                        @foreach ($catProducts as $product)
                            <div class="item">
                                <div class="products-single fix">
                                    <div class="box-img-hover">

                                        @php
                                            $old_price = '';
                                            $new_price = number_format($product->prix_vente, 2)." DA";
                                        @endphp

                                        @foreach ($current_promotions as $promotion)
                                            @if ( $promotion->id_article == $product->id )
                                                <div class="type-lb">
                                                    <p class="sale">Promotion: -{{ $promotion->reduction }}%</p>
                                                </div>
                                                @php
                                                    $old_price = number_format($promotion->ancien_prix_vente, 2)." DA ";
                                                    $new_price = number_format($promotion->nouveau_prix_vente, 2)." DA";
                                                @endphp
                                                @break
                                            @endif
                                        @endforeach

                                        <img src="{{ url('images/jewelry/' . $product->categorie . '/' . $product->nom . '/' . $product->nom . ' img1.jpg') }}"
                                            class="img-fluid" alt="Image">
                                        <div class="mask-icon">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('products.show', [$categorie->id, $product->id]) }}"
                                                        data-toggle="tooltip" data-placement="right" title="Voir">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                            <a href="{{ route('add.to.cart', $product->id) }}" class="cart">Ajouter au panier</a>
                                        </div>
                                    </div>
                                    <div class="why-text">
                                        <h4>{{ $product->nom }}</h4>
                                        <h5><del>{{ $old_price }}</del>{{ $new_price }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

    <!-- Start Instagram Feed  -->
    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/1.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/2.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/3.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/4.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/5.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/6.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/7.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/8.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/9.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/10.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Instagram Feed  -->

@endsection