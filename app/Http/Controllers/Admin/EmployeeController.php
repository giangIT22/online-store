<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminServiceInterface;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $adminService;

    public function __construct(AdminServiceInterface $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        return view('admin.employee.index', $this->adminService->getEmployees());
    }

    public function create()
    {
        return view('admin.employee.create');
    }

    public function store()
    {

    }

    public function edit()
    {

    }

    public function update()
    {
        
    }
}
