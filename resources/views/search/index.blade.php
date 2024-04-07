@extends('layouts.layout')
@section('title', 'Accueil | Recherche')
@section('content')

    <!-- Start All Title Box -->
    <div class="all-title-box" style="background: url('images/jewelry/search/search_banner.jpg') no-repeat center center;background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Recherche</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Recherche</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left" hidden>
                    <div class="product-categori">
                        <div class="search-product">
                            <form action="#">
                                <input class="form-control" placeholder="Rechercher ici..." type="text">
                                <button type="submit"> <i class="fa fa-search"></i> </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        
                        @if ( $search != '' )
                            <div class="product-item-filter row ">
                                @if ( $products->count() > 0 )
                                    <div class="alert-success my-2 p-2 ">
                                        <p class="w-100 text-center">Résultat de recherche pour " {{ $search }} " : {{ $products->count() }} Produit(s) trouvé(s)</p>
                                    </div>
                                @else
                                    <div class="alert-danger my-2 p-2">
                                        <p class="w-100 text-center">Aucun produit correspond à votre recherche " {{ $search }} "</p>
                                    </div>
                                @endif  
                                <div class="row product-categorie-box">
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                            <div class="row">
        
                                                @foreach ($products as $product)
                                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                                        <div class="products-single fix">
                                                            <div class="box-img-hover">
        
                                                                @php
                                                                    $old_price = '';
                                                                    $new_price = number_format($product->prix_vente, 2)." DA";
                                                                    $image = 'images/jewelry/'.$product->categorie.'/'.$product->nom.'/'.$product->nom.' img1.jpg';
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
        
                                                                <img src="{{ url($image) }}"
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
                                                                        <li><a href="#" data-toggle="tooltip"
                                                                                data-placement="right"
                                                                                title="+ Liste de souhaits"><i
                                                                                    class="far fa-heart"></i></a></li>
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
        
                                            </div>
                                        </div>
        
                                        {{-- <div role="tabpanel" class="tab-pane fade" id="list-view" >
        
                                            @foreach ($catProducts as $product)
                                                <div class="list-view-box">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
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
                                                                            <li><a href="{{ route('products.show', [$categorie->id, $product->id]) }}"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="right" title="Voir"><i
                                                                                        class="fas fa-eye"></i></a></li>
                                                                            <li><a href="#" data-toggle="tooltip"
                                                                                    data-placement="right"
                                                                                    title="+ Liste de souhaits"><i
                                                                                        class="far fa-heart"></i></a></li>
                                                                        </ul>
        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                            <div class="why-text full-width">
                                                                <h4>{{ $product->nom }}</h4>
                                                                <h5><del>{{ $old_price }}</del>{{ $new_price }}</h5>
                                                                <p>{{ $product->description }}.</p>
                                                                <a href="{{ route('add.to.cart', $product->id) }}" class="btn hvr-hover">Ajouter au panier</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="d-flex justify-content-center">
                                                {!! $catProducts->links() !!}
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>  
                            </div> 
                        @else
                            <script>window.location = "/";</script>                       
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->

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

@section('scripts')
<script type="text/javascript">
  

  
</script>
@endsection
