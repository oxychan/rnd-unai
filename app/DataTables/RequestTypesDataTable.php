<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\RequestType;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class RequestTypesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($requestType) {
                return "<div class='dropdown'>
                            <button class='btn btn-light btn-active-light-primary btn-sm dropdown-toggle' type='button' id='actionButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            Action
                            </button>
                            <div class='dropdown-menu' aria-labelledby='actionButton'>
                                <a class='dropdown-item px-3' href='javascript:void(0)' id='editRequestType' data-id='" . $requestType->id . "'>Edit</a>
                                <a class='dropdown-item px-3' href='javascript:void(0)' id='deleteRequestType' data-id='" . $requestType->id . "'>Hapus</a>
                            </div>
                        </div>";
            })
            ->editColumn('created_at', function ($requestType) {
                $formatedDate = Carbon::parse($requestType->created_at);
                return $formatedDate->format('d M Y');
            })
            ->editColumn('updated_at', function ($requestType) {
                $formatedDate = Carbon::parse($requestType->updated_at);
                return $formatedDate->format('d M Y');
            })
            ->rawColumns(['action', 'created_at', 'updated_at'])
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\RequestType $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RequestType $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('requesttypes-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->serverSide()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false),
            Column::make('name')->title('Name'),
            Column::make('created_at')->title('Created At'),
            Column::make('updated_at')->title('Updated At'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'RequestTypes_' . date('YmdHis');
    }
}
