<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Imports\AgencyImports;
use App\Models\Department;
use App\Models\Agency;

class ImportController extends Controller
{
    //
    public function import_agencies(Request $request){

        $file = $request->file('agency-csv');

        $collection = (new AgencyImports)->toArray($file);
        
        // dd($collection);

        collect($collection[0])->each(function($row, $index){
            if($department = Department::where('display_name', $row['department'])->first()){
                if($agency = Agency::where('name',$row['agency'])->first()){
                    $agency->department_id = $department->id;
                    $agency->save();
                } else {
                    Agency::create(['sector'=>$row['department'], 'name'=>$row['agency'], 'department_id'=>$department->id, 'bsgc_status'=>$row['bsgc_status']]);
                }
                
                
            } else {
                Department::create(['display_name'=>$row['department']]);
            }
        });

        echo "DONE"; die();
    }
}
