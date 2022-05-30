@extends('layouts.admin', ['titlePage' => 'Danh sách mã giảm giá'])
@php
    $coupons = collect([]);

    foreach ($listCoupons as $coupon) {
        $coupons->push($coupon);
    } 
@endphp
@section('content')
    <list-coupon
        @if ($coupons) 
            :coupons="{{ $coupons }}"
            :total="{{ $total }}"
            :last-page="{{ $lastPage }}"
        @endif    
    ></list-slider>
@endsection
