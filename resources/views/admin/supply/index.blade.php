@extends('admin.layouts.layout')
@section('title', 'Approvisionnements')
@section('content')

<div class="row my-4 mx-auto d-flex p-2">
    
  <div class="card">
      <div class="card-header row rounded-top bg-secondary bg-gradient">
          <div class="col-lg-4">
              <p class="card-title mb-0 float-left text-light">Liste des Approvisionnements</p>
          </div>
          <div class="col-lg-8">
               <div class="row">
                    <div class="col-7 text-light text-right">Ajouter un approvisionnement:</div>
                    <div class="col-2">
                        <a href="{{ route('supply.create') }}" class="btn btn-light btn-sm">
                            Nouveau produit
                        </a>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-2">
                        <a href="{{ route('supply.add') }}" class="btn btn-light btn-sm">
                            Produit existant
                        </a>
                    </div>                    
               </div>
          </div>
      </div>
      <div class="card-body row">
          <div class="table-responsive data-table">
              {{ $dataTable->table(['class' => 'table table-striped table-borderless']) }}
          </div>
      </div>
  </div>
</div>

<div class="row my-4"><hr></div>

@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush