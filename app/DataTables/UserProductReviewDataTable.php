<?php

namespace App\DataTables;

use App\Models\ProductReview;
use App\Models\UserProductReview;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserProductReviewDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('product', function($query){
                return $query->product->name;
              })
            ->addColumn('vendor', function($query){
                return $query->product->vendor->shop_name;
              })
            ->addColumn('status', function($query){
                if($query->status == 1){
                    return '<span class="text-primary">Approved</span>';
                }else {
                    return '<span class="text-info">Pending</span>';
                }
              })
            ->addColumn('created_at', function($query){
            return date('d M Y', strtotime($query->created_at));
            })  
            ->rawColumns(['status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductReview $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('userproductreview-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
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
     */
    public function getColumns(): array
    {
        return [
            
            Column::make('id'),
            Column::make('product'),
            Column::make('vendor'),
            Column::make('rating'),
            Column::make('review'),
            Column::make('status'),
            Column::make('created_at')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'UserProductReview_' . date('YmdHis');
    }
}