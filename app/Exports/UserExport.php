<?php

namespace App\Exports;

use App\User;
use App\Cart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    function __construct($ids) {
    $this->ids = $ids;
  	} 

    public function query()
    {
        $all_ids = explode(',', $this->ids);
        return User::where(function($query) use ($all_ids) {
            for ($i=0; $i < count($all_ids) ; $i++) { 
                $query->orWhere('id', $all_ids[$i]);
            }
        });
    }

    public function map($user): array
    {	


        return [
            $user->name,
            $user->phone_number,
            $user->email,
            $user->address,
            
            

        ];
    }


     public function headings(): array
    {
        return [
            'Name',
            'Phone Number',
            'Email',
            'Address',
            
        ];
    }
}
