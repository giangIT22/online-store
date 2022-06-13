@extends('layouts.admin', ['titlePage' => 'Danh mục sản phẩm'])

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <list-category
        @if ($categories) 
            :list-category="{{ $categories }}"
            :total="{{ $total }}"
            :last-page="{{ $lastPage }}"
        @endif    
    ></list-category>
@endsection
