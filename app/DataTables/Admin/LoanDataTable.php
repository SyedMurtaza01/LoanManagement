<?php

namespace App\DataTables\Admin;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LoanDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($loan) {
                return '
                <div class="d-flex gap-2">
                    <a href="' . route('admin.loans.edit', $loan->id) . '" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></a>
                    <form action="' . route('admin.loans.destroy', $loan->id) . '" method="POST" style="display:inline;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </div>';
            })
            ->addColumn('status', function ($loan) {
                $statusBadgeClass = match ($loan->status) {
                    'approved' => 'bg-success',
                    'pending' => 'bg-warning',
                    'rejected' => 'bg-danger',
                    default => 'bg-secondary',
                };
                
                return '<span class="badge ' . $statusBadgeClass . '">' . ucfirst($loan->status) . '</span>';
            })
            ->addColumn('role', function ($loan) {
                return $loan->role ? $loan->role->name : 'N/A';
            })
            ->setRowId('id')
            ->rawColumns(['action', 'status']);
    }

    public function query(Loan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('loan-table')
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
            Column::make('name'),
            Column::make('description'),
            Column::make('rate'),
            Column::make('month'),
            Column::make('min_amount'),
            Column::make('max_amount'),
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
        return 'Loan_' . date('YmdHis');
    }
}
