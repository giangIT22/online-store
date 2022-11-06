@extends('layouts.admin', ['titlePage' => 'Danh sách nhà cung cấp'])
@php
    $companies = collect([]);

    foreach ($listCompanies as $item) {
        $companies->push($item);
    } 
@endphp
@section('content')
    <list-company
        @if ($companies) 
            :companies="{{ $companies }}"
            :total="{{ $total }}"
            :last-page="{{ $lastPage }}"
        @endif    
    ></list-company>
@endsection
