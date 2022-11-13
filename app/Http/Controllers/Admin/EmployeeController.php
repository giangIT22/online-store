<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Admin;
use App\Models\Role;
use App\Services\AdminServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $roles = Role::all();
        return view('admin.employee.create', compact('roles'));
    }

    public function store(EmployeeRequest $request)
    {
        $data = $request->except(['password_confirmation']);
        $data['password'] = Hash::make($data['password']);
        Admin::create($data);
        $notification = [
            'message' => 'Thêm nhân viên thành công',
            'alert-type' => 'success'
        ];
        return redirect()->route('all.employees')->with($notification);
    }

    public function edit($employeeId)
    {
        $statues = Admin::STATUES;
        $employee = Admin::findOrFail($employeeId);
        $roles = Role::all();
        return view('admin.employee.update', compact('employee', 'roles', 'statues'));
    }

    public function update(EmployeeUpdateRequest $request, $employeeId)
    {
        $employee = Admin::findOrFail($employeeId);
        $employee->update($request->all());
        $notification = [
            'message' => 'Cập nhật nhân viên thành công',
            'alert-type' => 'success'
        ];
        return redirect()->route('all.employees')->with($notification);
    }
    
    public function delete($employeeId)
    {
        try {
            Admin::findOrFail($employeeId)->delete();
            return response()->json([
                'code' => 200,
                'status' => true,
                'title' => 'Nhân viên'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 200,
                'status' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function search(Request $request)
    {
        try {
            if ($request->search_key) {
                $data = $this->adminService->searchEmployee($request->search_key);
                return response()->json($data);
            } else {
                $data = $this->adminService->getEmployees();
                return response()->json($data);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
