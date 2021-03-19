<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel, SkipsOnError
{
    public function startRow(): int
    {
        return 2;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'name' => $row[0],
            'email' => $row[1],
            'role' => 'user',
            'password' => Hash::make($row[2]),
        ]);
    }

    public function onError(\Throwable $e)
    {
        Log::warning("error from user bulk upload");
        Log::warning($e);
    }
}
