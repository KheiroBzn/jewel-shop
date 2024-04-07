@extends('admin.layouts.layout')
@section('title', 'Factures')
@section('content')

<div class="row my-4 mx-auto d-flex p-2">
    
  <div class="card">
      <div class="card-header row rounded-top bg-secondary bg-gradient">
          <div class="col-lg-8">
              <p class="card-title mb-0 float-left text-light">Liste de factures</p>
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