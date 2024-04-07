<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Client;
use App\Models\Livraison;
use App\Models\Paymant; 
use App\Models\CcpImage; 
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use Illuminate\Support\HtmlString;

class OrdersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($row){ 
                $btnClasses = 'btn btn-sm w-75 d-flex justify-content-center align-items-center';
                $deleteOnclick = 'onclick="return deleteOrderConfirmation();"';
                $cancelOnclick = 'onclick="return cancelOrderConfirmation();"';
                $validateOnclick = 'onclick="return validateOrderConfirmation();"';

                $deliverOnclick = 'onclick="return deliverOrderConfirmation();"';
                $successOnclick = 'onclick="return successOrderConfirmation();"';
                $backOnclick = 'onclick="return backOrderConfirmation();"';

                $html = '<div class="row text-center">
                            <div class="col-3">
                                <a href="'.@route("orders.show", $row->id).'" class="btn-info '.$btnClasses.' viewdetails" title="Voir">
                                    <i class="fa fa-eye mx-auto"></i>
                                </a>
                            </div>';
                if( $row->etat == 'en_attente' ) {
                    $html .= '<div class="col-3">
                                    <a href="'.@route("orders.validate", $row->id).'" class="btn-success '.$btnClasses.'" title="Valider" '.$validateOnclick.'>
                                        <i class="fa fa-check mx-auto"></i>
                                    </a>
                                </div>
                                <div class="col-3">
                                    <a href="'.@route("orders.cancel", $row->id).'" class="btn-warning '.$btnClasses.'" title="Annuler" '.$cancelOnclick.'>
                                        <i class="fa fa-cancel mx-auto"></i>
                                    </a>
                                </div>';
                } elseif ( $row->etat == 'validee' ) {
                    $html .= '<div class="col-3">
                                    <a href="'.@route("orders.deliver", $row->id).'" class="btn-primary '.$btnClasses.'" title="Mettre en livraison" '.$deliverOnclick.'>
                                        <i class="fa fa-cart-shopping mx-auto"></i>
                                    </a>
                                </div>';
                } elseif ( $row->etat == 'en_livraison' ) {
                    $html .= '<div class="col-3">
                                <a href="'.@route("orders.success", $row->id).'" class="btn-dark '.$btnClasses.'" title="Marquer comme Livré" '.$successOnclick.'>
                                    <i class="fa fa-check-double mx-auto"></i>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="'.@route("orders.back", $row->id).'" class="btn-secondary '.$btnClasses.'" title="Marquer comme Retour" '.$backOnclick.'>
                                    <i class="fa fa-delete-left mx-auto"></i>
                                </a>
                            </div>';
                } elseif ( $row->etat == 'annulee' ) {
                    $html .= '<div class="col-3">
                                <a href="'.@route("orders.delete", $row->id).'" class="btn-danger '.$btnClasses.'" title="Supprimer" '.$deleteOnclick.'>
                                    <i class="fa fa-trash mx-auto"></i>
                                </a>
                            </div>';
                } else {
                    $html = $html;
                }

                $html .= '</div>';
                return new HtmlString($html);
            })
            ->addColumn('client', function($row){
                $client = Client::findOrFail($row->id_client);

                $html = '<a href="'.@route("clients.show", $client->id).'">'.$client->nom.' '.$client->prenom.'</a>';             
                return new HtmlString($html);
            })
            ->addColumn('paiement', function($row){
                
                $paiement = Paymant::where('id_commande', $row->id)->get();
                if( $paiement->count() > 0 ) {
                    $html = '<a href="'.@route("orders.showPaymant", $row->id).'" class="badge badge-success">Disponible</a>';
                    return new HtmlString($html);
                }

                $html = '<span class="badge badge-warning">Non disponible</span>';

                return new HtmlString($html);
            })
            ->addColumn('details', function($row) {

                $orderDetails = OrderDetails::where('id_commande', $row->id)
                                    ->join('products', 'products.id', '=', 'order_details.id_bijou')
                                    ->get();

                $html = '<div class="">
                            <div class="row">
                                <div class="col-5 font-weight-bold text-left">Produit</div>
                                <div class="col-2 font-weight-bold text-center">Qte</div>
                                <div class="col-5 font-weight-bold text-right">Sous-Total</div>
                            </div>';
                            
                foreach($orderDetails as $product) {
                    $html .= '<div class="dropdown-divider my-2"></div>
                              <div class="row">
                                <div class="col-5 text-left text-wrap">
                                    <a href="'.@route("products.details", $product->id).'">'.$product->nom.'</a>
                                </div>
                                <div class="col-2 text-center">'.$product->qte.'</div>
                                <div class="col-5 text-right">'.number_format($product->sous_total, 2).' DA</div>
                              </div>';
                }
                            
                $html .= '</div>';
                return new HtmlString($html);
            })
            ->addColumn('livraison', function($row){
                $livraison = Livraison::findOrFail($row->id);

                $html = '<div class="row">
                            <div class="col-6 font-weight-bold">Adresse</div>
                            <div class="col-6 font-weight-bold">Livreur</div>
                        </div>
                        <div class="dropdown-divider my-2"></div>
                        <div class="row">
                            <div class="col-6">'.$livraison->adresse_livraison.'</div>
                            <div class="col-6">Kazi-Tour</div>
                        </div>';             
                return new HtmlString($html);
            })
            ->editColumn('etat', function($row) {
                $badge = '';
                if ($row->etat == 'en_attente') {
                    $badge = 'badge-info';
                    $text = 'En Attente';
                } elseif ($row->etat == 'validee') {
                    $badge = 'badge-dark';
                    $text = 'Valide';
                } elseif ($row->etat == 'annulee') {
                    $badge = 'badge-danger';
                    $text = 'Annulé';
                } elseif ($row->etat == 'retour') {
                    $badge = 'badge-secondary';
                    $text = 'Retour';
                } elseif ($row->etat == 'livree') {
                    $badge = 'badge-success';
                    $text = 'Livrée';
                } elseif ($row->etat == 'en_livraison') {
                    $badge = 'badge-primary';
                    $text = 'En livraison';
                } else {
                    $badge = 'badge-warning';
                    $text = 'Inconnue';
                }

                $html = '<h3 class="badge '.$badge.' font-weight-bold" >'.$text.'</h3>';
                return new HtmlString($html);
            })
            ->editColumn('total', function($row) {
                $html = '<div class="badge badge-light p-3">
                            <h6 class="text-danger font-weight-bold m-0">'.number_format($row->total, 2).' DA</h6>
                        </div>';
                return new HtmlString($html);
            })
            ->editColumn('updated_at', function ($request) {                
                return $request->updated_at->format('Y-m-d | H:i');
            })
            ->setRowClass(function ($item) {
                return 'alert-danger';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('orders-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bflrtip')
                    ->orderBy(1)
                    ->selectStyleMulti()
                    ->parameters([
                        'paging' => true,
                        'searching' => true,
                        'info' => true,
                        'stateSave' => true,
                        'searchDelay' => 350,
                        'buttons' => ['colvis', 'print', 'copyHtml5', 
                            [
                                'extend'  => 'collection',
                                'text'    => '<i class="fa fa-circle-check"></i> Selectionner',
                                'buttons' => [
                                    'selectAll',
                                    'selectNone',
                                ],
                            ],
                            [
                                'extend'  => 'collection',
                                'text'    => '<i class="fa fa-download"></i> Exporter',
                                'buttons' => [
                                    'csv',
                                    'excel',
                                    'pdf',
                                ],
                            ],
                        ],  
                        'language' => [
                            'url' => url('dataTables/Languages/fr/datatables.fr.json')
                        ],
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('text-center p-3')
                  ->style('min-width: 120px; max-width: 120px;'),
            Column::make('reference')
                  ->addClass('p-3 text-center'),
            Column::make('client')
                  ->addClass('pl-3 text-wrap')
                  ->title('Client')
                  ->searchable(true),
            Column::make('total')
                ->addClass('p-3 text-center'),
            Column::make('paiement')
                ->addClass('p-3 text-center'),
            Column::make('details')
                ->addClass('text-center')
                ->title('Détails')
                ->style('min-width: 250px !important; max-width: 300px !important;'),
            Column::make('etat')
                ->addClass('p-3'),
            Column::make('livraison')
                ->addClass('p-3 text-center')
                ->style('min-width: 200px !important; max-width: 250px !important;'),
            Column::make('updated_at')
                ->addClass('p-3')
                ->title('Date mise à jour'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Orders_' . date('YmdHis');
    }
}
