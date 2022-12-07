@extends('layouts.admin', ['titlePage' => 'Danh sách sản phẩm'])
@php
    $products = collect([]);
    
    foreach ($listProducts as $product) {
        $products->push($product);
    }
@endphp
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <list-product
        @if ($products)
            :products="{{ $products }}"
            :total="{{ $total }}"
            :last-page="{{ $lastPage }}" 
        @endif>
    </list-product>
@endsection
