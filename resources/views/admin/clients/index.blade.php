@extends('admin.layouts.layout')
@section('title', 'Clients')
@section('content')

        <div class="row my-4 mx-auto">
            <div class="card">
                <div class="card-header row rounded-top bg-secondary bg-gradient">
                    <div class="col-lg-8">
                        <p class="card-title mb-0 float-left text-light">Nos clients</p>
                    </div>
                    <div class="col-lg-4">
                        <a href="{{ route('clients.create') }}" class="btn btn-info btn-sm float-right"><i
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

        <div class="row"><hr></div>
        
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
