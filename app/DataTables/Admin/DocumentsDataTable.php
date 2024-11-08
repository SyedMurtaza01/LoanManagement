<?php

namespace App\DataTables\Admin;

use App\Models\Documents;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DocumentsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($documents) {
                return '
                <div class="d-flex gap-2">
                    <a href="' . route('admin.documents.edit', $documents->id) . '" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></a>
                    <form action="' . route('admin.documents.destroy', $documents->id) . '" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </div>';
            })
            ->addColumn('status', function ($documents) {
                $statusBadgeClass = '';

                // Determine the badge class based on the status value
                switch ($documents->status) {
                    case 'approved':
                        $statusBadgeClass = 'bg-success'; // Green for approved
                        break;
                    case 'pending':
                        $statusBadgeClass = 'bg-warning'; // Yellow for pending
                        break;
                    case 'rejected':
                        $statusBadgeClass = 'bg-danger'; // Red for rejected
                        break;
                    default:
                        $statusBadgeClass = 'bg-secondary'; // Gray for unknown status
                }

                return '
                <div class="d-flex gap-2">
                    <span class="badge ' . $statusBadgeClass . '">' . ucfirst($documents->status) . '</span>
                </div>';
            })
            ->addColumn('file', function ($documents) {
                // Generate the file URL dynamically for display in DataTable
                $filePath = asset('user/profile/' . $documents->file);
                return '<a href="' . $filePath . '" target="_blank">View File</a>';
            })
            ->setRowId('id')
            ->rawColumns(['action', 'status', 'file']);
    }

    /**
     * Fetch the query for the dataTable.
     */
    public function query(Documents $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Define the DataTable buttons, columns, etc.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('document-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print')
                    ]);
    }

    /**
     * Define the DataTable columns.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('file'),
            Column::computed('status')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Set the filename for export.
     */
    protected function filename(): string
    {
        return 'Documents_' . date('YmdHis');
    }
}
