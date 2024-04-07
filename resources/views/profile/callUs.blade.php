@auth
    @extends('layouts.layout')
    @section('title', 'Profil')
    @section('content')
    @include('partials.profileNav')

        <div><hr></div>

        <div class="row px-4">
            <div class="card container-fluid px-0">
                <div class="card-header rounded-top">
                    <h3 class="mt-2"><i class="fas fa-cart-shopping"></i> Contacter-nous par téléphone</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <h4 class="text-secondary">
                            Etape 2 : Contactez-nous par téléphone pour avoir votre commande le plus rapidement possible
                        </h4>
                        <h4 class="text-secondary">
                            Téléphone : 043 00 00 00
                        </h4>
                    </div>
                    <div class="row">
                        <a href="{{ route('user.index', $client) }}" class="btn btn-primary btn-sm">OK</a>
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
