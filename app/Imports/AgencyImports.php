<?php
namespace App\Imports;

use App\Models\Imports\AgencyCSVModel;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AgencyImports implements ToModel, WithHeadingRow {
    
    use Importable;

    public function model(array $row){
        return new AgencyCSVModel([
            'Department' => $row['department'],
            'Agency' => $row['agency'],
            'BSGC Status' => $row['bsgc_status']
        ]);
    }
}