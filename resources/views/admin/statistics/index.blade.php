@extends('admin.layouts.layout')
@section('title', 'Statistiques')
@section('content')

<div class="row mt-4">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <p class="card-title">Détails de commandes</p>
        <p class="font-weight-500">Le nombre total de sessions dans la plage de dates. C'est la période pendant laquelle un utilisateur est activement engagé avec votre site Web, votre page ou votre application, etc.</p>
        <div class="d-flex flex-wrap mb-5">
          <div class="mr-5 mt-3">
            <p class="text-muted">Valeur de commandes</p>
            <h3 class="text-primary fs-30 font-weight-medium">12.3k</h3>
          </div>
          <div class="mr-5 mt-3">
            <p class="text-muted">Commandes</p>
            <h3 class="text-primary fs-30 font-weight-medium">14k</h3>
          </div>
          <div class="mr-5 mt-3">
            <p class="text-muted">Clients</p>
            <h3 class="text-primary fs-30 font-weight-medium">71.56%</h3>
          </div>
          <div class="mt-3">
            <p class="text-muted"></p>
            <h3 class="text-primary fs-30 font-weight-medium"></h3>
          </div> 
        </div>
        <canvas id="order-chart"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
       <div class="d-flex justify-content-between">
        <p class="card-title">Rapport des ventes</p>
        <a href="#" class="text-info">Voir tous</a>
       </div>
        <p class="font-weight-500">Le nombre total de sessions dans la plage de dates. C'est la période pendant laquelle un utilisateur est activement engagé avec votre site Web, votre page ou votre application, etc.</p>
        <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
        <canvas id="sales-chart"></canvas>
      </div>
    </div>
  </div>
</div>
<div class="row" hidden>
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card position-relative">
      <div class="card-body">
        <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row">
                <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                  <div class="ml-xl-4 mt-3">
                  <p class="card-title">Rapports détaillés</p>
                    <h1 class="text-primary">$34040</h1>
                    <h3 class="font-weight-500 mb-xl-4 text-primary">Ouest d'Algérie</h3>
                    <p class="mb-2 mb-xl-0">Le nombre total de sessions dans la plage de dates. C'est la période pendant laquelle un utilisateur est activement engagé avec votre site Web, votre page ou votre application, etc.</p>
                  </div>  
                  </div>
                <div class="col-md-12 col-xl-9">
                  <div class="row">
                    <div class="col-md-6 border-right">
                      <div class="table-responsive mb-3 mb-md-0 mt-3">
                        <table class="table table-borderless report-table">
                          <tr>
                            <td class="text-muted">Oran</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">713</h5></td>
                          </tr>
                          <tr>
                            <td class="text-muted">Sidi Belabbes</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">583</h5></td>
                          </tr>
                          <tr>
                            <td class="text-muted">Tlemcen</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">924</h5></td>
                          </tr>
                          <tr>
                            <td class="text-muted">Mostaganem</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">664</h5></td>
                          </tr>
                          <tr>
                            <td class="text-muted">Mascara</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">560</h5></td>
                          </tr>
                          <tr>
                            <td class="text-muted">Alger</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">793</h5></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-6 mt-3">
                      <canvas id="north-america-chart"></canvas>
                      <div id="north-america-legend"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row">
                <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                  <div class="ml-xl-4 mt-3">
                  <p class="card-title">Rapports détaillés</p>
                    <h1 class="text-primary">$34040</h1>
                    <h3 class="font-weight-500 mb-xl-4 text-primary">Ouest d'Algérie</h3>
                    <p class="mb-2 mb-xl-0">Le nombre total de sessions dans la plage de dates. C'est la période pendant laquelle un utilisateur est activement engagé avec votre site Web, votre page ou votre application, etc.</p>
                  </div>  
                  </div>
                <div class="col-md-12 col-xl-9">
                  <div class="row">
                    <div class="col-md-6 border-right">
                      <div class="table-responsive mb-3 mb-md-0 mt-3">
                        <table class="table table-borderless report-table">
                          <tr>
                            <td class="text-muted">Oran</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">713</h5></td>
                          </tr>
                          <tr>
                            <td class="text-muted">Sidi Belabbes</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">583</h5></td>
                          </tr>
                          <tr>
                            <td class="text-muted">Tlemcen</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">924</h5></td>
                          </tr>
                          <tr>
                            <td class="text-muted">Mostaganem</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">664</h5></td>
                          </tr>
                          <tr>
                            <td class="text-muted">Mascara</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">560</h5></td>
                          </tr>
                          <tr>
                            <td class="text-muted">Alger</td>
                            <td class="w-100 px-0">
                              <div class="progress progress-md mx-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td><h5 class="font-weight-bold mb-0">793</h5></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-6 mt-3">
                      <canvas id="south-america-chart"></canvas>
                      <div id="south-america-legend"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection