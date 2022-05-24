@extends('layouts.admin', ['titlePage' => 'Danh sách đánh giá công khai'])
@php
    $reviews = collect([]);

    foreach ($listReviews as $review) {
        $reviews->push($review);
    }
@endphp
@section('content')
    <publish-review
        @if ($reviews) 
            :reviews="{{ $reviews }}"
            :total="{{ $total }}"
            :last-page="{{ $lastPage }}"
        @endif    
    ></publish-review>
@endsection
