<?php

namespace App\DataTables;

use App\Models\Client;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use Illuminate\Support\HtmlString;

class ClientsDataTable extends DataTable
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
                $deleteOnclick = 'onclick="return deleteClientConfirmation();"';
                $html = '<div class="row text-center">
                            <div class="col-4">
                                <a href="'.@route("clients.show", $row).'" class="btn-info '.$btnClasses.'" title="Voir">
                                    <i class="fa fa-eye mx-auto"></i>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="'.@route("clients.edit", $row).'" class="btn-success '.$btnClasses.'" title="Modifier">
                                    <i class="fa fa-edit mx-auto"></i>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="'.@route("clients.delete", $row).'" class="btn-danger '.$btnClasses.'" title="Supprimer" '.$deleteOnclick.'>
                                    <i class="fa fa-trash mx-auto"></i>
                                </a>
                            </div>
                        </div>';
                return new HtmlString($html);
            })
            ->editColumn('nom', function ($item) {   
                $html = '<a href="clients/'.$item->id.'/show">'.$item->nom.'</a>';             
                return new HtmlString($html);
            })
            ->editColumn('prenom', function ($item) {   
                $html = '<a href="clients/'.$item->id.'/show">'.$item->prenom.'</a>';             
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
    public function query(Client $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('clients-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bflrtip')
                    ->orderBy(7)
                    ->selectStyleMulti()
                    ->parameters([
                        'paging' => true,
                        'searching' => true,
                        'info' => true,
                        'searchDelay' => 350,
                        'stateSave' => true,
                        "autoWidth" => false,
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
            Column::make('nom')->addClass('p-3'),
            Column::make('prenom')
                ->addClass('p-2')
                ->title('Prénom'),
            Column::make('date_naissance')
                ->addClass('text-center p-2')
                ->title('Date de naissance'),
            Column::make('adresse')
                ->addClass('p-2 text-wrap'),
            Column::make('email')
                ->addClass('p-2'),
            Column::make('tel')
                ->addClass('text-center p-2')
                ->title('N° Téléphone'),
            Column::make('created_at')
                ->addClass('text-center p-2')
                ->title('Date d\'inscription'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Clients_' . date('YmdHis');
    }
}
