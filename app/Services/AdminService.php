<?php

namespace App\Services;

use App\Models\Admin;

class AdminService implements AdminServiceInterface
{
    public function getEmployees()
    {
        $data = Admin::with('role')->orderBy('id', 'desc')->paginate(Admin::PER_PAGE);
        
        return [
            'listEmployees' => $data->items(),
            'total' => $data->total(),
            'lastPage' => $data->lastPage()
        ];
    }

    public function searchEmployee($params)
    {
        $dataSearch = Admin::search($params)->query(function ($builder) {
            $builder->with('role');
        })->paginate(Admin::PER_PAGE);
        return [
            'listEmployees' => $dataSearch->items(),
            'lastPage' => $dataSearch->lastPage()
        ];
    }
}
