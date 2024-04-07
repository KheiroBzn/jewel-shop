@extends('admin.layouts.layout')
@section('title', 'Commande')
@section('content')

  <div class="row my-4 d-flex p-2">
    <div class="col-12 mx-auto my-auto">
      <div class="card">
        <div class="card-header rounded-top bg-secondary bg-gradient">
            <p class="card-title mb-0 text-light text-center">Reçu de paiement</p>
        </div>
        <div class="card-body row">

            <div class="col-8">
                <img src="{{ url($image->emplacement.'/'.$image->nom) }}" alt="" class="img-fluid">
            </div>
            
            <div class="card-footer bg-white">                

                @if ( $order->etat == 'en_attente' )
                  <a href="{{ route('orders.validate', $order->id) }}" class="btn btn-success btn-sm float-right mx-2" onclick="return validateOrderConfirmation();">Valider <i class="fas fa-check"></i></a>
                  <a href="{{ route('orders.cancel', $order->id) }}" class="btn btn-warning btn-sm float-right mx-2" onclick="return cancelOrderConfirmation();">Annuler <i class="fas fa-cancel"></i></a>
                @elseif ( $order->etat == 'validee' )
                  <a href="{{ route('orders.deliver', $order->id) }}" class="btn btn-primary btn-sm float-right mx-2" onclick="return deliverOrderConfirmation();">Mettre en livraison <i class="fas fa-cart-shopping"></i></a>
                @elseif ( $order->etat == 'en_livraison' )
                  <a href="{{ route('orders.success', $order->id) }}" class="btn btn-dark btn-sm float-right mx-2" onclick="return successOrderConfirmation();">Marquer comme livrée <i class="fas fa-check-double"></i></a>
                  <a href="{{ route('orders.back', $order->id) }}" class="btn btn-secondary btn-sm float-right mx-2" onclick="return backOrderConfirmation();">Marquer comme retour <i class="fas fa-delete-left"></i></a>
                @elseif ( $order->etat == 'annulee' )
                <a href="{{ route('orders.cancel', $order->id) }}" class="btn btn-danger btn-sm float-right mx-2" onclick="return deleteOrderConfirmation();">Supprimer <i class="fas fa-trash"></i></a>
                @endif
            </div>
        </div>
      </div>
    </div>        
  </div> 

@endsection