<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ProcessedRequestDataTable extends DataTable
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
                return "<a href='" . route('permohonan.user.view', $req->id) . "'>" . $req->title . "</a>";
            })
            // ->editColumn('Keterangan', function ($req) {
            //     $status = '';
            //     if ($req->is_duplicated) {
            //         $status = 'Diduplikasi';
            //     } else if ($req->is_data_duplicate) {
            //         $status = 'Data Duplikat';
            //     }
            //     return "<div class='badge badge-dark fw-bold'>" . $status  . "</div>";
            // })
            ->editColumn('description', function ($req) {
                return Str::limit($req->description, 50, '...');
            })
            ->editColumn('status', function ($req) {
                return setStatus($req->status);
            })
            ->addIndexColumn()
            ->rawColumns(['title', 'description', 'status'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ProcessedRequest $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Request $model): QueryBuilder
    {
        return $model->newQuery()
            ->from('requests')
            ->where('status', 1)
            ->orWhere('status', 2)
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
            ->setTableId('processedrequest-table')
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
            // Column::make('Keterangan')->width(120),
            Column::make('status')->title('Status')->width(120),
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
        return 'ProcessedRequest_' . date('YmdHis');
    }
}
