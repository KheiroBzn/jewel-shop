@extends('admin.layouts.layout')
@section('title', 'Promotions')
@section('content')

<div class="row my-4 mx-auto">
    <div class="card">
        <div class="card-header row rounded-top bg-secondary bg-gradient">
            <div class="col-lg-8">
                <p class="card-title mb-0 float-left text-light">Liste de promotions</p>
            </div>
            <div class="col-lg-4">
                <a href="{{ route('promotions.create') }}" class="btn btn-info btn-sm float-right"><i
                        class="fas fa-plus"></i></a>
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
@endpush