@extends('admin.layouts.layout')
@section('title', 'Clients')
@section('content')

    <div class="row mx-auto my-4">
        <div class="card">
            <div class="card-header row rounded-top bg-secondary bg-gradient">
              <p class="card-title mb-0 text-light text-center">Informations du client</p>
            </div>
            <div class="card-body row">

                <form class="pt-3" action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row w-100 mx-0">
                        <div class="col-lg-4 col-md-6 col-sm-12 mx-auto my-auto">                                
                            <div class="form-group">
                                <label for="nom">Nom:</label>
                                <input type="text" name="nom" value="{{ old('nom') }}"
                                    class="form-control form-control-lg" placeholder="Nom">
                                @error('nom')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prénom:</label>
                                <input type="text" name="prenom" value="{{ old('prenom') }}"
                                    class="form-control form-control-lg" placeholder="Prénom">
                                @error('prenom')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tel">Date de naissance:</label>
                                <input type="date" name="date" value="{{ old('date') }}" class="form-control form-control-lg"
                                    placeholder="Date de naissance">
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
                                <input type="text" name="adresse" value="{{ old('adresse') }}"
                                    class="form-control form-control-lg" placeholder="Adresse">
                                @error('adresse')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="adresse">Wilaya:</label>
                                <select name="wilaya" id="wilaya" class="form-control text-dark">
                                    @foreach ($provinces as $province)
                                        @if ($loop->first) @continue @endif
                                        <option {{{ (old('wilaya') == $province[1])? 'selected="selected"' :'' }}}  value="{{ $province[2] }}">
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
                                <input type="tel" name="tel" value="{{ old('tel') }}" class="form-control form-control-lg"
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
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control form-control-lg" placeholder="Email">
                                @error('email')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username">Nom utilisateur:</label>
                                <input type="text" name="username" value="{{ old('username') }}"
                                    class="form-control form-control-lg" placeholder="Nom utilisateur" data-lpignore=true>
                                @error('username')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe:</label>
                                <input type="password" name="password" value="" class="form-control form-control-lg"
                                    placeholder="Mot de passe" autocomplete="new-password" data-lpignore=true>
                                @error('password')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
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
