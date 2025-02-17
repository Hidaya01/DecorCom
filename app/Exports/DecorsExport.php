<?php
namespace App\Exports;

use App\Models\Decor;
use Maatwebsite\Excel\Concerns\FromCollection;

class DecorExport implements FromCollection
{
    public function collection()
    {
        return Decor::select('name', 'description', 'price', 'image')->get();
    }
}

