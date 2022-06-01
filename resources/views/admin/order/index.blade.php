@extends('layouts.admin', ['titlePage' => 'Danh sách mã giảm giá'])
@php
    $orders = collect([]);

    foreach ($listOrder as $order) {
        $orders->push($order);
    } 
@endphp
@section('content')
    <list-order
        @if ($orders) 
            :orders="{{ $orders }}"
            :total="{{ $total }}"
            :last-page="{{ $lastPage }}"
        @endif    
    ></list-order>
@endsection
