<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\Request;
use Illuminate\Support\Str;
use App\Models\DoneRequestSpv;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class DoneRequestSpvDataTable extends DataTable
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
            ->editColumn('status', function ($req) {
                return setStatus($req->status);
            })
            ->editColumn('title', function ($req) {
                return "<a href='" . route('permohonan.user.view.result', $req->id) . "'>" . $req->title . "<a/>";
            })
            ->editColumn('description', function ($req) {
                return Str::limit($req->description, 50, '...');
            })
            ->addIndexColumn()
            ->rawColumns(['status', 'title', 'description'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DoneRequestSpv $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Request $model): QueryBuilder
    {
        $spv = $this->user;
        return $model->newQuery()
            ->from('requests')
            ->where('id_spv', $spv->id)
            ->where('is_spv_approved', 1)
            ->where('status', 3)
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
            ->setTableId('donerequestspv-table')
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
            Column::make('status')->title('Status'),
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
        return 'DoneRequestSpv_' . date('YmdHis');
    }
}
