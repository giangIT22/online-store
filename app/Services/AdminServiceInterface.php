<?php

namespace App\Services;

interface AdminServiceInterface
{
    public function getEmployees();
    public function searchEmployee($params);
}
