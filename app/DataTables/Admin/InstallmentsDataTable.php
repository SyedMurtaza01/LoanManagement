<?php

namespace App\DataTables\Admin;

use App\Models\Installments;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InstallmentsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($installments) {
                return '
                <div class="d-flex gap-2">
                    <a href="' . route('admin.installments.edit', $installments->id) . '" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></a>
                    <form action="' . route('admin.installments.destroy', $installments->id) . '" method="POST" style="display:inline;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </div>';
            })
            ->addColumn('status', function ($installments) {
                $statusBadgeClass = match ($installments->status) {
                    'approved' => 'bg-success',
                    'pending' => 'bg-warning',
                    'rejected' => 'bg-danger',
                    default => 'bg-secondary',
                };
                
                return '<span class="badge ' . $statusBadgeClass . '">' . ucfirst($installments->status) . '</span>';
            })
            ->addColumn('role', function ($installments) {
                return $installments->role ? $installments->role->name : 'N/A';
            })
            ->setRowId('id')
            ->rawColumns(['action', 'status']);
    }

    public function query(installments $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('installments-table')
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

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('application_id'),
            Column::make('installment'),
            Column::make('date'),
            Column::make('amount'),
            Column::make('payment_date'),
            Column::make('penalty'),
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

    protected function filename(): string
    {
        return 'installments_' . date('YmdHis');
    }
}
