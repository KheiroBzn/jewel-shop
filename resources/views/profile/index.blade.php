@auth
    @extends('layouts.layout')
    @section('title', 'Profil')
    @section('content')
    @include('partials.profileNav')

        <div><hr></div>

        <div class="row px-4">
            <div class="card container-fluid px-0">
                <div class="card-header rounded-top">
                    <h3 class="mt-2"><i class="fas fa-cart-shopping"></i> Mes commandes en cours</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#Référence</th>
                                    <th>Détails</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th>Etat</th>
                                    <th class="text-center"><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->reference }}</td>
                                        <td>
                                            @php
                                                $ordersDetails = App\Models\OrderDetails::where('id_commande', $order->id)
                                                    ->join('products', 'products.id', '=', 'order_details.id_bijou')
                                                    ->get();
                                                $catID = 1;
                                            @endphp
                                            
                                            @foreach ($ordersDetails as $product)
                                                @foreach ($categories as $cat)
                                                    @if ($cat->nom == $product->categorie)
                                                        @php $$catID = $cat->id; @endphp
                                                    @endif
                                                @endforeach
                                                <div class="row">
                                                    <a href="{{ route('products.show', [$catID, $product->id_bijou]) }}">{{ $product->nom }}</a>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td class="">
                                            {{ number_format(( $order->total ), 2)." DA" }}
                                        </td>
                                        <td>
                                            {{ $order->created_at->format('Y-m-d | H:i'); }}
                                        </td>
                                        <td>
                                            @php
                                                $badge = '';
                                                if ($order->etat == 'en_attente') {
                                                    $badge = 'badge-info';
                                                    $text = 'En Attente';
                                                } elseif ($order->etat == 'validee') {
                                                    $badge = 'badge-dark';
                                                    $text = 'Valide';
                                                } elseif ($order->etat == 'annulee') {
                                                    $badge = 'badge-danger';
                                                    $text = 'Annulé';
                                                } elseif ($order->etat == 'retour') {
                                                    $badge = 'badge-secondary';
                                                    $text = 'Retour';
                                                } elseif ($order->etat == 'livree') {
                                                    $badge = 'badge-success';
                                                    $text = 'Livrée';
                                                } elseif ($order->etat == 'en_livraison') {
                                                    $badge = 'badge-primary';
                                                    $text = 'En livraison';
                                                } else {
                                                    $badge = 'badge-warning';
                                                    $text = 'Inconnue';
                                                }
                                            @endphp

                                            <h3 class="badge {{ $badge }} font-weight-bold" >{{ $text }}</h3>
                                        </td>
                                        <td class="text-center">

                                            @if( $order->etat == 'en_attente' )
                                                <a class="btn btn-primary btn-sm" href="{{ route('user.orderPay', [$client, $order]) }}">Confirmer paiement</a>
                                            @elseif ( $order->etat == 'en_livraison' or $order->etat == 'livree' )
                                                @php
                                                    $invoice = App\Models\Invoice::where('id_commande', $order->id)->first();
                                                @endphp
                                                <a href="{{ route('user.printInvoice', $invoice->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-print"></i> Imprimer
                                                </a>
                                            @elseif ( $order->etat == 'validee' )
                                                <h4>
                                                    En cours de livraison
                                                </h4>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if( $order->count() == 0 ) 
                        <h4 class="text-center">Aucune commande</h4>
                    @endif
                </div>
            </div>
        </div>

        <div><hr></div>
            
    @include('partials.profileFooter')

@endsection
{{-- {{ redirect()->to('user')->send() }} --}}
{{-- {{ Redirect::to('user.index') }} --}}
@endauth

@guest
<script>
    window.location = "{{ route('home.index') }}";
</script>
@endguest
