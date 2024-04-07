@extends('admin.layouts.layout')
@section('title', 'Order')
@section('content')

        <div class="row mx-auto my-4">

            <div class="card">
                <div class="card-header row rounded-top bg-secondary bg-gradient">
                  <p class="card-title mb-0 text-light text-center">Informations de la commande</p>
                </div>
                <div class="card-body">
    
                    <form class="pt-3" action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
    
                        <div class="row w-100 mx-0">
                            <div class="col-lg-4 col-md-6 col-sm-12 mx-auto my-auto">                                
                                <div class="form-group">
                                    <label for="adresse">Produit:</label>
                                    <select name="product" id="product" class="form-control form-control-lg text-dark">
                                        <option value="">-- Selectionner un produit --</option>
                                        @foreach ($products as $item)
                                            <option {{{ (old('product') == $item->id)? 'selected="selected"' :'' }}}  value="{{ $item->id }}">
                                                {{ $item->nom }} - {{ $item->prix_vente }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('product')
                                        <div class="form-error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>                             
                                <div class="form-group">
                                    <label for="qte">Quantité:</label>
                                    <input type="number" name="qte" id="qte_input" value="1"
                                        class="form-control form-control-lg order_input" placeholder="Quantité">
                                    @error('qte')
                                        <div class="form-error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="prixU">Prix unitaire:</label>
                                    <input type="number" name="prixU" id="prix_unit" value="{{ old('prix_unit') }}"
                                        class="form-control form-control-lg" placeholder="Prix unitaire">
                                    @error('prixU')
                                        <div class="form-error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tva">Taux TVA (%):</label>
                                    <input type="number" name="tva" id="tva_input" value="0"
                                        class="form-control form-control-lg order_input" placeholder="Taux TVA"
                                        min="0" max="100">
                                    @error('tva')
                                        <div class="form-error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 mx-auto my-auto">                                
                                <div class="form-group">
                                    <label for="client">Client:</label>
                                    <select name="client" id="client_select" class="form-control form-control-lg text-dark">
                                        <option value="">-- Selectionner le client --</option>
                                        @foreach ($clients as $item)
                                            <option {{{ (old('client') == $item->adresse)? 'selected="selected"' :'' }}} value="{{ $item->adresse }}">
                                                {{ $item->nom }} - {{ $item->date_naissance }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('client')
                                        <div class="form-error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> 
                                <div class="form-group">
                                    <label for="livraison">Livraison:</label>
                                    <select name="livraison" id="livraison" class="form-control form-control-lg text-dark">
                                        <option value="oui">Avec livraison</option>
                                        <option value="non">Sans livraison</option>
                                    </select>
                                    @error('livraison')
                                        <div class="form-error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="livreur">Livreur:</label>
                                    <select name="livraison" id="livreur" class="form-control form-control-lg text-dark">
                                        <option value="1">Livreur 1</option>
                                        <option value="2">Livreur 2</option>
                                    </select>
                                    @error('livreur')
                                        <div class="form-error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="adresse_livraison">Adresse de livraison:</label>
                                    <input type="text" name="adresse_livraison" id="adresse_livraison" value="{{ old('adresse_livraison') }}"
                                        class="form-control form-control-lg" placeholder="Adresse de livraison">
                                    @error('adresse_livraison')
                                        <div class="form-error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> 
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 mx-auto my-auto">
                                <div>Total HT:  <span id="total_HT">0</span> DA</div>
                                <div>Total TVA: <span id="total_TVA">0</span> DA</div>
                            </div>
                        </div>
                        <div class="row mt-3 card-footer text-center bg-white">
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
        
@endsection
