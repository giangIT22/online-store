<?php

namespace App\Services;

interface SupplyCompanyServiceInterface
{
    public function all();
    public function store($params);
    public function edit($companyId);
    public function update($params, $companyId);
    public function delete($companyId);
    public function search($params);
}
