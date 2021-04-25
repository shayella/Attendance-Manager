<?php

namespace App\Imports;

use App\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        return new Student([
          'rollno' => $row[0],
          'name' => $row[1],
          'gender' => $row[2],
          'email' => $row[3],
          'phone' => $row[4],
          'gname' => $row[5],
          'gemail' => $row[6],
          'gphone' => $row[7],
          'class_id' => $row[8],
        ]);
    }
}
