@extends('admin.layouts.layout')
@section('title', 'Profile')
@section('content')

    <div class="row my-4 mx-auto">
        <div class="col-md-12 mx-auto my-auto">

            <div class="card">
                <div class="card-header rounded-top bg-secondary bg-gradient">
                    <div class="row">
                        <div class="col-lg-8">
                            <p class="card-title mb-0 float-left text-light">Informations personnelles</p>
                        </div>
                        <div class="col-lg-4">
                            <a href="{{ route('profile.create') }}" class="btn btn-info btn-sm float-right"><i
                                    class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row w-60 mx-auto my-auto">
                        <div class="col-lg-3">
                            <h6>Nom:</h6>
                        </div>
                        <div class="col-lg-9">
                            <h6>{{ $admin->nom }}</h6>
                        </div>
                    </div>
                    <div class="row w-60 mx-auto my-auto">
                        <div class="col-lg-3">
                            <h6>Prénom:</h6>
                        </div>
                        <div class="col-lg-9">
                            <h6>{{ $admin->prenom }}</h6>
                        </div>
                    </div>
                    <div class="row w-60 mx-auto my-auto">
                        <div class="col-lg-3">
                            <h6>Email:</h6>
                        </div>
                        <div class="col-lg-9">
                            <h6>{{ $admin->email }}</h6>
                        </div>
                    </div>
                    <div class="row w-60 mx-auto my-auto">
                        <div class="col-lg-3">
                            <h6>Téléphone:</h6>
                        </div>
                        <div class="col-lg-9">
                            <h6>{{ $admin->tel }}</h6>
                        </div>
                    </div>
                    <div class="row w-60 mx-auto my-auto">
                        <div class="col-lg-3">
                            <h6>Nom utilisateur:</h6>
                        </div>
                        <div class="col-lg-9">
                            <h6>{{ $user->username }}</h6>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <a href="{{ route('profile.edit', $admin) }}" class="btn btn-succes btn-sm float-right"><i
                            class="fas fa-edit"></i></a>
                </div>
            </div>

        </div>
    </div>

@endsection
