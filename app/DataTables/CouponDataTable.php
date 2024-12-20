<?php

namespace App\DataTables;

use App\Models\Coupon;
use App\Models\GeneralSetting;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CouponDataTable extends DataTable
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
              $edit = '<a href="'.route('admin.coupon.edit', $query->id).'"><i class="far fa-edit"></i></a>';
              $delete = '<a class="delete-item" href="'.route('admin.coupon.destroy', $query->id).'"><i class="far fa-trash-alt"></i></a>';
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
            ->addColumn('discount', function($query){
                if($query->discount_type == 'amount'){
                    return GeneralSetting::first()->currency_icon.$query->discount;
                }else{
                    return $query->discount.'%';
                }
            })
            ->rawColumns(['action','status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Coupon $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('coupon-table')
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
            Column::make('code'),
            Column::make('start_date'),
            Column::make('end_date'),
            Column::make('max_use_person'),
            Column::make('discount_type'),
            Column::make('discount'),
            Column::make('total_used'),
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
        return 'Coupon_' . date('YmdHis');
    }
}
