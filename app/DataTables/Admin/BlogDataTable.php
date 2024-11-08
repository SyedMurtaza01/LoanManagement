<?php
namespace App\DataTables\Admin;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;


class BlogDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        // return (new EloquentDataTable($query))
        //     ->addColumn('action', 'blog.action')
        //     ->setRowId('id');

        return (new EloquentDataTable($query))
        ->addColumn('action', function ($blog) {
            return '
            <div class="d-flex gap-2">
            <a href="' . route('admin.blogs.edit', $blog->id) . '" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></a>
                <form action="' . route('admin.blogs.destroy', $blog->id) . '" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                </form>
            </div>';

        })

        ->addColumn('Title', function ($blog) {
            return $blog->title;
        })
        ->addColumn('Description', function ($blog) {
            // return $blog->description;
            return $blog->description ? $blog->description : 'No Description';
        })
        ->addColumn('Link', function ($blog) {
            return $blog->link ? $blog->link : 'No Video Link';
        })
        ->addColumn('Image', function ($blog) {

            $blogImage = $blog->image ? asset('blog/image/' . $blog->image) : asset('default-image.webp');

            return '<img src="' . $blogImage . '" alt="user-image" class="me-1 rounded-circle border" height="30" width="30 ">';
        })
        ->addColumn('Type', function ($blog) {

            if ($blog->type == '1') {

                return "Video";
            }else if($blog->type == '2'){

                return "Description";
            }
        })
        ->setRowId('id')
        ->rawColumns(['action','Image']);
    }

    public function query(Blog $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('blog-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        // Button::make('reset'),
                        // Button::make('reload')
                    ]);
    }


    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('Title'),
            Column::make('Description'),
            Column::make('Link'),
            Column::make('Image'),
            Column::make('Type'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Blog_' . date('YmdHis');
    }
}
