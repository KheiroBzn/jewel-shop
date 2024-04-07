<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\Promotion;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Http\Controllers\Admin\AdminMainController;

use Illuminate\Support\HtmlString;

class ProductsDataTable extends DataTable
{

    protected static $filter = array(1, 2, 3, 4, 5, 6);
    
    public function __construct($filter = array()) {
        Self::$filter = $filter;
    }
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
                $deleteOnclick = 'onclick="return deleteProductConfirmation();"';
                $html = '<div class="row text-center">
                            <div class="col-4">
                                <a href="'.@route("products.details", $row).'" class="btn-info '.$btnClasses.'" title="Voir">
                                    <i class="fa fa-eye mx-auto"></i>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="'.@route("products.edit", $row).'" class="btn-success '.$btnClasses.'" title="Modifier">
                                    <i class="fa fa-edit mx-auto"></i>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="'.@route("products.delete", $row).'" class="btn-danger '.$btnClasses.'" title="Supprimer" '.$deleteOnclick.'>
                                    <i class="fa fa-trash mx-auto"></i>
                                </a>
                            </div>
                        </div>';
                return new HtmlString($html);
            })
            ->addColumn('fournisseur', function($row){
                $product = Product::findOrFail($row->id);
                $suppliers = Supplier::all();
                foreach( $suppliers as $supplier ) {
                    if( $supplier->id == $product->id_fournisseur ) {
                        $html = '<a href="'.@route("suppliers.show", $row->id_fournisseur).'">'.$supplier->nom.'</a>';
                        return new HtmlString($html);
                    }
                }
                $html = '<span class="text-danger">Aucun fournisseur</span>';             
                return new HtmlString($html);
            })
            ->editColumn('nom', function ($row) {   
                $html = '<a href="'.@route("products.details", $row).'">'.$row->nom.'</a>';             
                return new HtmlString($html);
            })
            ->editColumn('id_product', function ($row) {   
                $html = '<a href="'.@route("products.details", $row).'">'.$row->id_product.'</a>';             
                return new HtmlString($html);
            })
            ->editColumn('created_at', function ($request) {                
                return $request->created_at->format('Y-m-d');
            })
            ->editColumn('stock', function($row) {
                $badge = '';
                if ($row->stock == 0) {
                    $badge = 'badge-danger';
                    $text = 'Indisponible';
                } elseif ($row->stock >= 5 and $row->stock < 10) {
                    $badge = 'badge-warning';
                    $text = 'Stock minimum';
                } else {
                    $badge = 'badge-success';
                    $text = 'En stock';
                }

                $html = '<h4 class="badge '.$badge.' font-weight-bold" >'.$text.' | '.$row->stock.'</h4>';
                return new HtmlString($html);
            })
            ->editColumn('prix_achat', function($row) {
                $html = '<span class="font-weight-bold" >'.number_format($row->prix_achat, 2).' DA</span>';
                return new HtmlString($html);
            })
            ->editColumn('prix_vente', function($row) {

                $current_promotions = AdminMainController::getCurrentPromotions();

                foreach($current_promotions as $promotion) {
                    if( $row->id === $promotion->id_article ) {
                        
                        $html = '<a href="'.@route("promotions.show", $promotion->id).'">
                                    <div class="badge badge-light">
                                        <del class="text-danger font-weight-bold">'.number_format($row->prix_vente, 2).' DA</del>
                                        <h6 class="text-success font-weight-bold">'.number_format($promotion->nouveau_prix_vente, 2).' DA</h6>
                                    </div>
                                </a>';
                        return new HtmlString($html);
                    }
                }
                $html = '<span class="font-weight-bold" >'.number_format($row->prix_vente, 2).' DA</span>';
                return new HtmlString($html);
            })
            ->setRowClass(function ($row) {
                return 'alert-danger';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->whereIn('id', Self::$filter);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('products-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"top"Bflp<"clear">>rt<"bottom"ip<"clear">>')
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
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->autoWidth(false)
                ->addClass('text-center text-white')
                ->style('min-width: 90px; max-width: 90px;'),
            Column::make('id_product')
                ->addClass('p-3 text-center')
                ->title('#ID'),
            Column::make('nom')
                ->addClass('p-3 text-wrap'),
            Column::make('type')
                ->addClass('p-3'),
            Column::make('categorie')
                ->addClass('p-3 text-wrap'),
            Column::make('prix_achat')
                ->addClass('p-3 text-right')
                ->title('Prix d\'achat'),
            Column::make('prix_vente')
                ->addClass('p-3 text-right')
                ->title('Prix de vente'),
            Column::make('stock')
                ->addClass('p-3 text-center'),
            Column::make('fournisseur')
                ->addClass('p-3 text-wrap'),
            Column::make('created_at')
                ->addClass('p-3')
                ->title('Date d\'ajout'),
            //Column::make('updated_at')->addClass('p-3')->title('Date de mise à jour'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Products_' . date('YmdHis');
    }
}
