@extends('admin.layouts.layout')
@section('title', 'Fournisseurs')
@section('content')

<div class="row my-4 mx-auto d-flex p-2">
    
  <div class="card">
      <div class="card-header row rounded-top bg-secondary bg-gradient">
          <div class="col-lg-8">
              <p class="card-title mb-0 float-left text-light">Liste de fournisseurs</p>
          </div>
          <div class="col-lg-4">
              <a href="{{ route('suppliers.create') }}" class="btn btn-info btn-sm float-right"><i
                      class="fas fa-plus"></i></a>
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