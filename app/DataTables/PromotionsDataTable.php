<?php

namespace App\DataTables;

use App\Models\Promotion;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use Illuminate\Support\HtmlString;

class PromotionsDataTable extends DataTable
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
                $deleteOnclick = 'onclick="return deletePromotionConfirmation();"';
                $html = '<div class="row text-center">
                            <div class="col-4">
                                <a href="'.@route("promotions.show", $row).'" class="btn-info '.$btnClasses.'" title="Voir">
                                    <i class="fa fa-eye mx-auto"></i>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="'.@route("promotions.edit", $row).'" class="btn-success '.$btnClasses.'" title="Modifier">
                                    <i class="fa fa-edit mx-auto"></i>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="'.@route("promotions.delete", $row).'" class="btn-danger '.$btnClasses.'" title="Supprimer" '.$deleteOnclick.'>
                                    <i class="fa fa-trash mx-auto"></i>
                                </a>
                            </div>
                        </div>';
                return new HtmlString($html);
            })
            ->addColumn('produit', function($row){
                $promotion = Promotion::findOrFail($row->id);
                $product = Product::findOrFail($promotion->id_article);
                $html = '<a href="products/'.$product->id.'/show">'.$product->nom.'</a>';             
                return new HtmlString($html);
            })
            ->editColumn('reduction', function ($request) {                
                return $request->reduction.' %';
            }) 
            ->editColumn('ancien_prix_vente', function($row) {
                $html = '<del class="text-danger font-weight-bold" >'.number_format($row->ancien_prix_vente, 2).' DA</del>';
                return new HtmlString($html);
            })
            ->editColumn('nouveau_prix_vente', function($row) {
                $html = '<span class="text-success font-weight-bold" >'.number_format($row->nouveau_prix_vente, 2).' DA</span>';
                return new HtmlString($html);
            })
            ->editColumn('created_at', function ($request) {                
                return $request->created_at->format('Y-m-d');
            })            
            ->setRowClass(function ($item) {
                return 'alert-danger';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Promotion $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('promotions-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bflrtip')
                    ->orderBy(7)
                    ->selectStyleMulti()
                    ->parameters([
                        'paging' => true,
                        'searching' => true,
                        'info' => true,
                        'stateSave' => true,
                        "autoWidth" => false,
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
            /* Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center p-3')
                ->style('min-width: 90px; max-width: 90px;'), */
            Column::make('id')
                ->addClass('p-3 text-center')
                ->title("#ID"),
            Column::computed('produit')
                ->addClass('p-3 text-wrap'),            
            Column::make('reduction')
                ->addClass('p-3 text-center')
                ->title("Réduction"),
            Column::make('ancien_prix_vente')
                ->addClass('text-center')
                ->title("Ancien prix"),
            Column::make('nouveau_prix_vente')
                ->addClass('text-center')
                ->title("Nouveau prix"),
            Column::make('date_debut'),
            Column::make('date_fin'),
            Column::make('created_at')
                ->title("Date d'ajout"),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Promotions_' . date('YmdHis');
    }
}
