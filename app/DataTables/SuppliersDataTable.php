<?php

namespace App\DataTables;

use App\Models\Supplier;
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

class SuppliersDataTable extends DataTable
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
                $deleteOnclick = 'onclick="return deleteSupplierfirmation();"';
                $html = '<div class="row text-center">
                            <div class="col-4">
                                <a href="'.@route("suppliers.show", $row).'" class="btn-info '.$btnClasses.'" title="Voir">
                                    <i class="fa fa-eye mx-auto"></i>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="'.@route("suppliers.edit", $row).'" class="btn-success '.$btnClasses.'" title="Modifier">
                                    <i class="fa fa-edit mx-auto"></i>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="'.@route("suppliers.delete", $row).'" class="btn-danger '.$btnClasses.'" title="Supprimer" '.$deleteOnclick.'>
                                    <i class="fa fa-trash mx-auto"></i>
                                </a>
                            </div>
                        </div>';
                return new HtmlString($html);
            })
            ->addColumn('nbre_product', function($row){
                $products = Product::where('id_fournisseur', $row->id)->count();
                $html = '<a href="'.@route("suppliers.products", $row).'">'.$products.'</a>';             
                return new HtmlString($html);
            })  
            ->addColumn('approvisionnements', function($row){
                $products = Product::where('id_fournisseur', $row->id)->count();
                $html = '<span class="">'.$products.'</span>';             
                return new HtmlString($html);
            })  
            ->editColumn('nom', function ($row) {   
                $html = '<a href="'.@route("suppliers.show", $row).'">'.$row->nom.'</a>';             
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
    public function query(Supplier $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('suppliers-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bflrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
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
                  ->addClass('text-center')
                  ->style('min-width: 90px; max-width: 90px;'),
            Column::make('id')
                ->addClass('p-3 text-center')
                ->title("#ID"),
            Column::make('nom')
                ->addClass('p-3'),
            Column::make('location')
                ->addClass('p-3'),
            Column::make('tel')
                ->addClass('p-3 text-center')
                ->title("Téléphone"),
            Column::make('nbre_product')
                ->addClass('p-3 text-center')
                ->title("Nombre de produits"),
            Column::make('approvisionnements')
                ->addClass('p-3 text-center'),
            Column::make('created_at')
                ->addClass('p-3 text-center')
                ->title("Date d'ajout"),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Suppliers_' . date('YmdHis');
    }
}
