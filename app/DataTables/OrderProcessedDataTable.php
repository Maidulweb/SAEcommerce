<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderProcessedDataTable extends DataTable
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
               $show = '<a href="'.route('admin.order.show', $query->id).'"><i class="far fa-eye"></i></a>';
               
               $edit = '<a href="'.route('admin.order.edit', $query->id).'"><i class="far fa-edit"></i></a>';

               
               return $show.$edit;
            })
            ->addColumn('customer', function($query){
               return $query->user->name;
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
                        return '<i class="badge badge-success">Pending</i>';
                        break;
                        case'processed_and_ready_to_ship':
                        return '<i class="badge badge-info">Processed</i>';
                        break;
                        case'dropped_off':
                        return '<i class="badge badge-danger">Dropped Off</i>';
                        break;
                        case'shipped':
                        return '<i class="badge badge-secondary">Shipped</i>';
                        break;
                        case'out_for_delivery':
                        return '<i class="badge badge-warning">Out for delivery</i>';
                        break;
                        case'delivered':
                        return '<i class="badge badge-primary">Delivered</i>';
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
        return $model->where('order_status', 'processed_and_ready_to_ship')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('order-table')
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
            Column::make('invoice_id'),
            Column::make('customer'),
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
        return 'Order_' . date('YmdHis');
    }
}
