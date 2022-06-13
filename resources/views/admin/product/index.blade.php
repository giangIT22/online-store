@extends('layouts.admin', ['titlePage' => 'Danh sách sản phẩm'])

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <list-product
        @if ($products) 
            :products="{{ $products }}"
            :total="{{ $total }}"
            :last-page="{{ $lastPage }}"
        @endif    
    ></list-product>
@endsection
