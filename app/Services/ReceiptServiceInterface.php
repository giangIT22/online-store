<?php

namespace App\Services;

interface ReceiptServiceInterface
{
    public function all();
    public function getData();
    public function storeReceipt($params);
    public function search($params);
}
