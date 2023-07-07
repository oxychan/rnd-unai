<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\IncommingRequestWorker;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class IncommingRequestWorkerDataTable extends DataTable
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
            ->addColumn('Aksi', function ($req) {
                return "<div class='row row-reverse justify-content-end'>
                <div class='col'>
                    <a class='btn btn-info' href='javascript:void(0)' id='btnAccept' data-id='" . $req->id . "'>Terima</a>
                </div>
                <div class='col'>
                    <a class='btn btn-danger' href='javascript:void(0)' id='btnReject' data-id='" . $req->id . "'>Tolak</a>
                </div>
            </div>";
            })
            ->editColumn('updated_at', function ($req) {
                $formatedDate = Carbon::parse($req->updated_at);
                return $formatedDate->format('d M Y');
            })
            ->editColumn('title', function ($req) {
                return "<a href='" . route('permohonan.user.view', $req->id) . "'>" .  $req->title . "</a>";
            })
            ->editColumn('description', function ($req) {
                return Str::limit($req->description, 50, '...');
            })
            ->addIndexColumn()
            ->rawColumns(['title', 'Aksi', 'description'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\IncommingRequestWorker $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Request $model): QueryBuilder
    {
        $worker = $this->user;
        return $model->newQuery()
            ->from('requests')
            ->where('id_worker', $worker->id)
            ->where('is_worker_approved', 0)
            ->orderBy('updated_at', 'desc')
            ->orderBy('id_weight', 'asc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('incommingrequestworker-table')
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
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false)->width(30),
            Column::make('title')->title('Judul')->width(250),
            Column::make('description')->title('Deskripsi'),
            Column::make('updated_at')->title('Tgl Permohonan'),
            Column::computed('Aksi')
                ->exportable(false)
                ->printable(false)
                ->width(190)
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
        return 'IncommingRequestWorker_' . date('YmdHis');
    }
}
