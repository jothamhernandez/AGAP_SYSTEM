<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\RegisteredUser;

class EventReport implements FromCollection, WithHeadings{
    protected $event_id;
    
    public function __construct($event_id)
    {
        $this->event_id = $event_id;   
    }

    public function headings():array {
        return [
            'Member','Sector','Agency','LLOU','Registration Date','Fee','Status'
        ];
    }

    public function collection(){
        $data = RegisteredUser::where('event_id',$this->event_id)->with('user')->orderBy('status')->get();
        $data = $data->map(function($rec){
            return [
                'Member'    => ($rec->user->info->fullname() != ' ') ? $rec->user->info->fullname() : $rec->user->username,
                'Sector'    => $rec->user->info->agency->sector,
                'Agency'    => $rec->user->info->agency->name,
                'LLOU'      => $rec->user->info->llou,
                'Registration Date' => $rec->created_at->format('Y-m-d'),
                'Fee'       => $rec->fee->fee,
                'Status'    => $rec->status
            ];
        });
        return $data;
    }
}