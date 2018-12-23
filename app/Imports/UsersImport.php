<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new User([


            'name'     => $row[0],
            'email'    => $row[1],
            'password' => $row[2],
            'img'      => $row[3],
            'role'      => $row[4],
            'deleted_at' => $row[5],
        ]);
    }
}
