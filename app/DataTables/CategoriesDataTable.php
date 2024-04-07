<?php

namespace App\DataTables;

use App\Models\Categorie;
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

class CategoriesDataTable extends DataTable
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
                $deleteOnclick = 'onclick="return deleteCategoryConfirmation();"';
                $html = '<div class="row text-center">
                            <div class="col-4">
                                <a href="'.@route("categories.details", $row).'" class="btn-info '.$btnClasses.'" title="Voir">
                                    <i class="fa fa-eye mx-auto"></i>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="'.@route("categories.edit", $row).'" class="btn-success '.$btnClasses.'" title="Modifier">
                                    <i class="fa fa-edit mx-auto"></i>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="'.@route("categories.delete", $row).'" class="btn-danger '.$btnClasses.'" title="Supprimer" '.$deleteOnclick.'>
                                    <i class="fa fa-trash mx-auto"></i>
                                </a>
                            </div>
                        </div>';
                return new HtmlString($html);
            })
            ->addColumn('nbre_produit', function($row){
                $products = Product::where('categorie' ,$row->nom)->count();
                $html = '<span class="">'.$products.'</span>';             
                return new HtmlString($html);
            })
            ->addColumn('nbre_produit', function($row){
                $products = Product::where('categorie' ,$row->nom)->count();
                /* $html = '<a href="categories/'.$row->id.'/products">'.$products.'</a>';  */ 
                $html = '<a href="'.@route("categories.products", $row).'">'.$products.'</a>';            
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
    public function query(Categorie $model): QueryBuilder
    {
        return $model->whereIn('id', Self::$filter);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('categories-table')
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
                  //->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('nom'),
            Column::make('description'),
            Column::make('nbre_produit')
                ->addClass('text-center')
                ->title("Nombre de produits"),
            Column::make('created_at')
                ->addClass('text-center')
                ->title("Date d'ajout"),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Categories_' . date('YmdHis');
    }
}
