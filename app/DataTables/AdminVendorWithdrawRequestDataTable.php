<?php

namespace App\DataTables;

use App\Models\AdminVendorWithdrawRequest;
use App\Models\WithdrawVendorRequest;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminVendorWithdrawRequestDataTable extends DataTable
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
            return '<a href="'.route('admin.vendor-withdraw-request.show', $query->id).'"><i class="fas fa-eye"></i></a>';
        })
        ->addColumn('method', function($query){
            if($query->method == 1){
                return 'Bank';
            }else {
                return 'Paypal';
            }
        })
        ->addColumn('created_at',function($query){
            return date("d M Y", strtotime($query->created_at));
        })
        ->addColumn('vendor', function($query){
            return $query->vendor->shop_name;
        })
        ->filterColumn('vendor',function($query, $keyword){
          $query->whereHas('vendor', function($subQuery) use ($keyword){
            $subQuery->where('shop_name', 'like', '%'.$keyword.'%');
          });
        })
        ->rawColumns(['action','method','created_at'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(WithdrawVendorRequest $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('adminvendorwithdrawrequest-table')
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
            Column::make('vendor'),
            Column::make('method'),
            Column::make('total_amount'),
            Column::make('withdraw_amount'),
            Column::make('charge'),
            Column::make('status'),
            Column::make('created_at'),
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
        return 'AdminVendorWithdrawRequest_' . date('YmdHis');
    }
}
