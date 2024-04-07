@extends('admin.layouts.layout')
@section('title', 'Client')
@section('content')

        <div class="row my-4 mx-auto">

            <div class="card">
                <div class="card-header row rounded-top bg-secondary bg-gradient">
                  <p class="card-title mb-0 text-light text-center">Informations du client</p>
                </div>
                <div class="card-body row">

                  <form class="pt-3" action="{{ route('clients.update', ['client' => $client]) }}" method="POST">
                      @csrf
                      @method('PUT')

                      <div class="row w-100 mx-0">
                          <div class="col-lg-4 col-md-6 col-sm-12 mx-auto my-auto">
                              <div class="form-group">
                                  <label for="nom">Nom:</label>
                                  <input type="text" name="nom" value="{{ $client->nom }}"
                                      class="form-control form-control-lg" placeholder="Nom">
                                  @error('nom')
                                      <div class="form-error">
                                          {{ $message }}
                                      </div>
                                  @enderror
                              </div>
                              <div class="form-group">
                                  <label for="prenom">Prénom:</label>
                                  <input type="text" name="prenom" value="{{ $client->prenom }}"
                                      class="form-control form-control-lg" placeholder="Prénom">
                                  @error('prenom')
                                      <div class="form-error">
                                          {{ $message }}
                                      </div>
                                  @enderror
                              </div>
                              <div class="form-group">
                                  <label for="date">Date de naissance:</label>
                                  <input type="date" name="date" value="{{ $client->date_naissance }}"
                                      class="form-control form-control-lg" placeholder="Date de naissance">
                                  @error('date')
                                      <div class="form-error">
                                          {{ $message }}
                                      </div>
                                  @enderror
                              </div>                              
                          </div>
                          <div class="col-lg-4 col-md-6 col-sm-12 mx-auto my-auto">
                            <div class="form-group">
                                <label for="adresse">Adresse:</label>
                                <input type="text" name="adresse" value="{{ $client->adresse }}"
                                    class="form-control form-control-lg" placeholder="Adresse">
                                @error('adresse')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="adresse">Wilaya:</label>
                                <select name="wilaya" id="wilaya" class="form-control form-control-lg">
                                    @foreach ($provinces as $province)
                                        @if ($loop->first) @continue @endif
                                        <option {{{ ($wilaya == $province[2])? 'selected="selected"' :'' }}}  value="{{ $province[2] }}">
                                            {{ $province[0] }} - {{ $province[1] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('wilaya')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>                            
                              <div class="form-group">
                                  <label for="tel">Téléphone:</label>
                                  <input type="tel" name="tel" value="{{ $client->tel }}" class="form-control form-control-lg"
                                      placeholder="Téléphone">
                                  @error('tel')
                                      <div class="form-error">
                                          {{ $message }}
                                      </div>
                                  @enderror
                              </div>                              
                          </div>
                          <div class="col-lg-4 col-md-6 col-sm-12 mx-auto my-auto">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" value="{{ $client->email }}"
                                    class="form-control form-control-lg" placeholder="Email">
                                @error('email')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                              <div class="form-group">
                                  <label for="username">Nom utilisateur:</label>
                                  <input type="text" name="username" value="{{ $clientUser->username }}" class="form-control form-control-lg"
                                      placeholder="Nom utilisateur">
                                  @error('username')
                                      <div class="form-error">
                                          {{ $message }}
                                      </div>
                                  @enderror
                              </div>
                              <div class="form-group">
                                  <label for="newPassword">Nouveau mot de passe:</label>
                                  <input type="password" name="newPassword" value="" class="form-control form-control-lg"
                                      placeholder="Nouveau mot de passe">
                                  @error('newPassword')
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
