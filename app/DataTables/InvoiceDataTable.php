<?php

namespace App\DataTables;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InvoiceDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('customer_name', function(Invoice $invoice) {

                // $action = "<a class='btn btn-sm btn-warning' onclick='addToCart(".$product->id.")'><i class='fa fa-shopping-bag'></i></a>";
                return $invoice->customer->name;
            })
            ->addColumn('mobile_no', function(Invoice $invoice) {

                // $action = "<a class='btn btn-sm btn-warning' onclick='addToCart(".$product->id.")'><i class='fa fa-shopping-bag'></i></a>";
                return $invoice->customer->mobile_no;
            })
             ->rawColumns(['customer_name'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Invoice $model): QueryBuilder
    {
        $result = $model->with(['customer']);
        return $result->orderBy('id', 'DESC')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('invoice-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('invoice_number'),
            Column::make('customer_name'),
            Column::make('mobile_no'),
            Column::make('total_price'),
            Column::make('payment_type'),
            Column::make('note'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Invoice_' . date('YmdHis');
    }
}
