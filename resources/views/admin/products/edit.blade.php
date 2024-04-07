@extends('admin.layouts.layout')
@section('title', 'Produits')
@section('content')

  <div class="row my-4 mx-auto">

    <div class="card">
      <div class="card-header row rounded-top bg-secondary bg-gradient">
        <p class="card-title mb-0 text-light text-center">Informations du produit</p>
      </div>
      <div class="card-body row">

        <form class="pt-3" action="{{ route('products.update', ['product' => $product->id]) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="row mx-0">
              <div class="col-lg-4 mx-auto my-auto">
                  <div class="form-group">
                      <label for="nom">Nom:</label>
                      <input type="text" name="nom" value="{{ $product->nom }}" class="form-control form-control-lg" placeholder="Nom du bijou">
                      @error('nom')
                          <div class="form-error">
                              {{$message}}
                          </div>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="prix_achat">Prix d'achat:</label>
                      <input type="number" name="prix_achat" value="{{ $product->prix_achat }}" class="form-control form-control-lg" placeholder="Prix d'achat">
                      @error('prix_achat')
                        <div class="form-error">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="prix_vente">Prix de vente:</label>
                      <input type="number" name="prix_vente" value="{{ $product->prix_vente }}" class="form-control form-control-lg" placeholder="Prix de vente">
                      @error('prix_vente')
                        <div class="form-error">
                            {{$message}}
                        </div>
                      @enderror
                  </div>                    
              </div>
              <div class="col-lg-4 mx-auto my-auto">
                  <div class="form-group">
                    <label for="description">Description:</label>
                      <textarea type="textarea" name="description" value="{{ $product->description }}" class="form-control form-control-lg" placeholder="Decrire le produit ici...">{{ $product->description }}</textarea>
                      @error('description')
                        <div class="form-error">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
                  <div class="form-group row">
                      <div class="col-lg-7 mx-auto my-auto">
                        <label for="categorie">Catégorie:</label>
                        <select name="categorie" id="categorie" class="form-control text-dark">
                            @foreach ($categories as $categorie)
                                <option {{{ ($product->categorie == $categorie->nom)? 'selected="selected"' :'' }}}  value="{{ $categorie->nom }}">{{ $categorie->nom }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="col-lg-5 mx-auto my-auto">
                        <label for="type">Type:</label>
                        <select name="type" id="type" class="form-control text-dark">
                          @php
                            $normal = ($product->type == 'Normal')? 'selected="selected"' :''; 
                            $blanc = ($product->type == 'Blanc')? 'selected="selected"' :''; 
                          @endphp
                          <option value="Normal" {{ $normal }}>Normal</option>
                          <option value="Blanc" {{ $blanc }}>Blanc</option>
                        </select>
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="type">Fournisseur:</label>
                    <select name="fournisseur" id="type" class="form-control text-dark">
                      @foreach ($suppliers as $supplier)
                          <option {{{ ($product->id_fournisseur == $supplier->id)? 'selected="selected"' :'' }}}  value="{{ $supplier->id }}">{{ $supplier->nom }}</option>
                      @endforeach
                    </select>
                    @error('fournisseur')
                      <div class="form-error text-danger">
                          {{$message}}
                      </div>
                    @enderror
                </div>
              </div>
              <div class="col-lg-4 mx-auto my-auto">
                <div class="form-group">
                  <label for="stock">Stock:</label>
                  <input type="number" name="stock" value="{{ $product->stock }}" class="form-control" placeholder="Stock">
                  @error('stock')
                    <div class="form-error">
                        {{$message}}
                    </div>
                  @enderror
                </div>
              </div>                
          </div>
          <div class="row mt-3 card-footer bg-white text-center">
            <div class="col-12 mx-auto my-auto">
              <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-save"> Enregistrer</i>
              </button>
            </div>
          </div>
        </form>
        
      </div>
    </div> 
              
  </div>

  <div class="row"><hr></div>

  <div class="row mx-auto my-4">
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