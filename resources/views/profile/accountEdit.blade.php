@auth
    @extends('layouts.layout')
    @section('title', 'Profil')
    @section('content')
    @include('partials.profileNav')

    <div class="row my-4 mx-4">
        <div class="card px-0">
            <div class="card-header rounded-top mx-0">
                <h3 class="mt-2"><i class="fas fa-circle-info"></i> Informations personnelles</h3>
            </div>
            <div class="card-body">
                <form class="pt-2" action="{{ route('user.accountUpdate', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

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
                                <input type="text" name="nom" value="{{ $client->nom }}"
                                    class="form-control form-control-lg" placeholder="Nom">
                                    @if ($errors->has('nom'))
                                        <span class="text-danger">{{ $errors->first('nom') }}</span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prénom:</label>
                                <input type="text" name="prenom" value="{{ $client->prenom }}"
                                    class="form-control form-control-lg" placeholder="Prénom">
                                    @if ($errors->has('prenom'))
                                        <span class="text-danger">{{ $errors->first('prenom') }}</span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="tel">Date de naissance:</label>
                                <input type="date" name="date" value="{{ $client->date_naissance }}" class="form-control form-control-lg"
                                    placeholder="Date de naissance">
                                    @if ($errors->has('date'))
                                        <span class="text-danger">{{ $errors->first('date') }}</span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="adresse">Adresse:</label>
                                <input type="text" name="adresse" value="{{ $client->adresse }}"
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
                                        <option {{{ ($wilaya == $province[2])? 'selected="selected"' :'' }}}  value="{{ $province[0] }}">
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
                                <input type="tel" name="tel" value="{{ $client->tel }}" class="form-control form-control-lg"
                                    placeholder="Téléphone">
                                    @if ($errors->has('tel'))
                                        <span class="text-danger">{{ $errors->first('tel') }}</span>
                                    @endif
                            </div>  
                            <div class="form-group">
                                <label for="newEmail">Email:</label>
                                <input type="email" name="newEmail" value="{{ $client->email }}"
                                    class="form-control form-control-lg" placeholder="Email">
                                    @if ($errors->has('newEmail'))
                                        <span class="text-danger">{{ $errors->first('newEmail') }}</span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="newUsername">Nom utilisateur:</label>
                                <input type="text" name="newUsername" value="{{ $user->username }}"
                                    class="form-control form-control-lg" placeholder="Nom utilisateur" data-lpignore=true>
                                    @if ($errors->has('newUsername'))
                                        <span class="text-danger">{{ $errors->first('newUsername') }}</span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="newPassword" id="editPassword">Voulez-vous modifier le mot de passe ?
                                    <input type="radio" name="editPassword" value="oui" class="mx-1" onchange="newPasswordChange(this);" > Oui 
                                    <input type="radio" name="editPassword" value="non" class="mx-1" onchange="newPasswordChange(this);"  checked> Non
                                </label>                                
                                <input type="password" name="newPassword" value="" class="form-control form-control-lg"
                                    placeholder="Mot de passe" autocomplete="new-password" data-lpignore=true id="newPassword" disabled>
                                    @if ($errors->has('newPassword'))
                                        <span class="text-danger">{{ $errors->first('newPassword') }}</span>
                                    @endif
                            </div>
                        </div>
                    </div>

                    <div class="row card-footer bg-white text-center">
                        <div class="col-12 mx-auto my-auto">
                            <input type="submit" class="btn btn-primary font-weight-medium auth-form-btn" value="Enregistrer">
                        </div>
                    </div>
                    
                  </form>
            </div>
        </div>
    </div>

        <div><hr></div>
            
    @include('partials.profileFooter')

@endsection
{{-- {{ redirect()->to('user')->send() }} --}}
{{-- {{ Redirect::to('user.index') }} --}}
@endauth

@guest
<script>
    window.location = "{{ route('home.index') }}";
</script>
@endguest
