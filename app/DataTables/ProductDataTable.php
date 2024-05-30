<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
                $edit = '<a href="'.route('admin.product.edit', $query->id).'"><i class="far fa-edit"></i></a>';
                $delete = '<a  class="delete-item" href="'.route('admin.product.destroy', $query->id).'"><i class="far fa-trash-alt"></i></a>';
                $mulltiimages = '<div class="btn-group dropleft show">
                <button type="button" class="dropdown-toggle product-action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="fas fa-pencil-ruler"></i>
                </button>
                <div class="dropdown-menu dropleft" x-placement="left-start" style="position: absolute; transform: translate3d(-202px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                  <a class="dropdown-item" href="'.route('admin.product-image-gallery.index', ['productId'=>$query->id]).'">Image Gallery</a>
                  <a class="dropdown-item" href="'.route('admin.product-variant.index',['productId'=>$query->id]).'">Product Variant</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Separated link</a>
                </div>
              </div>';
              return $edit.$delete.$mulltiimages;
            })
            ->addColumn('status', function($query){
                if($query->status == 1){
                  $active = '<label class="custom-switch mt-2">
                  <input type="checkbox" data-id="'.$query->id.'" checked name="custom-switch-checkbox" class="custom-switch-input product-active">
                  <span class="custom-switch-indicator"></span>
                </label>';
                }else{
                  $active = '<label class="custom-switch mt-2">
                  <input type="checkbox" data-id="'.$query->id.'" name="custom-switch-checkbox" class="custom-switch-input product-active">
                  <span class="custom-switch-indicator"></span>
                </label>';
                }
                return $active;
              })
              ->addColumn('product_type', function($query){
                  switch($query->product_type){
                    case 'new_product':
                        return '<i class="badge badge-success">New Product</i>';
                        break;

                    case 'top_product':
                        return '<i class="badge badge-primary">Top Product</i>';
                        break;

                    case 'featured_product':
                        return '<i class="badge badge-warning">Featured Product</i>';
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
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
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
            Column::make('thumb_image'),
            Column::make('name'),
            Column::make('product_type'),
            Column::make('status'),
            Column::make('price'),
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
        return 'Product_' . date('YmdHis');
    }
}
