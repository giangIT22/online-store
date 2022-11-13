<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Services\SupplyCompanyServiceInterface;
use Illuminate\Http\Request;

class SupplyCompanyController extends Controller
{
    protected $supllyCompanyService;

    public function __construct(SupplyCompanyServiceInterface $supllyCompanyService)
    {
        $this->supllyCompanyService = $supllyCompanyService;
    }

    public function index()
    {
        return view('admin.company.index', $this->supllyCompanyService->all());
    }

    public function create()
    {
        return view('admin.company.create');
    }

    public function store(CompanyRequest $request)
    {
        $this->supllyCompanyService->store($request->all());

        $notification = [
            'message' => 'Thêm nhà cung cấp thành công',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.companies')->with($notification);
    }

    public function edit($companyId)
    {
        $company = $this->supllyCompanyService->edit($companyId);

        return view('admin.company.update', compact('company'));
    }

    public function update(CompanyRequest $request, $companyId)
    {
        $this->supllyCompanyService->update($request->all(), $companyId);

        $notification = [
            'message' => 'Cập nhật nhà cung cấp thành công',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.companies')->with($notification);
    }

    public function delete($companyId)
    {
        try {
            $this->supllyCompanyService->delete($companyId);
            return response()->json([
                'code' => 200,
                'status' => true,
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
                $data = $this->supllyCompanyService->search($request->search_key);
                return response()->json($data);
            } else {
                $data = $this->supllyCompanyService->all();
                return response()->json($data);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
