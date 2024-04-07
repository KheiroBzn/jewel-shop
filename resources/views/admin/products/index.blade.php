@extends('admin.layouts.layout')
@section('title', 'Produits')
@section('content')
    
    <div class="row my-4 mx-auto">
        <div class="card">
            <div class="card-header row rounded-top bg-secondary bg-gradient">
                <div class="col-lg-4">
                    <p class="card-title mb-0 float-left text-light">Liste de bijoux</p>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                         <div class="col-7 text-light text-right">Ajouter un produit:</div>
                         <div class="col-2">
                             <a href="{{ route('products.create') }}" class="btn btn-light btn-sm">
                                 Nouveau
                             </a>
                         </div>
                         <div class="col-2">
                             <a href="{{ route('products.add') }}" class="btn btn-light btn-sm">
                                Existant
                             </a>
                         </div>                    
                    </div>
               </div>
            </div>
            <div class="card-body">
                <div class="table-responsive data-table">
                    {{ $dataTable->table(['class' => 'table table-striped table-borderless']) }}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    {{-- {!! $tableModel->script() !!} --}}
@endpush
