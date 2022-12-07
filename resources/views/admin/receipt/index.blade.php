@extends('layouts.admin', ['titlePage' => 'Danh sách phiếu nhập kho'])
@php
    $receipts = collect([]);

    foreach ($listReceipts as $receipt) {
        $receipts->push($receipt);
    } 
@endphp
@section('content')
    <list-receipt
        @if ($receipts) 
            :receipts="{{ $receipts }}"
            :total="{{ $total }}"
            :last-page="{{ $lastPage }}"
        @endif    
    ></list-receipt>
@endsection
