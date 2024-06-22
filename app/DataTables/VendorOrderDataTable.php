<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\VendorOrder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorOrderDataTable extends DataTable
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
            $show = '<a href="'.route('vendor.order.show', $query->id).'"><i class="far fa-eye"></i></a>';
            return $show;
         })
            ->addColumn('Date',function($query){
                return date('d-M-Y', strtotime($query->created_at));
             })
             ->addColumn('sub_total', function($query){
                return $query->currency_icon.$query->sub_total;
             })
             ->addColumn('amount', function($query){
                return $query->currency_icon.$query->amount;
             })
             ->addColumn('order_status', function($query){
                switch($query->order_status){
                        case'pending':
                        return '<button class="btn btn-success">Pending</button>';
                        break;
                        case'processed_and_ready_to_ship':
                        return '<button class="btn btn-info">Processed</button>';
                        break;
                        case'dropped_off':
                        return '<button class="btn btn-danger">Dropped Off</button>';
                        break;
                        case'shipped':
                        return '<button class="btn btn-secondary">Shipped</button>';
                        break;
                        case'out_for_delivery':
                        return '<button class="btn btn-warning">Out for delivery</button>';
                        break;
                        case'delivered':
                        return '<button class="btn btn-primary">Delivered</button>';
                        break;
                }

                
             })
            
             ->rawColumns(['action','order_status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->whereHas('orderProduct', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendororder-table')
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
            Column::make('invoice_id'),
            Column::make('Date'),
            Column::make('sub_total'),
            Column::make('amount'),
            Column::make('product_qty'),
            Column::make('payment_method'),
            Column::make('payment_status'),
            Column::make('order_status'),
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
        return 'VendorOrder_' . date('YmdHis');
    }
}
