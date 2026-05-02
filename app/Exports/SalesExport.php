<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sale::with('customer')
            ->latest('date')
            ->get();
    }


    public function headings(): array
    {
        return [
            'ID Venta',
            'Cliente',
            'Fecha',
            'Total',
            'Estado',
        ];
    }


    public function map($sale): array
    {
        return [
            $sale->id,
            $sale->customer->name ?? 'Cliente General',
            optional($sale->date)->format('d/m/Y H:i'),
            number_format($sale->total, 2),
            ucfirst($sale->status),
        ];
    }
}
