<?php

namespace App\DataTables;

use App\Models\ProductVariantItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use PhpParser\Node\Stmt\Switch_;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductVariantItemDataTable extends DataTable
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
                $edit = '<a href="'.route('admin.product-variant-item.edit', $query->id).'"><i class="far fa fa-edit"></i></a>';
                $delete = '<a class="delete-item" href="'.route('admin.product-variant-item.delete', $query->id).'"><i class="far fa fa-trash-alt"></i></a>';

                return $edit.$delete;
            })
            ->addColumn('status', function($query){
                if($query->status == 1){
                    $active = '<label class="custom-switch mt-2">
                    <input data-id="'.$query->id.'" type="checkbox" checked name="custom-switch-checkbox" class="custom-switch-input status-active">
                    <span class="custom-switch-indicator"></span>
                    </label>';
                }else {
                    $active = '<label class="custom-switch mt-2">
                    <input data-id="'.$query->id.'" type="checkbox" name="custom-switch-checkbox" class="custom-switch-input status-active">
                    <span class="custom-switch-indicator"></span>
                    </label>';
                }

                return $active;
            })
            ->addColumn('variant_name', function($query){
                return $query->productVariant->name;
            })
            ->addColumn('is_default', function($query){
                if($query->is_default == 1){
                    return '<i class="btn btn-primary">Yes</i>';
                }else {
                    return '<i class="btn btn-info">No</i>';
                }
            })
            ->rawColumns(['action', 'status', 'variant_name', 'is_default'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariantItem $model): QueryBuilder
    {
        return $model->where('product_variant_id', request()->variantId)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('productvariantitem-table')
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
            Column::make('variant_name'),
            Column::make('name'),
            Column::make('price'),
            Column::make('is_default'),
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
        return 'ProductVariantItem_' . date('YmdHis');
    }
}
