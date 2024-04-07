@extends('admin.layouts.layout')
@section('title', 'Produits')
@section('content')

  <div class="row my-4 mx-auto">

    <div class="card">
      <div class="card-header row rounded-top bg-secondary bg-gradient">
        <p class="card-title mb-0 text-light text-center">Informations du produit</p>
      </div>
      <div class="card-body">
        <form class="pt-3" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row w-100 mx-0">
              <div class="col-lg-4 mx-auto my-auto">
                  <div class="form-group">
                    <label for="stock">Nom du produit:</label>
                      <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" placeholder="Nom du bijou">
                      @error('nom')
                          <div class="form-error text-danger">
                              {{$message}}
                          </div>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="prix_vente">Prix d'achat:</label>
                      <input type="number" name="prix_achat" value="{{ old('prix_achat') }}" class="form-control" placeholder="Prix d'achat">
                      @error('prix_achat')
                        <div class="form-error text-danger">
                            {{$message}}
                        </div>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="prix_vente">Prix de vente:</label>
                      <input type="number" name="prix_vente" value="{{ old('prix_vente') }}" class="form-control" placeholder="Prix de vente">
                      @error('prix_vente')
                        <div class="form-error text-danger">
                            {{$message}}
                        </div>
                      @enderror
                  </div>                    
              </div>
              <div class="col-lg-4 mx-auto my-auto">
                <div class="form-group">
                  <label for="description">Description:</label>
                  <textarea type="textarea" name="description" value="{{{ old('description') }}}" class="form-control form-control-lg" placeholder="Decrire le produit ici...">{{ old('description') }}</textarea>
                  @error('prix_vente')
                    <div class="form-error text-danger">
                        {{$message}}
                    </div>
                  @enderror
              </div> 
              <div class="form-group row">
                  <div class="col-lg-7 mx-auto my-auto">
                    <label for="categorie">Choisir la catégorie:</label>
                    <select name="categorie" id="categorie" class="form-control text-dark">
                      <option value="">- Selectionner -</option>
                        @foreach ($categories as $categorie)
                            <option {{{ (old('categorie') == $categorie->nom)? 'selected="selected"' :'' }}}  value="{{ $categorie->nom }}">{{ $categorie->nom }}</option>
                        @endforeach
                    </select>
                    @error('categorie')
                      <div class="form-error text-danger">
                          {{$message}}
                      </div>
                    @enderror
                  </div>
                  <div class="col-lg-5 mx-auto my-auto">
                    <label for="type">Choisir le type:</label>
                    <select name="type" id="type" class="form-control text-dark">
                      <option value="">- Selectionner -</option>
                      <option value="Normal">Normal</option>
                      <option value="Blanc">Blanc</option>
                    </select>
                    @error('type')
                      <div class="form-error text-danger">
                          {{$message}}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                    <label for="type">Fournisseur:</label>
                    <select name="fournisseur" id="type" class="form-control text-dark">
                      <option value="">- Selectionner -</option>
                      @foreach ($suppliers as $supplier)
                        <option {{{ (old('fournisseur') == $supplier->id)? 'selected="selected"' :'' }}}  value="{{ $supplier->id }}">{{ $supplier->nom }}</option>
                      @endforeach                        
                    </select>
                    <div class="text-center">
                      <a href="{{ route('suppliers.create') }}">+ Ajouter un nouveau fournisseur</a>
                    </div>
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
                  <input type="number" name="stock" value="{{ old('stock') }}" class="form-control" placeholder="Stock">
                  @error('stock')
                    <div class="form-error text-danger">
                        {{$message}}
                    </div>
                  @enderror
                </div>                  
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 mx-auto my-auto">
                      <label for="image1">Image 1:</label>
                    </div>
                    <div class="col-lg-9 mx-auto my-auto">
                      <input type="file" name="image1" class="form-control" alt="image1">
                    </div>
                  </div>                    
                  @error('image1')
                    <div class="form-error text-danger">
                        {{$message}}
                    </div>
                  @enderror
                </div> 
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 mx-auto my-auto">
                      <label for="image2">Image 2:</label>
                    </div>
                    <div class="col-lg-9 mx-auto my-auto">
                      <input type="file" name="image2" class="form-control">
                    </div>
                  </div>                    
                  @error('image2')
                    <div class="form-error text-danger">
                        {{$message}}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 mx-auto my-auto">
                      <label for="image3">Image 3:</label>
                    </div>
                    <div class="col-lg-9 mx-auto my-auto">
                      <input type="file" name="image3" class="form-control">
                    </div>
                  </div>                    
                  @error('image3')
                    <div class="form-error text-danger">
                        {{$message}}
                    </div>
                  @enderror
                </div>  
              </div>                
          </div>
          <div class="row mt-3 card-footer bg-white text-center">
            <div class="col-12 mx-auto my-auto">
              <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"> Ajouter</i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div> 
              
  </div>
  
@endsection