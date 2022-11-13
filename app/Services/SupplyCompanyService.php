<?php

namespace App\Services;

use App\Models\SupplyCompany;

class SupplyCompanyService implements SupplyCompanyServiceInterface
{
    public function all()
    {
        $data = SupplyCompany::orderBy('created_at', 'desc')->paginate(SupplyCompany::PER_PAGE);

        return [
            'listCompanies' =>  $data->items(),
            'total' => $data->total(),
            'lastPage' => $data->lastPage(),
            'currentPage' => $data->currentPage()
        ];
    }

    public function create()
    {

    }

    public function store($params)
    {
        SupplyCompany::create($params);
    }

    public function edit($companyId)
    {
        return SupplyCompany::findOrFail($companyId);
    }

    public function update($params, $companyId)
    {
        $company = SupplyCompany::findOrFail($companyId);
        $company->update($params);
    }

    public function delete($companyId)
    {
        $company = SupplyCompany::findOrFail($companyId);
        $company->delete();
    }

    public function search($params)
    {
        $dataSearch = SupplyCompany::search($params)->paginate(SupplyCompany::PER_PAGE);

        return [
            'listCompanies' => $dataSearch->items(),
            'lastPage' => $dataSearch->lastPage()
        ];
    }
}
