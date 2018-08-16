<?php
namespace App\Exports;
 
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
 
class ProductoExport implements FromCollection, WithHeadings
{
    use Exportable;
 
    public function collection()
    {
        
    }
 
    public function headings(): array
    {
        return [
            'Hello',
            'world'
        ];
    }
 
}