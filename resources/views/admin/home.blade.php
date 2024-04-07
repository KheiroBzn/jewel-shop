@extends('admin.layouts.layout')
@section('title', 'Tableau de board')
@section('content')
    @auth
        @if (auth()->user()->role === 0)
            <div class="container-fluid bg-light mx-0">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="row">
                            <div class="col-12 col-xl-4" hidden>
                                <div class="justify-content-end d-flex">
                                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                        <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                            id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="true">
                                            <i class="mdi mdi-calendar"></i> Aujourd'hui ({{ now()->format('Y-m-d') }})
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                            <a class="dropdown-item" href="#">Janvier - Mars</a>
                                            <a class="dropdown-item" href="#">Mars - Juin</a>
                                            <a class="dropdown-item" href="#">Juin - Aout</a>
                                            <a class="dropdown-item" href="#">Aout - Novembre</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 grid-margin">
                        <div class="mt-0 pt-0 w-100">
                            <a href="{{ route('products.details', $randomProduct->id) }}">
                                <img src="{{ url('images/jewelry/' . $randomProduct->categorie . '/' . $randomProduct->nom . '/' . $randomProductImage->nom) }}"
                                    alt="people" class="img-thumbnail rounded mx-auto d-block img-fluid">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8 grid-margin transparent">
                        <div class="row">
                            <div class="col-md-6 mb-4 stretch-card transparent">
                                <div class="card card-tale">
                                    <div class="card-body">
                                        <p class="mb-4">Commande en attentes</p>
                                        <p class="fs-30 mb-2">{{ $pendingOrders }}</p>
                                        <p>{{ $pendingOrders }} (30 jours)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 stretch-card transparent">
                                <div class="card card-dark-blue">
                                    <div class="card-body">
                                        <p class="mb-4">Commande livrées</p>
                                        <p class="fs-30 mb-2">{{ $doneOrders }}</p>
                                        <p>{{ $doneOrders }} (30 jours)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                                <div class="card card-light-blue">
                                    <div class="card-body">
                                        <p class="mb-4">Commades valides</p>
                                        <p class="fs-30 mb-2">{{ $validOrders }}</p>
                                        <p>{{ $validOrders }} (30 jours)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 stretch-card transparent">
                                <div class="card card-light-danger">
                                    <div class="card-body">
                                        <p class="mb-4">Nombre de clients</p>
                                        <p class="fs-30 mb-2">{{ $clients }}</p>
                                        <p>{{ $clients }} (30 jours)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title mb-0">Meilleurs produits</p>
                                <a href="{{ route('products.index') }}" class="float-right">Voir plus</a>
                                <div class="table-responsive">
                                    <table class="table table-striped table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Produit</th>
                                                <th>Prix achat</th>
                                                <th>Prix vente</th>
                                                <th>Date</th>
                                                <th>Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td><a href="{{ route('products.details', $product->id) }}">{{ $product->nom }}</a></td>
                                                    <td class="font-weight-bold">{{ number_format($product->prix_achat, 2) }} DA</td>
                                                    <td class="font-weight-bold">{{ number_format($product->prix_vente, 2) }} DA</td>
                                                    <td>{{ $product->created_at }}</td>
                                                    @php
                                                        $badge = '';
                                                        if ($product->stock == 0) {
                                                            $badge = 'badge-danger';
                                                            $text = 'Indisponible';
                                                        } elseif ($product->stock >= 5 and $product->stock < 10) {
                                                            $badge = 'badge-warning';
                                                            $text = 'Stock minimum';
                                                        } else {
                                                            $badge = 'badge-success';
                                                            $text = 'En stock';
                                                        }
                                                    @endphp
                                                    <td class="font-weight-medium">
                                                        <div class="badge {{ $badge }}">{{ $text }} |
                                                            {{ $product->stock }}</div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" hidden>
                    <div class="col-md-5 stretch-card grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title mb-0">Téritoires commandes</p>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="pl-0  pb-2 border-bottom">Places</th>
                                                <th class="border-bottom pb-2">Commandes</th>
                                                <th class="border-bottom pb-2">Clients</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="pl-0">Alger</td>
                                                <td>
                                                    <p class="mb-0"><span class="font-weight-bold mr-2">65</span>(2.15%)</p>
                                                </td>
                                                <td class="text-muted">65</td>
                                            </tr>
                                            <tr>
                                                <td class="pl-0">Tlemcen</td>
                                                <td>
                                                    <p class="mb-0"><span class="font-weight-bold mr-2">54</span>(3.25%)</p>
                                                </td>
                                                <td class="text-muted">51</td>
                                            </tr>
                                            <tr>
                                                <td class="pl-0">Mascara</td>
                                                <td>
                                                    <p class="mb-0"><span class="font-weight-bold mr-2">22</span>(2.22%)</p>
                                                </td>
                                                <td class="text-muted">32</td>
                                            </tr>
                                            <tr>
                                                <td class="pl-0">Oran</td>
                                                <td>
                                                    <p class="mb-0"><span class="font-weight-bold mr-2">46</span>(3.27%)</p>
                                                </td>
                                                <td class="text-muted">15</td>
                                            </tr>
                                            <tr>
                                                <td class="pl-0">Sidi Belabbes</td>
                                                <td>
                                                    <p class="mb-0"><span class="font-weight-bold mr-2">17</span>(1.25%)</p>
                                                </td>
                                                <td class="text-muted">25</td>
                                            </tr>
                                            <tr>
                                                <td class="pl-0">Mostaganem</td>
                                                <td>
                                                    <p class="mb-0"><span class="font-weight-bold mr-2">52</span>(3.11%)</p>
                                                </td>
                                                <td class="text-muted">71</td>
                                            </tr>
                                            <tr>
                                                <td class="pl-0 pb-0">Saida</td>
                                                <td class="pb-0">
                                                    <p class="mb-0"><span class="font-weight-bold mr-2">25</span>(1.32%)</p>
                                                </td>
                                                <td class="pb-0">14</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 stretch-card grid-margin" hidden>
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Etats de commandes</p>
                                <div class="charts-data">
                                    <div class="mt-3">
                                        <p class="mb-0">Validée</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="progress progress-md flex-grow-1 mr-4">
                                                <div class="progress-bar bg-inf0" role="progressbar" style="width: 95%"
                                                    aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mb-0">5k</p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="mb-0">En attente</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="progress progress-md flex-grow-1 mr-4">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 35%"
                                                    aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mb-0">1k</p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="mb-0">Annulée</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="progress progress-md flex-grow-1 mr-4">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 48%"
                                                    aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mb-0">992</p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="mb-0">Retour</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="progress progress-md flex-grow-1 mr-4">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 25%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mb-0">687</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin" hidden>
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Meilleurs commentaire</p>
                                <ul class="icon-data-list">
                                    <li>
                                        <div class="d-flex">
                                            <img src="{{ url('images/faces/face1.jpg') }}" alt="user">
                                            <div>
                                                <p class="text-info mb-1">Ben Ben</p>
                                                <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit!</p>
                                                <small>9:30 am</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <img src="{{ url('images/faces/face2.jpg') }}" alt="user">
                                            <div>
                                                <p class="text-info mb-1">Ben Ben</p>
                                                <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit!</p>
                                                <small>10:30 am</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <img src="{{ url('images/faces/face3.jpg') }}" alt="user">
                                            <div>
                                                <p class="text-info mb-1">Ben Ben</p>
                                                <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit!</p>
                                                <small>11:30 am</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <img src="{{ url('images/faces/face4.jpg') }}" alt="user">
                                            <div>
                                                <p class="text-info mb-1">Ben Ben</p>
                                                <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit!</p>
                                                <small>8:50 am</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <img src="{{ url('images/faces/face5.jpg') }}" alt="user">
                                            <div>
                                                <p class="text-info mb-1">Ben Ben</p>
                                                <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit!</p>
                                                <small>9:00 am</small>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" hidden>
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Dernier Produits</p>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="example" class="display expandable-table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>ID#</th>
                                                        <th>Produit</th>
                                                        <th>Type</th>
                                                        <th>Categorie</th>
                                                        <th>Prix</th>
                                                        <th>Qte</th>
                                                        <th>Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{ redirect()->to('admin/login')->send() }}
        @endif
    @endauth
@endsection
