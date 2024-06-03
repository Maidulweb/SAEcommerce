<?php

namespace App\DataTables;

use App\Models\FlashSaleItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FlashSaleItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){
                $delete = '<a class="delete-item" href="'.route('admin.flash-sale-item-product.delete', $query->id).'"><i class="far fa-trash-alt"></i></a>';
                return $delete;
            })
            ->addColumn('product_name', function($query){
                return $query->product->name;
            })
            ->addColumn('end_date', function($query){
                return $query->flashSale->flash_sale_end_date;
            })
            ->addColumn('show_at_home', function($query){
                if($query->show_at_home == 1){
                    return '<i class="btn btn-success">Yes</i>';
                }
                return '<i class="btn btn-info">No</i>';
            })
            ->addColumn('status', function($query){
                if($query->status == 1){
                    return '<label class="custom-switch mt-2">
                    <input data-id="'.$query->id.'" type="checkbox" checked name="custom-switch-checkbox" class="custom-switch-input status-active">
                    <span class="custom-switch-indicator"></span>
                    </label>';
                }
                return '<label class="custom-switch mt-2">
                <input data-id="'.$query->id.'" type="checkbox" name="custom-switch-checkbox" class="custom-switch-input status-active">
                <span class="custom-switch-indicator"></span>
                </label>';
            })
            ->rawColumns(['action', 'product_name', 'show_at_home', 'status', 'end_date'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FlashSaleItem $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('flashsaleitem-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
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
            Column::make('product_name'),
            Column::make('end_date'),
            Column::make('show_at_home'),
            Column::make('status'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'FlashSaleItem_' . date('YmdHis');
    }
}
