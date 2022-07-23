@extends('layouts.admin', ['titlePage' => 'Trang chủ'])

@php
$route = Route::current()->getName();
@endphp

@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content mt-30">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item tab-item-invoice">
                    <a class="nav-link {{ $route == 'invoice.monthy' ? 'active' : '' }}"
                        href="{{ route('invoice.monthy') }}"><span class="hidden-sm-up"><i class="ion-home"></i></span>
                        <span class="hidden-xs-down">Tháng</span></a>
                </li>
                <li class="nav-item tab-item-invoice">
                    <a class="nav-link {{ $route == 'invoice.yearly' ? 'active' : '' }}"
                        href="{{ route('invoice.yearly') }}"><span class="hidden-sm-up"><i class="ion-person"></i></span>
                        <span class="hidden-xs-down">Năm</span></a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content tabcontent-border">
                <div class="tab-pane active" id="home" role="tabpanel">
                    <div class="p-15">
                        <canvas id="myChart" width="400" height="150"></canvas>
                        <div class="d-flex justify-content-between mt-10">
                            <div>
                                <a href="?maximum_date={{ \Carbon\Carbon::create($maximum_date - 1, 12, 31)->toDateString() }}"
                                    class="btn btn-info mb-5"
                                    @if ($maximum_date <= $min_year && $route == 'invoice.monthy') style="pointer-events:none;background:rgb(221, 220, 220);color:rgb(71, 71, 71);border:none" 
                                    @elseif($invoices->count() == 0 && $route == 'invoice.yearly')
                                    style="pointer-events:none;background:rgb(221, 220, 220);color:rgb(71, 71, 71);border:none" 
                                    @endif><i
                                        class="fa fa-angle-left" aria-hidden="true"></i>
                                </a>
                                @if ($route == 'invoice.monthy' && $invoices->count() != 0)
                                    <strong style="color: #bdc3c7;" class="ml-20">Năm: {{ $maximum_date }}</strong>
                                @endif
                            </div>
                            <a href="?maximum_date={{ \Carbon\Carbon::create($maximum_date + 1, 12, 31)->toDateString() }}"
                                class="btn btn-info mb-5"
                                @if ($maximum_date >= $max_year) style="pointer-events:none;background:rgb(221, 220, 220);color:rgb(71, 71, 71);border:none" @endif><i
                                    class="fa fa-angle-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

<script>
    window.invoices = {!! json_encode($invoices) !!}
    window.min_year = "{!! $min_year ?? 0 !!}"
    window.max_year = "{!! $max_year ?? 0 !!}"
    window.maximum_date = "{!! $maximum_date ?? 0 !!}"
</script>
