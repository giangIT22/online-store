<?php

namespace App\Services;

interface ReceiptServiceInterface
{
    public function all();
    public function getData();
    public function store($params);
}
