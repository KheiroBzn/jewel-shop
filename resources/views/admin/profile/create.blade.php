@extends('admin.layouts.layout')
@section('title', 'Profile')
@section('content')

    <div class="row my-4 mx-auto">

        <div class="card">
            <div class="card-header row rounded-top bg-secondary bg-gradient">
                <p class="card-title mb-0 text-light text-center">Informations admin</p>
            </div>
            <div class="card-body row">

                <form class="pt-3" action="{{ route('profile.store') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row w-100 mx-0">
                        <div class="col-lg-6 mx-auto my-auto">
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
                                <label for="email">Email:</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control form-control-lg" placeholder="Email">
                                @error('email')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 mx-auto my-auto">
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
                            <div class="form-group">
                                <label for="username">Nom utilisateur:</label>
                                <input type="text" name="username" value="{{ old('username') }}" class="form-control form-control-lg"
                                    placeholder="Nom utilisateur">
                                @error('username')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe:</label>
                                <input type="password" name="password" value="" class="form-control form-control-lg"
                                    placeholder="Mot de passe">
                                @error('password')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 text-center">
                        <div class="col-lg-12 mx-auto my-auto">
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
