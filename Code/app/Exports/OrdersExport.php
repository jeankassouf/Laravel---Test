<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Orders;

class OrdersExport implements FromCollection,WithHeadings
{
    public function headings(): array
    {
        return [
            'Order No',
            'First Name',
            'Last Name',
            'Email',
            'Phone Number',
            'Country',
            'Quantity',
            'Total Amount',
            'Date'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Orders::select('order_number','first_name','last_name','email','phone','country','quantity','total_amount','created_at')->orderBy('id','DESC')->get();
    }
}
