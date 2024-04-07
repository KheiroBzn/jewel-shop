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

class SuppliesDataTable extends DataTable
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
                $deleteOnclick = 'onclick="return deleteSupplyfirmation();"';
                $html = '<div class="row text-center">
                            <div class="col-4">
                                <a href="'.@route("supply.show", $row).'" class="btn-info '.$btnClasses.'" title="Voir">
                                    <i class="fa fa-eye mx-auto"></i>
                                </a>
                            </div>';
                return new HtmlString($html);
        })
        ->addColumn('produit', function ($row) {   
            $product = Product::findOrFail($row->id_produit);
            $html = '<a href="'.@route("products.details", $product->id).'">'.$product->nom.'</a>';             
            return new HtmlString($html);
        })   
        ->addColumn('fournisseur', function($row){
            $supplier = Supplier::findOrFail($row->id_fournisseur);
            $html = '<a href="'.@route("suppliers.show", $supplier->id).'">'.$supplier->nom.'</a>';             
            return new HtmlString($html);
        })
        ->editColumn('prix', function($row) {
            $html = '<span class="font-weight-bold" >'.number_format($row->prix, 2).' DA</span>';
            return new HtmlString($html);
        })
        ->editColumn('qte', function($row){
            $html = '<span class="">'.$row->qte.'</span>';             
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
    public function query(Supply $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('supplies-table')
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
                ->addClass('text-center')
                ->style('min-width: 90px; max-width: 90px;'),
            Column::make('produit')
                ->addClass('p-3 text-wrap'),
            Column::make('qte')
                ->addClass('p-3 '),
            Column::make('prix')
                ->addClass('p-3'),
            Column::make('fournisseur')
                ->addClass('p-3 text-wrap'),
            Column::make('created_at')
                ->addClass('p-3')
                ->title('Date d\'ajout'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Supplies_' . date('YmdHis');
    }
}
