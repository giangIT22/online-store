<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Services\CouponServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    protected $couponService;

    public function __construct(CouponServiceInterface $couponService)
    {
        $this->couponService = $couponService;    
    }

    public function index()
    {
        return view('admin.coupon.index', $this->couponService->getListCoupon());
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(CouponRequest $request)
    {
        $data = $request->all();

        if ($data['coupon_validity'] < Carbon::now()) {
            $data['status'] = 0;
        }

        $data['coupon_name'] = strtoupper($data['coupon_name']);
        
        $this->couponService->createCoupon($data);

        $notification = [
            'message' => 'Tạo Coupon thành công',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.coupons')->with($notification);
    }

    public function edit($couponId)
    {
        $coupon = $this->couponService->getInfoCoupon($couponId);

        return view('admin.coupon.update', compact('coupon'));
    }

    public function update($couponId, CouponRequest $request)
    {
        $data = $request->all();

        if ($data['coupon_validity'] < Carbon::now()) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }

        $data['coupon_name'] = strtoupper($data['coupon_name']);

        $this->couponService->updateCoupon($couponId, $data);

        $notification = [
            'message' => 'Cập nhật Coupon thành công',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.coupons')->with($notification);
    }
    
    public function delete($couponId)
    {
        try {
            Coupon::findOrFail($couponId)->delete();
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
}
