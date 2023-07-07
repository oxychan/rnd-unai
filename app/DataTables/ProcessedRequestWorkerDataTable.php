<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\ProcessedRequestWorker;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ProcessedRequestWorkerDataTable extends DataTable
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
            ->editColumn('updated_at', function ($req) {
                $formatedDate = Carbon::parse($req->updated_at);
                return $formatedDate->format('d M Y');
            })
            ->editColumn('title', function ($req) {
                return "<a href='" . route('permohonan.worker.view', $req->id) . "'>" . $req->title . "</a>";
            })
            ->editColumn('description', function ($req) {
                return Str::limit($req->description, 50, '...');
            })
            ->editColumn('status', function ($req) {
                return setStatus($req->status);
            })
            ->editColumn('id_weight', function ($req) {
                return setPriority($req->id_weight);
            })
            ->addIndexColumn()
            ->rawColumns(['title', 'description', 'status', 'id_weight'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ProcessedRequestWorker $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Request $model): QueryBuilder
    {
        $worker = $this->user;
        return $model->newQuery()
            ->from('requests')
            ->where('id_worker', $worker->id)
            ->where('is_worker_approved', 1)
            ->where('status', 1)
            ->orderBy('id_weight', 'asc')
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
            ->setTableId('processedrequestworker-table')
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
            Column::make('title')->title('Judul')->width(150),
            Column::make('status')->title('Status')->width(120),
            Column::make('id_weight')->title('Prioritas')->width(120),
            Column::make('description')->title('Deskripsi'),
            Column::make('updated_at')->title('Tgl Pengajuan'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'ProcessedRequestWorker_' . date('YmdHis');
    }
}
