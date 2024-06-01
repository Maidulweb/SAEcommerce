<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\VendorProduct;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductDataTable extends DataTable
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

            $edit = '<a href="'.route('vendor.product.edit', $query->id).'"><i class="far fa-edit"></i></a>';
            
            $delete = '<a class="delete-item" href="'.route('vendor.product.destroy', $query->id).'"><i class="far fa-trash-alt"></i></a>';
            
            $mulltiimages = '<div class="btn-group dropstart">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-pencil-ruler"></i>
            </button>
            <ul class="dropdown-menu" style="">
              <li><a class="dropdown-item" href="'.route('vendor.product-image-gallery.index', ['productId'=>$query->id]).'">Image Gallery</a></li>
              <li><a class="dropdown-item" href="'.route('vendor.product-variant.index',['productId'=>$query->id]).'">Product Variant</a></li>
            </ul>
          </div>';
            
            return $edit.$delete.$mulltiimages;
            
            })
            
            ->addColumn('status', function($query){
            
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
            
            ->addColumn('product_type', function($query){
            
            switch($query->product_type){
            
                case 'new_product':
                return '<i class="badge bg-success">New Product</i>';
                break;
                
                case 'top_product':
                return '<i class="badge bg-primary">Top Product</i>';
                break;
                
                case 'featured_product':
                return '<i class="badge bg-warning">Featured Product</i>';
                break;

                case 'best_product':
                return '<i class="badge badge-info">Best Product</i>';  
                break;
            
            }
            
            })
            
            ->rawColumns(['action', 'status', 'product_type'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', Auth::user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendorproduct-table')
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
            Column::make('price'),
            Column::make('product_type'),
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
        return 'VendorProduct_' . date('YmdHis');
    }
}
