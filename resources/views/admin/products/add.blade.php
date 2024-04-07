@extends('admin.layouts.layout')
@section('title', 'Produits')
@section('content')

        <div class="row my-4 mx-auto">

            <div class="card">
                <div class="card-header row rounded-top bg-secondary bg-gradient">
                  <p class="card-title mb-0 text-light text-center">Nouveau stock</p>
                </div>
                <div class="card-body row">

                  <form class="pt-3" action="{{ route('products.reStore') }}" method="POST">
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
                                  <input type="number" name="qte" value="{{ old('qte') }}"
                                      class="form-control form-control-lg" placeholder="Quantité" required>
                                  @error('qte')
                                      <div class="form-error">
                                          {{ $message }}
                                      </div>
                                  @enderror
                              </div>                              
                          </div>
                      </div>
                      <div class="row mt-3 card-footer text-center bg-white">
                          <div class="col-12 mx-0 my-0">
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
