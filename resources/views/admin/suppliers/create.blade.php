@extends('admin.layouts.layout')
@section('title', 'Fournisseurs')
@section('content')

        <div class="row my-4 mx-auto">

            <div class="card">
                <div class="card-header row rounded-top bg-secondary bg-gradient">
                  <p class="card-title mb-0 text-light text-center">Informations du fournisseur</p>
                </div>
                <div class="card-body row">

                  <form class="pt-3" action="{{ route('suppliers.store') }}" method="POST">
                      @csrf
                      @method('PUT')

                      <div class="row w-100 mx-0">
                          <div class="col-lg-4 col-md-6 col-sm-12 mx-auto my-auto">
                              <div class="form-group">
                                  <label for="nom">Nom:</label>
                                  <input type="text" name="nom" value="{{ old('nom') }}"
                                      class="form-control form-control-lg" placeholder="Nom" required>
                                  @error('nom')
                                      <div class="form-error">
                                          {{ $message }}
                                      </div>
                                  @enderror
                              </div>
                              <div class="form-group">
                                  <label for="location">Location:</label>
                                  <input type="text" name="location" value="{{ old('location') }}"
                                      class="form-control form-control-lg" placeholder="Location" required>
                                  @error('location')
                                      <div class="form-error">
                                          {{ $message }}
                                      </div>
                                  @enderror
                              </div>
                              <div class="form-group">
                                  <label for="tel">Téléphone:</label>
                                  <input type="text" name="tel" value="{{ old('tel') }}"
                                      class="form-control form-control-lg" placeholder="Téléphone" required>
                                  @error('tel')
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
