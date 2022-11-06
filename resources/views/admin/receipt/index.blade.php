@extends('layouts.admin', ['titlePage' => 'Danh sách phiếu nhập kho'])
{{-- @php
    $coupons = collect([]);

    foreach ($listCoupons as $coupon) {
        $coupons->push($coupon);
    } 
@endphp --}}
@section('content')
    <list-receipt
        {{-- @if ($coupons) 
            :coupons="{{ $coupons }}"
            :total="{{ $total }}"
            :last-page="{{ $lastPage }}"
        @endif     --}}
    ></list-receipt>
@endsection
