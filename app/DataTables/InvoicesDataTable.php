<?php

namespace App\DataTables;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use Illuminate\Support\HtmlString;

class InvoicesDataTable extends DataTable
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
                $deleteOnclick = 'onclick="return deleteInvoiceConfirmation();"';
                $html = '<div class="row text-center">
                            <div class="col-4">
                                <a href="'.@route("invoices.show", $row).'" class="btn-info '.$btnClasses.'" title="Voir" target="_blank">
                                    <i class="fa fa-eye mx-auto"></i>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="'.@route("invoices.print", $row).'" class="btn-primary '.$btnClasses.'" title="Imprimer">
                                    <i class="fa fa-print mx-auto"></i>
                                </a>
                            </div>
                        </div>';
                return new HtmlString($html);
            })
            ->addColumn('commande', function($row){
                $order = Order::findOrFail($row->id_commande);

                $html = '<a href="'.@route("orders.show", $order->id).'">'.$order->reference.'</a>';             
                return new HtmlString($html);
            })
            ->editColumn('reference', function($row) {
                $html = '<a href="'.@route("invoices.show", $row).'">'.$row->reference.'</a>';
                return new HtmlString($html);
            })
            ->editColumn('montant_HT', function($row) {
                $html = '<span class="font-weight-bold" >'.number_format($row->montant_HT, 2).' DA</span>';
                return new HtmlString($html);
            })
            ->editColumn('montant_TTC', function($row) {
                $html = '<span class="font-weight-bold" >'.number_format($row->montant_TTC, 2).' DA</span>';
                return new HtmlString($html);
            })
            ->editColumn('montant_TVA', function($row) {
                $html = '<span class="font-weight-bold" >'.number_format($row->montant_TVA, 2).' DA</span>';
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
    public function query(Invoice $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('invoices-table')
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
                  ->addClass('text-center')
                  ->style('min-width: 90px; max-width: 90px;'),
            Column::make('reference')
                ->addClass('p-3'),
            Column::make('montant_HT')
                ->addClass('text-right'),
            Column::make('montant_TTC')
                ->addClass('text-right'),
            Column::make('montant_TVA')
                ->addClass('text-right'),
            Column::make('taux_TVA')
                ->addClass('text-center'),
            Column::make('commande'),
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
        return 'Invoices_' . date('YmdHis');
    }
}
