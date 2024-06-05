<?php

namespace App\DataTables;

use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductVariantDataTable extends DataTable
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
              $item = '<a href="'.route('admin.product-variant-item.index',['productId'=>$query->product_id, 'variantId'=>$query->id]).'">Items</a>';
              $edit = '<a href="'.route('admin.product-variant.edit',$query->id).'"><i class="far fa-edit"></i></a>';
              $delete = '<a class="delete-item" href="'.route('admin.product-variant.destroy', $query->id).'"><i class="far fa-trash-alt"></i></a>';
              return $item.$edit.$delete;
            })
            ->addColumn('status',function($query){
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
            ->rawColumns(['action','status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariant $model): QueryBuilder
    {
        return $model->where('product_id', request()->productId)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('productvariant-table')
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
            Column::make('name'),
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
        return 'ProductVariant_' . date('YmdHis');
    }
}
