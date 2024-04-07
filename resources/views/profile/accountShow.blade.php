@auth
    @extends('layouts.layout')
    @section('title', 'Profil')
    @section('content')
    @include('partials.profileNav')

        <div class="row px-4">
            <div class="card container-fluid px-0">
                <div class="card-header rounded-top">
                    <h3 class="mt-2"><i class="fas fa-circle-info"></i> Mes informations personnelles</h3>
                </div>
                <div class="card-body">
                    <div class="row w-60 mx-auto my-auto">
                        <div class="col-lg-3">
                            <h4>Nom:</h4>
                        </div>
                        <div class="col-lg-9">
                            <h4>{{ $client->nom }}</h4>
                        </div>
                    </div>
                    <div class="row w-60 mx-auto my-auto">
                        <div class="col-lg-3">
                            <h4>Prénom:</h4>
                        </div>
                        <div class="col-lg-9">
                            <h4>{{ $client->prenom }}</h4>
                        </div>
                    </div>
                    <div class="row w-60 mx-auto my-auto">
                        <div class="col-lg-3">
                            <h4>Date de naissance:</h4>
                        </div>
                        <div class="col-lg-9">
                            <h4>{{ $client->date_naissance }}</h4>
                        </div>
                    </div>
                    <div class="row w-60 mx-auto my-auto">
                        <div class="col-lg-3">
                            <h4>Adresse:</h4>
                        </div>
                        <div class="col-lg-9">
                            <h4>{{ $client->adresse }}</h4>
                        </div>
                    </div>
                    <div class="row w-60 mx-auto my-auto">
                        <div class="col-lg-3">
                            <h4>Email:</h4>
                        </div>
                        <div class="col-lg-9">
                            <h4>{{ $client->email }}</h4>
                        </div>
                    </div>
                    <div class="row w-60 mx-auto my-auto">
                        <div class="col-lg-3">
                            <h4>Téléphone:</h4>
                        </div>
                        <div class="col-lg-9">
                            <h4>{{ $client->tel }}</h4>
                        </div>
                    </div>
                    <div class="row w-60 mx-auto my-auto">
                        <div class="col-lg-3">
                            <h4>Nom utilisateur:</h4>
                        </div>
                        <div class="col-lg-9">
                            <h4>{{ $user->username }}</h4>
                        </div>
                    </div>
                    <div class="row w-60 mx-auto my-auto">
                        <div class="col-lg-3">
                            <h4>Date d'inscription:</h4>
                        </div>
                        <div class="col-lg-9">
                            <h4>{{ $client->created_at }}</h4>
                        </div>
                    </div>
                    <div class="float-right" @disabled(true)>
                        <a href="{{ route('user.accountEdit', $user->id) }}" class="btn btn-succes btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
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
