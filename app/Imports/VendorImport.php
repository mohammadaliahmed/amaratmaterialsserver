<?php

namespace App\Imports;
use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

class VendorImport implements ToModel
{
    use Importable;

    public function model(array $row)
    {
    }
}
