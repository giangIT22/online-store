<?php

namespace App\Services;

interface CouponServiceInterface
{
    public function getListCoupon();
    public function createCoupon($params);
    public function getInfoCoupon($couponId);
    public function updateCoupon($couponId, $params);
    public function search($params);
}
