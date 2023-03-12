<?php

namespace App\DataTables;

use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class RolesDataTable extends DataTable
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
            ->addColumn('action', function ($role) {
                return "<div class='dropdown'>
                        <button class='btn btn-light btn-active-light-primary btn-sm dropdown-toggle' type='button' id='actionButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        Action
                        </button>
                        <div class='dropdown-menu' aria-labelledby='actionButton'>
                            <a class='dropdown-item px-3' href='javascript:void(0)' id='editRole' data-id='" . $role->id . "'>Edit</a>
                            <a class='dropdown-item px-3' href='javascript:void(0)' id='deleteRole' data-id='" . $role->id . "'>Hapus</a>
                            <a class='dropdown-item px-3' href='javascript:void(0)' id='configurePermission' data-id='" . $role->id . "'>Hak Akses</a>
                        </div>
                    </div>";
            })
            ->editColumn('created_at', function ($role) {
                $formatedDate = Carbon::parse($role->created_at);
                return $formatedDate->format('l, d-m-Y, h:i:s A');
            })
            ->editColumn('updated_at', function ($role) {
                $formatedDate = Carbon::parse($role->updated_at);
                return $formatedDate->format('l, d-m-Y, h:i:s A');
            })
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model): QueryBuilder
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
            ->setTableId('roles-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->serverSide()
            ->orderBy(1)
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
            Column::make('name'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
        return 'Roles_' . date('YmdHis');
    }
}
