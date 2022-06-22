@extends('layouts.admin', ['titlePage' => 'Danh sách nhân viên'])

@php
    $employees = collect([]);
    
    foreach ($listEmployees as $employee) {
        $employees->push($employee);
    }
@endphp

@section('content')
    <list-employee
        @if ($employees) 
            :employees="{{ $employees }}"
            :total="{{ $total }}"
            :last-page="{{ $lastPage }}"
        @endif    
    ></list-employee>
@endsection

