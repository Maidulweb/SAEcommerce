<?php

namespace App\DataTables;

use App\Models\ProductVariant;
use App\Models\VendorProductVariant;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductVariantDataTable extends DataTable
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
            $item = '<a href="'.route('vendor.product-variant-item.index',['productId'=>$query->product_id, 'variantId'=>$query->id]).'">Items</a>';
            $edit = '<a href="'.route('vendor.product-variant.edit',$query->id).'"><i class="far fa-edit"></i></a>';
            $delete = '<a class="delete-item" href="'.route('vendor.product-variant.destroy', $query->id).'"><i class="far fa-trash-alt"></i></a>';
            return $item.$edit.$delete;
          })
          ->addColumn('status',function($query){
            if($query->status == 1){
            
                $active = '<div class="form-check form-switch">
                <input class="form-check-input product-active" type="checkbox" checked  data-id="'.$query->id.'" id="flexSwitchCheckDefault">
              </div>';
                
                }else{
                
                $active = '<div class="form-check form-switch">
                <input class="form-check-input product-active" type="checkbox"  data-id="'.$query->id.'" id="flexSwitchCheckDefault">
              </div>';
                
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
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendorproductvariant-table')
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
        return 'VendorProductVariant_' . date('YmdHis');
    }
}
