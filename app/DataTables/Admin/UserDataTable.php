<?php

namespace App\DataTables\Admin;

use App\Models\User;
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
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($user) {
                return '
                <div class="d-flex gap-2">
                    <a href="' . route('admin.users.edit', $user->id) . '" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></a>
                    <form action="' . route('admin.users.destroy', $user->id) . '" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </div>';

            })
            ->addColumn('status', function ($user) {
                $statusBadgeClass = '';
            
                // Determine the badge class based on the status value
                switch ($user->status) {
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
                    <span class="badge ' . $statusBadgeClass . '">' . ucfirst($user->status) . '</span>
                </div>';
            })
            
            ->addColumn('role', function ($user) {
                return $user->role->name;
            })
            ->addColumn('name', function ($user) {
                $profileImage = $user->profile ? asset('user/profile/' . $user->profile) : asset('default-image.webp');

                return '<img src="' . $profileImage . '" alt="user-image" class="me-1 rounded-circle border" height="30" width="30 ">' . $user->name;
            })
            

            ->setRowId('id')
            ->rawColumns(['action','role','name', 'status']);
    }


    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }


    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
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
            Column::make('email'),
            Column::make('address'),
            Column::make('branch'),
            Column::make('role'),
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
        return 'User_' . date('YmdHis');
    }
}
