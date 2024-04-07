@extends('admin.layouts.layout')
@section('title', 'Commandes')
@section('content')

<div class="row my-4 mx-auto">
    <div class="card">
        <div class="card-header row rounded-top bg-secondary bg-gradient">
            <div class="col-lg-8">
                <p class="card-title mb-0 float-left text-light">Liste de commandes</p>
            </div>
            <div class="col-lg-4" hidden>
                <a href="{{ route('orders.create') }}" class="btn btn-info btn-sm float-right"><i
                        class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body row">

            <div class="table-responsive">
                {!! $dataTable->table(['class' => 'table table-striped table-borderless']) !!}
            </div>
            
        </div>
    </div>
</div>

@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
