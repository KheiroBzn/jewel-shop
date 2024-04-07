@extends('admin.layouts.layout')
@section('title', 'Commande')
@section('content')

  <div class="row my-4 d-flex p-2">
    <div class="col-12 mx-auto my-auto">
      <div class="card">
        <div class="card-header rounded-top bg-secondary bg-gradient">
            <p class="card-title mb-0 text-light text-center">Informations de la commande #{{ $order->reference }}</p>
        </div>
        <div class="card-body row">
            <div class="col-lg-5 col-md-12 col-sm-12 mx-auto">
                <div class="row w-60 mx-auto my-auto">
                    <div class="col-lg-3 text-secondary">
                        <h6>REF:</h6>
                    </div>
                    <div class="col-lg-9 text-info">
                        <h6 class="float-right">{{ $order->reference }}</h6>
                    </div>
                    <hr>
                </div>
                <div class="row w-60 mx-auto my-auto">
                  <div class="col-lg-3 text-secondary">
                      <h6>Client:</h6>
                  </div>
                  <div class="col-lg-9 text-info">
                      <a href="{{ route('clients.show', $client->id) }}">
                        <h6 class="float-right">{{ $client->nom }} {{ $client->prenom }} | {{ $client->tel }} | {{ $client->adresse }}</h6>
                      </a>
                  </div>
                  <hr>
              </div>
                <div class="row w-60 mx-auto my-auto">
                    <div class="col-lg-3 text-secondary">
                        <h6>Date:</h6>
                    </div>
                    <div class="col-lg-9 text-info">
                        <h6 class="float-right">{{ $order->created_at->format('Y-m-d | H:i'); }}</h6>
                    </div>
                    <hr>
                </div>
                <div class="row w-60 mx-auto my-auto">
                    <div class="col-lg-3 text-secondary">
                        <h6>Etat:</h6>
                    </div>
                    <div class="col-lg-9 text-info">
                        @switch($order->etat)
                            @case('en_attente')
                                <h4 class="badge badge-info float-right">En attente</h4>
                                @break
                            @case('validee')
                                <h4 class="badge badge-dark float-right">Valide</h4>
                                @break
                            @case('annulee')
                                <h4 class="badge badge-danger float-right">Annulé</h4>
                                @break
                            @case('retour')
                                <h4 class="badge badge-secondary float-right">Retour</h4>
                                @break
                            @case('livree')
                                <h4 class="badge badge-success float-right">Livré</h4>
                                @break
                            @case('en_livraison')
                                <h4 class="badge badge-primary float-right">En livraison</h4>
                                @break
                            @default
                                <h4 class="badge badge-warning float-right">Inconnue</h4>
                                
                        @endswitch
                    </div>
                </div>
            </div>
            
            <div class="col-lg-5 col-md-12 col-sm-12 mx-auto">
              <div class="row w-60 mx-auto my-auto">
                  <div class="col-lg-4 text-secondary">
                      <h6>Facture:</h6>
                  </div>
                  <div class="col-lg-8 text-info">
                      <h6 class="float-right">{{ $invoice->reference }}</h6>
                  </div>
              </div>
              <div class="row"><hr></div>
              <div class="row w-60 mx-auto my-auto">
                <div class="col-lg-4 text-secondary">
                    <h6>Total HT:</h6>
                </div>
                <div class="col-lg-8 text-info">
                    <h6 class="float-right">{{ number_format($invoice->montant_HT, 2) }} DA</h6>
                </div>
              </div>
              <div class="row"><hr></div>
              <div class="row w-60 mx-auto my-auto">
                  <div class="col-lg-4 text-secondary">
                      <h6>Taxe (TVA {{ $invoice->taux_TVA }}%):</h6>
                  </div>
                  <div class="col-lg-8 text-info">
                      <h6 class="float-right">{{ number_format($invoice->montant_TVA, 2) }} DA</h6>
                  </div>
              </div>
              <div class="row"><hr></div>
              <div class="row w-60 mx-auto my-auto">
                <div class="col-lg-4 text-secondary">
                    <h6>Total TTC:</h6>
                </div>
                <div class="col-lg-8 text-info">
                    <h6 class="float-right">{{ number_format($invoice->montant_TTC, 2) }} DA</h6>
                </div>
              </div>
              <div class="row"><hr></div>
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

  <div class="row my-4 d-flex p-2">
    <div class="col-12 mx-auto my-auto">
      <div class="card">
        <div class="card-header rounded-top bg-secondary bg-gradient">
            <p class="card-title mb-0 text-light text-center">Détails de la commande #{{ $order->reference }}</p>
        </div>
        <div class="card-body row">
          @php $cpt = 1; @endphp
          @foreach ($orderDetails as $product)
            <div class="col-lg-7 col-md-7 col-sm-8 mx-auto">
              <div class="row w-60 mx-auto my-auto">
                  <div class="col-lg-3 text-secondary">
                      <h6>Produit :</h6>
                  </div>
                  <div class="col-lg-9 text-info">
                    <a href="{{ route('products.details', $product->id) }}">
                      <h6 class="float-right">{{ $product->nom }}</h6>
                    </a>                      
                  </div>
              </div>
              <div class="row"><hr></div>
              <div class="row w-60 mx-auto my-auto">
                <div class="col-lg-3 text-secondary">
                    <h6>Prix:</h6>
                </div>
                <div class="col-lg-9 text-info">
                  <h6 class="float-right">{{ number_format($product->prix_unitaire, 2) }} DA</h6>
                </div>
              </div>
              <div class="row"><hr></div>
              <div class="row w-60 mx-auto my-auto">
                <div class="col-lg-3 text-secondary">
                    <h6>Quantité:</h6>
                </div>
                <div class="col-lg-9 text-info">
                  <h6 class="float-right">{{ $product->qte }}</h6>
                </div>
              </div>
              <div class="row"><hr></div>
              <div class="row w-60 mx-auto my-auto">
                  <div class="col-lg-3 text-secondary">
                      <h6>Sous-total:</h6>
                  </div>
                  <div class="col-lg-9 text-info">
                    <h6 class="float-right">{{ number_format($product->sous_total, 2) }} DA</h6>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-2 mx-auto">
              @php $rowID = 'carousel-example-'.$cpt; $cpt++; @endphp
              <div id="{{ $rowID }}" class="single-product-slider carousel slide" data-ride="carousel">
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
                  <a class="carousel-control-prev" href="#{{ $rowID }}" role="button"
                      data-slide="prev">
                      <i class="fa fa-angle-left" aria-hidden="true"></i>
                      <span class="sr-only">Précédent</span>
                  </a>
                  <a class="carousel-control-next" href="#{{ $rowID }}" role="button"
                      data-slide="next">
                      <i class="fa fa-angle-right" aria-hidden="true"></i>
                      <span class="sr-only">Suivant</span>
                  </a>
                  <ol class="carousel-indicators" style="background: transparent;">
                      <li data-target="#{{ $rowID }}" data-slide-to="0" class="active">
                          <img class="d-block w-100 img-fluid"
                              src="{{ url('images/jewelry/' . $product->categorie . '/' . $product->nom . '/' . $product->nom . ' img1.jpg') }}"
                              alt="" />
                      </li>
                      <li data-target="#{{ $rowID }}" data-slide-to="1">
                          <img class="d-block w-100 img-fluid"
                              src="{{ url('images/jewelry/' . $product->categorie . '/' . $product->nom . '/' . $product->nom . ' img2.jpg') }}"
                              alt="" />
                      </li>
                      <li data-target="#{{ $rowID }}" data-slide-to="2">
                          <img class="d-block w-100 img-fluid"
                              src="{{ url('images/jewelry/' . $product->categorie . '/' . $product->nom . '/' . $product->nom . ' img3.jpg') }}"
                              alt="" />
                      </li>
                  </ol>
              </div>
          </div>
          <div class="row my-2"><hr></div>
          @endforeach 
        </div>
      </div>
    </div>        
  </div> 

@endsection