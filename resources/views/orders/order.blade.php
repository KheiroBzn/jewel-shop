@extends('layouts.layout')
@section('title', 'Commande')
@section('content')

    <!-- Start All Title Box -->
    <div class="all-title-box"
        style="background: url('{{ url('images/jewelry/cart/cart_banner.jpg') }}') no-repeat center center;background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Commande</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Commande</li>
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

                    @if(session('cart'))
                        <div class="col-sm-12 col-sm-6 col-lg-7 mb-3">
                            <div class="row">
                                <div class="odr-box">
                                    <div class="title-left">
                                        <h3>Panier</h3>
                                    </div>
                                    <div class="rounded p-2 bg-light">
                                        @foreach(session('cart') as $id => $details)
                                            @php $total += $details['price'] * $details['quantity'] @endphp

                                            <div class="media mb-2 border-bottom">
                                                <div class="media-body"> <a href="{{ route('products.show', [$details['categorieID'], $id]) }}"> {{ $details['name'] }}</a>
                                                    <div class="small text-muted">
                                                        Prix: {{ number_format(( $details['price'] ), 2)." DA" }}<span class="mx-2"> | </span> 
                                                        Quantité: {{ $details['quantity'] }}<span class="mx-2"> | </span>
                                                        Sous-Total: {{ number_format(( $details['price'] * $details['quantity'] ), 2)." DA" }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
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
                    <div class="col-sm-12 col-md-6 col-lg-5 mb-3">
                        <div class="row">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Commande</h3>
                                </div>
                                <div class="d-flex">
                                    <h4>Total hors taxes</h4>
                                    <div class="ml-auto font-weight-bold">{{ number_format( $total, 2)." DA" }}</div>
                                </div>
                                @php $taxes = $total * 5 / 100; @endphp
                                <div class="d-flex">
                                    <h4>Taxes ( TVA: 19% )</h4>
                                    <div class="ml-auto font-weight-bold">{{ number_format( $taxes, 2)." DA" }}</div>
                                </div>
                                <div class="d-flex">
                                    <h4>Frais de livraison ( {{ $location }} {{ ($delivery != 0 ? ' | Kazi-Tour' : '')  }})</h4>
                                    <div class="ml-auto font-weight-bold">{{ number_format( $delivery, 2)." DA" }}</div>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Total tous taxes</h5>
                                    <div class="ml-auto h5">{{ number_format( ( $total + $taxes + $delivery ), 2)." DA" }}</div>
                                </div>
                                <hr> 
                            </div>                            
                        </div>
                    </div>
                    <div class="col-12 d-flex shopping-box">
                        <a href="{{ route('order.apply') }}" class="ml-auto btn hvr-hover">Finaliser l'achat</a>
                    </div>
                </div>
    
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
