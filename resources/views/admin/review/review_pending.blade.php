@extends('layouts.admin', ['titlePage' => 'Danh sách đánh giá chưa công khai'])
@php
    $reviews = collect([]);

    foreach ($listReviews as $review) {
        $reviews->push($review);
    }
@endphp
@section('content')
    <pending-review
        @if ($reviews) 
            :reviews="{{ $reviews }}"
            :total="{{ $total }}"
            :last-page="{{ $lastPage }}"
        @endif    
    ></pending-review>
@endsection
