@extends('layouts.admin', ['titlePage' => 'Danh sách slider'])

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <list-slider
        @if ($sliders) 
            :sliders="{{ $sliders }}"
            :total="{{ $total }}"
            :last-page="{{ $lastPage }}"
        @endif    
    ></list-slider>
@endsection
