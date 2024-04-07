@extends('admin.layouts.layout')
@section('title', 'Produits fournis')
@section('content')
    
    <div class="row my-4 mx-auto">
        <div class="card">
            <div class="card-header row rounded-top bg-secondary bg-gradient">
                <div class="col-lg-8">
                    <p class="card-title mb-0 float-left text-light">{{ $tableTitle }}</p>
                </div>
                <div class="col-lg-4 row p-2">
                    <div class="col-6">
                        <a href="{{ route('categories.index') }}" class="btn btn-light btn-sm"><i
                            class="fas fa-cog"></i> Gérer les catégories</a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('products.create') }}" class="btn btn-light btn-sm"><i
                            class="fas fa-plus"></i> Ajouter un produit</a>
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
