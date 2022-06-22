<?php

namespace App\Services;

use App\Models\Admin;

class AdminService implements AdminServiceInterface
{
    public function getEmployees()
    {
        $data = Admin::orderBy('id', 'desc')->paginate(Admin::PER_PAGE);

        return [
            'listEmployees' => $data->items(),
            'total' => $data->total(),
            'lastPage' => $data->lastPage()
        ];
    }
}
