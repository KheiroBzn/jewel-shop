@extends('admin.layouts.layout')
@section('title', 'Produit: '.$product->nom)
@section('content')

  <div class="row my-4 d-flex p-2">
    <div class="col-12 mx-auto my-auto">
      <div class="card">
        <div class="card-header rounded-top bg-secondary bg-gradient">
            <p class="card-title mb-0 text-light text-center">Informations du produit #{{ $product->id_product }}</p>
        </div>
        <div class="card-body row">
            <div class="col-6">
                <div class="row w-60 mx-auto my-auto">
                    <div class="col-lg-3 text-secondary">
                        <h6>ID:</h6>
                    </div>
                    <div class="col-lg-9 text-info">
                        <h6>{{ $product->id_product }}</h6>
                    </div>
                </div>
                <div class="row"><hr></div>
                <div class="row w-60 mx-auto my-auto">
                    <div class="col-lg-3 text-secondary">
                        <h6>Produit:</h6>
                    </div>
                    <div class="col-lg-9 text-info">
                        <h6>{{ $product->nom }}</h6>
                    </div>
                </div>
                <div class="row"><hr></div>
                <div class="row w-60 mx-auto my-auto">
                    <div class="col-lg-3 text-secondary">
                        <h6>Description:</h6>
                    </div>
                    <div class="col-lg-9 text-info">
                        <h6>{{ $product->description }}</h6>
                    </div>
                </div>
                <div class="row"><hr></div>
                <div class="row w-60 mx-auto my-auto">
                    <div class="col-lg-3 text-secondary">
                        <h6>Date d'ajout:</h6>
                    </div>
                    <div class="col-lg-9 text-info">
                        <h6>{{ $product->created_at }}</h6>
                    </div>
                </div>
                <div class="row"><hr></div>
                <div class="row w-60 mx-auto my-auto">
                    <div class="col-lg-3 text-secondary">
                        <h6>Prix d'achat:</h6>
                    </div>
                    <div class="col-lg-9 text-info">
                        <h6>{{ number_format($product->prix_achat, 2)." DA" }}</h6>
                    </div>
                </div>
                <div class="row"><hr></div>
                <div class="row w-60 mx-auto my-auto">
                    <div class="col-lg-3 text-secondary">
                        <h6>Prix de vente:</h6>
                    </div>
                    <div class="col-lg-9">
                        @empty($promotion->id)
                            <h6>{{ number_format($product->prix_vente, 2)." DA" }}</h6>
                        @else
                            <h6>
                                <del class="text-danger">{{ number_format($product->prix_vente, 2)." DA" }}</del>
                                <div class="text-success">{{ number_format($promotion->nouveau_prix_vente, 2)." DA" }}</div>
                            </h6>
                        @endempty
                        
                    </div>
                </div>
                <div class="row"><hr></div>
                <div class="row w-60 mx-auto my-auto">
                    <div class="col-lg-3 text-secondary">
                        <h6>Fornisseur:</h6>
                    </div>
                    <div class="col-lg-9">
                        <h6><a href="{{  route('suppliers.show', $supplier) }}" class="text-info">{{ $supplier->nom }}</a></h6>
                    </div>
                </div>
                <div class="row"><hr></div>
                <div class="row w-60 mx-auto my-auto">
                    <div class="col-lg-3 text-secondary">
                        <h6>Quantité disponible:</h6>
                    </div>
                    <div class="col-lg-9 text-info">
                        <h6>{{ $product->stock }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-6">
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
                    <ol class="carousel-indicators" style="background: transparent;">
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
            <div class="card-footer bg-white">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-succes btn-sm float-right"><i class="fas fa-edit"></i></a>
            </div>
        </div>
      </div>
    </div>        
  </div> 

 

  <div class="row"><hr></div>

  <div class="row mx-0 my-4" hidden>
    @empty($images)
      <span>Ce produit n'a pas d'images</span>
    @else
      @foreach ($images as $image)
      <div class="col-md-4 col-sm-6 card p-1">
        <div class="card-header rounded-top bg-secondary bg-gradient">
            <p class="card-title mb-0 text-light text-center">{{ $image->nom }}</p>
        </div>
        <div class="img-fluid card-body">
          <img src="{{ url($image->emplacement.'/'.$image->nom) }}" style="width:100%;">
        </div>
      </div>
      @endforeach
    @endempty
  </div>

@endsection