@auth
  <script>window.location = "{{ route('home.index') }}";</script>
@endauth
@guest

    @extends('layouts.layout')
    @section('title', 'Inscription')
    @section('content')

    <div class="container">
        <div class="row my-4">
            <div class="card px-0">
                <div class="card-header rounded-top mx-0">
                    <h3 class="mt-2"><i class="fas fa-circle-info"></i> Informations personnelles</h3>
                </div>
                <div class="card-body">
                    <form class="pt-2" action="{{ route('hundleSign') }}" method="POST">
                        @csrf

                        <input type="text" name="target" value="{{ $target }}" hidden>
                        
                        <div class="row">
                            @error('unknown')
                                <div class="form-error text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
    
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="nom">Nom:</label>
                                    <input type="text" name="nom" value="{{ old('nom') }}"
                                        class="form-control form-control-lg" placeholder="Nom">
                                        @if ($errors->has('nom'))
                                            <span class="text-danger">{{ $errors->first('nom') }}</span>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label for="prenom">Prénom:</label>
                                    <input type="text" name="prenom" value="{{ old('prenom') }}"
                                        class="form-control form-control-lg" placeholder="Prénom">
                                        @if ($errors->has('prenom'))
                                            <span class="text-danger">{{ $errors->first('prenom') }}</span>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label for="tel">Date de naissance:</label>
                                    <input type="date" name="date" value="{{ old('date') }}" class="form-control form-control-lg"
                                        placeholder="Date de naissance">
                                        @if ($errors->has('date'))
                                            <span class="text-danger">{{ $errors->first('date') }}</span>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label for="adresse">Adresse:</label>
                                    <input type="text" name="adresse" value="{{ old('adresse') }}"
                                        class="form-control form-control-lg" placeholder="Adresse">
                                        @if ($errors->has('adresse'))
                                            <span class="text-danger">{{ $errors->first('adresse') }}</span>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label for="adresse">Wilaya:</label>
                                    <select name="wilaya" id="wilaya" class="form-control form-control-lg text-dark">
                                        <option value="">-- Sélectionner --</option>
                                        @foreach ($provinces as $province)
                                            @if ($loop->first) @continue @endif
                                            <option {{{ (old('wilaya') == $province[1])? 'selected="selected"' :'' }}}  value="{{ $province[2] }}">
                                                {{ $province[0] }} - {{ $province[1] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('wilaya'))
                                        <span class="text-danger">{{ $errors->first('wilaya') }}</span>
                                    @endif
                                </div>                          
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="tel">Téléphone:</label>
                                    <input type="tel" name="tel" value="{{ old('tel') }}" class="form-control form-control-lg"
                                        placeholder="Téléphone">
                                        @if ($errors->has('tel'))
                                            <span class="text-danger">{{ $errors->first('tel') }}</span>
                                        @endif
                                </div>  
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control form-control-lg" placeholder="Email">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label for="username">Nom utilisateur:</label>
                                    <input type="text" name="username" value="{{ old('username') }}"
                                        class="form-control form-control-lg" placeholder="Nom utilisateur" data-lpignore=true>
                                        @if ($errors->has('username'))
                                            <span class="text-danger">{{ $errors->first('username') }}</span>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label for="password">Mot de passe:</label>
                                    <input type="password" name="password" value="" class="form-control form-control-lg"
                                        placeholder="Mot de passe" autocomplete="new-password" data-lpignore=true>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirmer le mot de passe:</label>
                                    <input type="password" name="password_confirmation" value="" class="form-control form-control-lg"
                                        placeholder="Confirmer le mot de passe" autocomplete="new-password" data-lpignore=true>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                </div>
                            </div>
                        </div>
    
                        <div class="row card-footer bg-white text-center">
                            <div class="col-12 mx-auto my-auto">
                                <input type="submit" class="btn btn-primary font-weight-medium auth-form-btn" value="S'INSCRIRE">
                            </div>
                        </div>
                        
                      </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
@endguest