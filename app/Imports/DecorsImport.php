<?php
namespace App\Imports;

use App\Models\Decor;
use Maatwebsite\Excel\Concerns\ToModel;

class DecorImport implements ToModel
{
    public function model(array $row)
    {
        return new Decor([
            'name' => $row[0],
            'description' => $row[1],
            'price' => $row[2],
            'image' => $row[3], // Assurez-vous que l'image est bien stockée
        ]);
    }
}
