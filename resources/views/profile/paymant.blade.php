@auth
    @extends('layouts.layout')
    @section('title', 'Profil')
    @section('content')
    @include('partials.profileNav')

        <div><hr></div>

        <div class="row px-4">
            <div class="card container-fluid px-0">
                <div class="card-header rounded-top">
                    <h3 class="mt-2"><i class="fas fa-cart-shopping"></i> Confirmation du paiement</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.hundlePay', [$client, $order]) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        <div class="row">
                            <h4 class="text-secondary">
                                Etape 1 : Charger le récu de versement par CCP : 000000000000 en format image scané
                            </h4>
                        </div>
                        <div class="form-group">
                            <div class="row">
                              <div class="col-lg-3 mx-auto my-auto">
                                <label for="image"></label>
                              </div>
                              <div class="col-lg-9 mx-auto my-auto">
                                <input type="file" name="image" class="form-control" alt="image">
                              </div>
                            </div>                    
                            @error('image')
                              <div class="form-error text-danger">
                                  {{$message}}
                              </div>
                            @enderror
                          </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary btn-sm">Passer à l'étape suivante</button>
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
