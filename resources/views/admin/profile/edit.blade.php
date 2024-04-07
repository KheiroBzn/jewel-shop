@extends('admin.layouts.layout')
@section('title', 'Profile')
@section('content')

    <div class="row my-4 mx-auto">

        <div class="card">
            <div class="card-header row rounded-top bg-secondary bg-gradient">
                <p class="card-title mb-0 text-light text-center">Informations personnelles</p>
            </div>
            <div class="card-body row">

                <form class="pt-3" action="{{ route('profile.update', ['admin' => $admin]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row w-100 mx-0">
                        <div class="col-lg-6 mx-auto my-auto">
                            <div class="form-group">
                                <label for="nom">Nom:</label>
                                <input type="text" name="nom" value="{{ $admin->nom }}"
                                    class="form-control form-control-lg" placeholder="Nom">
                                @error('nom')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prénom:</label>
                                <input type="text" name="prenom" value="{{ $admin->prenom }}"
                                    class="form-control form-control-lg" placeholder="Prénom">
                                @error('prenom')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="newEmail">Email:</label>
                                <input type="email" name="newEmail" value="{{ $admin->email }}"
                                    class="form-control form-control-lg" placeholder="Email">
                                @error('newEmail')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 mx-auto my-auto">
                            <div class="form-group">
                                <label for="tel">Téléphone:</label>
                                <input type="tel" name="tel" value="{{ $admin->tel }}" class="form-control form-control-lg"
                                    placeholder="Téléphone">
                                @error('tel')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="newUsername">Nom utilisateur:</label>
                                <input type="text" name="newUsername" value="{{ $user->username }}" class="form-control form-control-lg"
                                    placeholder="Nom utilisateur">
                                @error('newUsername')
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
                    <div class="row mt-3">
                        <div class="col-lg-4 mx-auto my-auto">
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
