@extends('admin.layouts.layout')
@section('title', 'Client')
@section('content')

        <div class="row my-4 mx-auto">
            <div class="col-md-12 mx-auto my-auto">

                <div class="card">
                    <div class="card-header rounded-top bg-secondary bg-gradient">
                        <p class="card-title mb-0 text-center text-light">Informations du client</p>
                    </div>
                    <div class="card-body row">
                        <div class="row mx-auto my-auto">
                            <div class="col-3">
                                <h6>Nom:</h6>
                            </div>
                            <div class="col-9">
                                <h6>{{ $client->nom }}</h6>
                            </div>
                        </div>
                        <div class="row mx-auto my-auto">
                            <div class="col-3">
                                <h6>Prénom:</h6>
                            </div>
                            <div class="col-9">
                                <h6>{{ $client->prenom }}</h6>
                            </div>
                        </div>
                        <div class="row mx-auto my-auto">
                            <div class="col-3">
                                <h6>Date de naissance:</h6>
                            </div>
                            <div class="col-9">
                                <h6>{{ $client->date_naissance }}</h6>
                            </div>
                        </div>
                        <div class="row mx-auto my-auto">
                            <div class="col-3">
                                <h6>Adresse:</h6>
                            </div>
                            <div class="col-9">
                                <h6>{{ $client->adresse }}</h6>
                            </div>
                        </div>
                        <div class="row mx-auto my-auto">
                            <div class="col-3">
                                <h6>Email:</h6>
                            </div>
                            <div class="col-9">
                                <h6>{{ $client->email }}</h6>
                            </div>
                        </div>
                        <div class="row mx-auto my-auto">
                            <div class="col-3">
                                <h6>Téléphone:</h6>
                            </div>
                            <div class="col-9">
                                <h6>{{ $client->tel }}</h6>
                            </div>
                        </div>
                        <div class="row mx-auto my-auto">
                            <div class="col-3">
                                <h6>Nom utilisateur:</h6>
                            </div>
                            <div class="col-9">
                                <h6>{{ $clientUser->username }}</h6>
                            </div>
                        </div>
                        <div class="row mx-auto my-auto">
                            <div class="col-3">
                                <h6>Date d'inscription:</h6>
                            </div>
                            <div class="col-9">
                                <h6>{{ $client->created_at }}</h6>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer bg-white">
                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-succes btn-sm float-right"><i
                            class="fas fa-edit"></i></a>
                    </div>
                </div>

            </div>
        </div>

@endsection
