@extends('layouts.layout')
@section('title', 'Panier')
@section('content')

    <!-- Start All Title Box -->
    <div class="all-title-box"
        style="background: url('{{ url('images/jewelry/cart/cart_banner.jpg') }}') no-repeat center center;background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Panier</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Panier</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            {{-- Order Total --}}
            @php $total = 0 @endphp
            {{-- ########### --}}
            <div class="row">
                <div class="col-lg-12">                                        
                                
                    @if(session('cart'))
                        <div class="table-main table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Nom du produit</th>
                                        <th>Prix</th>
                                        <th>Quantité</th>
                                        <th>Sous-Total</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(session('cart') as $id => $details)
                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                        <tr data-id="{{ $id }}">

                                            <td data-th="Image" class="thumbnail-img">
                                                <a href="{{ route('products.show', [$details['categorieID'], $id]) }}">
                                                    <img class="img-fluid" src="{{ url($details['image']) }}" alt="" />
                                                </a>
                                            </td>
                                            <td data-th="Product" class="name-pr">
                                                <a href="{{ route('products.show', [$details['categorieID'], $id]) }}" class="product_name">{{ $details['name'] }}</a>
                                            </td> 

                                            <td data-th="Price" class="price-pr">
                                                {{ number_format(( $details['price'] ), 2)." DA" }}
                                            </td>
                                            <td data-th="Quantity" class="quantity-box">
                                                <input type="number" size="4" value="{{ $details['quantity'] }}" min="0" step="1" 
                                                        class="c-input-text qty text quantity update-cart">
                                            </td>
                                            <td data-th="Subtotal" class="total-pr">
                                                @php  @endphp
                                                <p>{{ number_format(( $details['price'] * $details['quantity'] ), 2)." DA" }}</p>
                                            </td>
                                            <td data-th="" class="remove-pr">
                                                <a role="button" class="remove-from-cart">
                                                <i class="fas fa-times"></i>
                                            </td>
                                        </tr>  

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert-danger text-center py-2">
                            <h4 class="py-2"><strong>Votre panier est vide!</strong></h4>                
                        </div>
                        <div class="row my-5">
                            <div class="col-12 d-flex shopping-box">
                                <a href="{{ url('/') }}" class="ml-auto btn hvr-hover"><i class="fa fa-angle-left"></i> Continuer votre visite</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>            

            @if (session('cart'))
                <div class="row my-5">
                    <div class="col-lg-8 col-sm-12"></div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="order-box">
                            <h3>Récapitulatif de la commande</h3>
                            <div class="d-flex">
                                <h4>Total Hors Taxes</h4>
                                <div class="ml-auto font-weight-bold">{{ number_format( $total, 2)." DA" }}</div>
                            </div>
                            <hr class="my-1">
                            @php $taxes = $total * 5 / 100; @endphp
                            <div class="d-flex">
                                <h4>Taxes (TVA:19%)</h4>
                                <div class="ml-auto font-weight-bold">{{ number_format( $taxes, 2)." DA" }}</div>
                            </div>
                            <hr>
                            <div class="d-flex gr-total">
                                <h5>Total Tous Taxes</h5>
                                <div class="ml-auto h5">{{ number_format( ($total + $taxes), 2)." DA" }}</div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="col-12 d-flex shopping-box">
                        <a href="{{ url('/') }}" class="ml-auto btn hvr-hover"><i class="fa fa-angle-left"></i> Continuer l'achat</a>
                        @auth
                            <a href="{{ route('order') }}" class="ml-auto btn hvr-hover">
                                Commander <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </a>
                        @endauth
                        @guest
                            <a href="{{ route('login', 'order') }}" class="ml-auto btn hvr-hover">
                                Commander <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </a>
                        @endguest
                    </div>
                </div>
            @endif

        </div>
    </div>
    <!-- End Cart -->

@endsection

@section('scripts')
<script type="text/javascript">
  
    $(".update-cart").change(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
  
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);

        var product = ele.parents("tr").find(".product_name").text()
  
        if(confirm("Voulez-vous vraiment supprimer <<"+product+">> de votre panier?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
  
</script>
@endsection
