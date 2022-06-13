@extends('layouts.admin', ['titlePage' => 'Danh sách người dùng'])
@php
    $users = collect([]);

    foreach ($listUsers as $user) {
        $users->push($user);
    } 
@endphp
@section('content')
    <list-user
        @if ($users) 
            :users="{{ $users }}"
            :total="{{ $total }}"
            :last-page="{{ $lastPage }}"
        @endif    
    ></list-user>
@endsection
