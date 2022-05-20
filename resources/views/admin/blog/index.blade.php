@extends('layouts.admin', ['titlePage' => 'Tin tức'])
@php
    $blogs = collect([]);

    foreach ($listBlogs as $blog) {
        $blogs->push($blog);
    }
@endphp
@section('content')
    <list-blog
        @if ($blogs) 
            :blogs="{{ $blogs }}"
            :total="{{ $total }}"
            :last-page="{{ $lastPage }}"
        @endif    
    ></list-slider>
@endsection
