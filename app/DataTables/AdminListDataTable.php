<?php

namespace App\DataTables;

use App\Models\AdminList;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminListDataTable extends DataTable
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
            if($query->id != 1){
                $delete = '<a class="delete-item" href="'.route('admin.admin-list.destroy', $query->id).'">Delete</a>';
                return $delete;
            }
            
        })
            ->addColumn('status',function($query){
                if($query->id != 1){
                if($query->status == 'active'){
                   $active = '<label class="custom-switch mt-2">
                   <input type="checkbox" data-id="'.$query->id.'" checked name="custom-switch-checkbox" class="custom-switch-input change-status">
                   <span class="custom-switch-indicator"></span>
                 </label>';
                }else{
                    $active = '<label class="custom-switch mt-2">
                    <input type="checkbox" data-id="'.$query->id.'" name="custom-switch-checkbox" class="custom-switch-input change-status">
                    <span class="custom-switch-indicator"></span>
                  </label>';
                }
                return $active;
                }
            })
            ->rawColumns(['action','status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('adminlist-table')
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
            Column::make('name'),
            Column::make('email'),
            Column::make('role'),
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
        return 'AdminList_' . date('YmdHis');
    }
}