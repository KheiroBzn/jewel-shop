@extends('admin.layouts.layout')
@section('title', 'Promotions')
@section('content')

<div class="row my-4 mx-auto">
    <div class="card">
        <div class="card-header row rounded-top bg-secondary bg-gradient text-center">
            <div class="col-lg-8">
                <p class="card-title mb-0 float-left text-light">Informations de la promotion</p>
            </div>
        </div>
        <div class="card-body">
            <form class="pt-3" action="{{ route('promotions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto my-auto">
                        <div class="form-group">
                            <label for="adresse">Produit:</label>
                            <select name="product_promotion" id="product_promotion" class="form-control form-control-lg text-dark" onchange="return productPromotion();">
                                <option value="">-- Selectionner un produit --</option>
                                @foreach ($products as $item)
                                    <option {{{ (old('product') == $item->id)? 'selected="selected"' :'' }}}  value="{{ $item->id }}-{{ $item->prix_achat }}-{{ $item->prix_vente }}">
                                        {{ $item->nom }} - {{ $item->prix_vente }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_promotion')
                                <div class="form-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="reduction">Réduction (%):</label>
                            <input type="number" name="reduction" id="reduction_input" value="{{ old('reduction') }}"
                                class="form-control form-control-lg reduction_input" placeholder="Réduction"
                                min="0" max="100" step="1"
                                disabled
                                oninput="return productPromotionReduction();">
                            @error('reduction')
                                <div class="form-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
    
                    </div>
                    <div class="col-lg-4 mx-auto my-auto">
                        <div class="form-group">
                            <label for="date_debut">Date de début:</label>
                            <input type="date" name="date_debut" value="{{ now()->format('Y-m-d') }}" class="form-control form-control-lg"
                                placeholder="Date de début">
                            @error('date_debut')
                                <div class="form-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date_fin">Date de fin:</label>
                            <input type="date" name="date_fin" value="{{ old('date_fin') }}" class="form-control form-control-lg"
                                placeholder="Date de fin">
                            @error('date_fin')
                                <div class="form-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div> 
    
                    <div class="col-lg-4 mx-auto my-auto">
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" name="image" class="form-control" alt="image">
                            @error('image')
                              <div class="form-error">
                                  {{$message}}
                              </div>
                            @enderror
                          </div> 
                          <div class="border px-5 py-2">
                            <div class="row"><span id="prix_achat_promotion" class="text-info font-weight-bold">Prix d'achat: 0 DA</span></div>
                            <div class="row"><span id="ancien_prix_promotion" class="text-danger font-weight-bold">Ancien prix: 0 DA</span></div>
                            <div class="row"><span id="nouveau_prix_promotion" class="text-success font-weight-bold">Prix promotion: 0 DA</span></div>
                        </div>
                    </div>
                              
                </div>
                <div class="row mt-3">
                  <div class="col-lg-2 mx-auto my-auto">
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