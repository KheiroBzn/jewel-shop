@extends('admin.layouts.layout')
@section('title', 'Fournisseurs')
@section('content')

        <div class="row my-4 mx-auto">
            <div class="col-md-12 mx-auto my-auto">

                <div class="card">
                    <div class="card-header rounded-top bg-secondary bg-gradient">
                        <p class="card-title mb-0 text-center text-light">Informations de l'approvisionnement</p>
                    </div>
                    <div class="card-body row">
                        <div class="row mx-auto my-auto">
                            <div class="col-3">
                                <h6>Produit:</h6>
                            </div>
                            <div class="col-9">
                                <h6>{{ $product->nom }}</h6>
                            </div>
                        </div>
                        <div class="row mx-auto my-auto">
                            <div class="col-3">
                                <h6>Prix:</h6>
                            </div>
                            <div class="col-9">
                                <h6>{{ $supply->prix }}</h6>
                            </div>
                        </div>
                        <div class="row mx-auto my-auto">
                            <div class="col-3">
                                <h6>Quantité:</h6>
                            </div>
                            <div class="col-9">
                                <h6>{{ $supply->qte }}</h6>
                            </div>
                        </div>
                        <div class="row mx-auto my-auto">
                            <div class="col-3">
                                <h6>Fournisseur:</h6>
                            </div>
                            <div class="col-9">
                                <h6>{{ $supplier->created_at->format('Y-m-d | H:i') }}</h6>
                            </div>
                        </div>     
                        <div class="row mx-auto my-auto">
                            <div class="col-3">
                                <h6>Date de l'approvisionnement:</h6>
                            </div>
                            <div class="col-9">
                                <h6>{{ $supply->created_at->format('Y-m-d | H:i') }}</h6>
                            </div>
                        </div>                    
                    </div>
                    <div class="card-footer bg-white">
                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-succes btn-sm float-right"><i
                            class="fas fa-edit"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="row my-4 mx-auto">
            <div class="col-md-12 mx-auto my-auto">

                <div class="card">
                    <div class="card-header rounded-top bg-secondary bg-gradient">
                        <p class="card-title mb-0 text-center text-light">Produits fournis</p>
                    </div>
                    <div class="card-body row">
                        @php $cpt = 1; @endphp
                        @foreach ($products as $product)
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
                                <h6 class="float-right">{{ number_format($product->prix_achat, 2) }} DA</h6>
                              </div>
                            </div>
                            <div class="row"><hr></div>
                            <div class="row w-60 mx-auto my-auto">
                              <div class="col-lg-3 text-secondary">
                                  <h6>Quantité achetée:</h6>
                              </div>
                              <div class="col-lg-9 text-info">
                                <h6 class="float-right">{{ $product->stock }}</h6>
                              </div>
                            </div>
                            <div class="row"><hr></div>
                            <div class="row w-60 mx-auto my-auto">
                                <div class="col-lg-3 text-secondary">
                                    <h6>Date d'achat:</h6>
                                </div>
                                <div class="col-lg-9 text-info">
                                  <h6 class="float-right">{{ $product->created_at }}</h6>
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
                    <div class="card-footer bg-white">
                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-succes btn-sm float-right"><i
                            class="fas fa-edit"></i></a>
                    </div>
                </div>

            </div>
        </div>


@endsection
