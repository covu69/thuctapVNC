<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }
    /**
     * Returns headers for report
     * @return array
     */
    public function headings(): array {
        return [
            'ID',
            'Name',
            'Email',  
            'password',
            'Role',
            "Created",
            "Updated",
            'Deleted_at'
            
        ];
    }
 
    public function map($user): array {
        return [
            $user->id,
            $user->name,
            $user->email, 
            '',  
            $user->role,
            $user->created_at,
            $user->updated_at,
            $user->deleted_at
        ];
    }

    
}
