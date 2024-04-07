@extends('layouts.layout')
@section('title', 'Accueil')
@section('content')

    <!-- Start Slider -->
    <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">

            @foreach ($current_promotions as $promotion)
                <li class="text-left">
                    <img src="{{ url('images/jewelry/promotions/'.$promotion->nom.'/'.$promotion->date_debut.' - '.$promotion->nom.'/'.$promotion->date_debut.'_'.$promotion->nom.'.jpg') }}" alt="">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="m-b-20"><strong>{{ $promotion->nom }} <br><span class="badge badge-danger bg-gradient">-{{ $promotion->reduction }}%</span></strong></h1>
                                <p class="m-b-40">{{ $promotion->description }}.</p>
                                @php
                                    $catID = 1;
                                    foreach ($categories as $cat) {
                                        if ( $cat->nom == $promotion->categorie ) {
                                            $catID = $cat->id;
                                            break;
                                        }
                                    }
                                @endphp
                                <p><a class="btn hvr-hover float-right" href="{{ route('products.show', [$catID, $promotion->id_article]) }}">Découvrir</a></p>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- End Slider -->

    <!-- Start Categories  -->
    <div class="categories-shop">
        <div class="container">
            <div class="row">

                @foreach ($categories as $cat)
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="shop-cat-box">
                            <img class="img-fluid" src="{{ url($cat->emplacement .'/'. $cat->nom .'.jpg') }}" alt="" />
                            <a class="btn hvr-hover" href="{{ route('products.home', $cat->id) }}">{{ $cat->nom }}</a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- End Categories -->

    <!-- Start Products  -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Produits populaires</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*">Tous</button>
                            <button data-filter=".top-featured">En vedette</button>
                            <button data-filter=".best-seller">Meilleures ventes</button>
                            <button data-filter=".current-promotions">Promotions</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row special-list">

                @foreach ($randomProducts as $product)
                    <div class="col-lg-3 col-md-6 special-grid best-seller">
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
                                        @foreach ($categories as $cat)
                                            @if ($cat->nom == $product->categorie)
                                                    <li><a href="{{ route('products.show', [$cat->id, $product->id]) }}"
                                                            data-toggle="tooltip" data-placement="right" title="Voir"><i
                                                                class="fas fa-eye"></i></a></li>
                                                @break
                                            @endif
                                        @endforeach
                                    </ul>
                                    <a href="{{ route('add.to.cart', $product->id) }}" class="cart">Ajouter au panier</a>
                                </div>
                            </div>
                            <div class="why-text">
                                <h4>{{ $product->nom }}</h4>
                                <h5><del class="text-danger">{{ $old_price }}</del>{{ $new_price }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach

                @foreach ($top_featured as $product)
                    <div class="col-lg-3 col-md-6 special-grid top-featured">
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
                                        @foreach ($categories as $cat)
                                            @if ($cat->nom == $product->categorie)
                                                <li><a href="{{ route('products.show', [$cat->id, $product->id]) }}"
                                                        data-toggle="tooltip" data-placement="right" title="Voir">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </li>
                                                @break
                                            @endif
                                        @endforeach
                                    </ul>
                                    <a href="{{ route('add.to.cart', $product->id) }}" class="cart">Ajouter au panier</a>
                                </div>
                            </div>
                            <div class="why-text">
                                <h4>{{ $product->nom }}</h4>
                                <h5><del class="text-danger">{{ $old_price }}</del>{{ $new_price }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach

                @foreach ($current_promotions as $promotion)
                    <div class="col-lg-3 col-md-6 special-grid current-promotions">
                        <div class="products-single fix">
                            <div class="box-img-hover">

                                <div class="type-lb">
                                    <p class="sale">Promotion: -{{ $promotion->reduction }}%</p>
                                </div>

                                <img src="{{ url('images/jewelry/' . $promotion->categorie . '/' . $promotion->nom . '/' . $promotion->nom . ' img1.jpg') }}"
                                    class="img-fluid" alt="Image">
                                <div class="mask-icon">
                                    <ul>
                                        @foreach ($categories as $cat)
                                            @if ($cat->nom == $promotion->categorie)
                                                <li><a href="{{ route('products.show', [$cat->id, $promotion->id_article]) }}"
                                                        data-toggle="tooltip" data-placement="right" title="Voir">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </li>
                                                @break
                                            @endif
                                        @endforeach
                                    </ul>
                                    <a href="{{ route('add.to.cart', $product->id) }}" class="cart">Ajouter au panier</a>
                                </div>
                            </div>
                            <div class="why-text">
                                <h4>{{ $promotion->nom }}</h4>
                                <h5>
                                    <del class="text-danger">{{ number_format($promotion->ancien_prix_vente, 2)." DA " }}</del><br>
                                    <span>{{ number_format($promotion->nouveau_prix_vente, 2)." DA" }}</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- End Products  -->

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
