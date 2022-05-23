@extends('layouts.guest')
@section('content')
    <div class="body-content" style="margin: 50px 0 100px;">
        <div class="container">
            <div class="row">

                @include('web.user.sidebar')

                <div class="col-md-2">

                </div> <!-- // end col md 2 -->


                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span
                                class="text-danger">Xin chào, </span><strong>{{ Auth::user()->name }}</strong> </h3>
                    </div>

                </div> <!-- // end col md 6 -->

            </div> <!-- // end row -->

        </div>

    </div>
@endsection
