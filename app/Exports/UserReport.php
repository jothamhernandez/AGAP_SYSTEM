<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\RegisteredUser;
use Illuminate\Support\Facades\DB;

class UserReport implements FromCollection, WithHeadings{

    public function headings():array {
        return [
            'Username','Email','Registered Date', 'Verification Status', 'First Name','Middle Name','Last Name','Birthdate','Gender','LLOU','Department','Sector','BSGC Status'
        ];
    }

    public function collection(){
        $data = DB::table('users')
        ->join('user_infos', "users.id","=","user_infos.user_id")
        ->leftjoin('agencies','user_infos.agency_id','=','agencies.id')
        ->leftjoin('departments','agencies.department_id','=','departments.id')->get([
            'users.username',
            'users.email',
            'users.created_at',
            'user_infos.first_name',
            'users.email_verified_at',
            'user_infos.middle_name',
            'user_infos.last_name',
            'user_infos.birthdate',
            'user_infos.gender',
            'user_infos.llou',
            'agencies.name',
            'agencies.sector',
            'agencies.bsgc_status'
        ]);

        


        $data = $data->map(function($rec){
            return [
                'Username'=>$rec->username,
                'Email'=>$rec->email,
                'Registered Date'=> ($rec->created_at) ? "YES" : "NO",
                'Verification Status' => $rec->email_verified_at,
                'First Name' => $rec->first_name,
                'Middle Name' => $rec->middle_name,
                'Last Name' => $rec->last_name,
                'Birthdate' => $rec->birthdate,
                'Gender' => $rec->gender,
                'LLOU' => $rec->llou,
                'Department' => $rec->name,
                'Sector' => $rec->sector,
                'BSGC Status' => $rec->bsgc_status
            ];
        });

        dd($data);
        return $data;
    }
}