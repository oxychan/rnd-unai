<?php

namespace App\DataTables;

use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
            ->addColumn('action', function ($user) {
                return "<div class='dropdown'>
                            <button class='btn btn-light btn-active-light-primary btn-sm dropdown-toggle' type='button' id='actionButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            Action
                            </button>
                            <div class='dropdown-menu' aria-labelledby='actionButton'>
                                <a class='dropdown-item px-3' href='javascript:void(0)' id='editUser' data-id='" . $user->id . "'>Edit</a>
                                <a class='dropdown-item px-3' href='javascript:void(0)' id='deleteUser' data-id='" . $user->id . "'>Hapus</a>
                            </div>
                        </div>";
            })
            ->addColumn('role', function ($user) {
                return '<div class="badge badge-light-info fw-bold">' . $user->roles->pluck('name')[0] . '</div>';
            })
            ->addColumn('avatar', function ($user) {
                $photoPath = asset('assets/media/img/profile/' . $user->avatar);
                return '<div class="symbol symbol-50px me-5">
                            <img alt="Logo" src="' . $photoPath . '" />
                        </div>';
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'avatar', 'role'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
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
            ->setTableId('user-table')
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
            Column::make('name')->title('Name'),
            Column::make('username')->title('Username'),
            Column::make('email')->title('Email'),
            Column::make('telp')->title('Phone Number'),
            Column::computed('role')
                ->title('Role')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::computed('avatar')
                ->title('Avatar')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::computed('action')
                ->title('Action')
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
        return 'User_' . date('YmdHis');
    }
}
