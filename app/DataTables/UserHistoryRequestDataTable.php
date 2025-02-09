<?php

namespace App\DataTables;

use App\Models\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\UserHistoryRequest;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class UserHistoryRequestDataTable extends DataTable
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
            ->addColumn('action', function ($req) {
                return "<a class='btn btn-info' id='btnDetail' data-id='" . $req->id . "'>Detail</a>";
            })
            ->editColumn('status', function ($req) {
                return setStatus($req->status);
            })
            ->editColumn('updated_at', function ($req) {
                $formatedDate = Carbon::parse($req->updated_at);
                return $formatedDate->format('d M Y');
            })
            ->editColumn('description', function ($req) {
                return Str::limit($req->description, 50, '...');
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'status', 'description'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\UserHistoryRequest $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Request $model): QueryBuilder
    {
        $user = $this->user;

        return $model->newQuery()
            ->from('requests')
            ->where('id_user', $user->id)
            ->where('status', '=', 3)
            ->where('is_duplicated', 0)
            ->orderBy('updated_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('userhistoryrequest-table')
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
            Column::make('title')->title('Judul'),
            Column::make('description')->title('Deskripsi')->width(120),
            Column::make('updated_at')->title('Tgl Pengajuan'),
            Column::make('status')->title('Status'),
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
        return 'UserHistoryRequest_' . date('YmdHis');
    }
}
