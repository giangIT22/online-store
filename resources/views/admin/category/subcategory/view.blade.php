@extends('layouts.admin', ['titlePage' => 'Sub categories'])

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <sub-category
        @if ($subCategories) 
            :sub-category="{{ $subCategories }}"
            :total="{{ $total }}"
            :last-page="{{ $lastPage }}"
        @endif    
    ></sub-category>
@endsection
