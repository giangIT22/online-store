@extends('layouts.guest')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>/
                    <li class='active'>Tin tức</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="blog-page">
                    <div class="col-md-9">
                        @foreach ($data['listBlogs'] as $blog)
                            <div class="blog-post  wow fadeInUp">
                                <a href="blog-details.html"><img class="img-responsive"
                                        src="{{ asset($blog->post_image) }}" alt=""></a>
                                <h1><a href="blog-details.html">{{ $blog->title }}</a>
                                </h1>
                                {{-- <span class="review">6 Comments</span> --}}
                                <span class="date-time">{{ $blog->created_at->toDateTimeString() }}</span>
                                <p class="blog-content">{{ $blog->content }}</p>
                                <a href="{{ route('blog.detail', ['blog_id' => $blog->id])}}" class="btn btn-upper btn-primary read-more">read more</a>
                            </div>
                        @endforeach

                        <div class="clearfix blog-pagination filters-container  wow fadeInUp"
                            style="padding:0px; background:none; box-shadow:none; margin-top:15px; border:none">

                            <div class="text-right">
                                <div class="pagination-container">
                                    <ul class="list-inline list-unstyled">
                                        <li class="prev"><a
                                                href="{{ route('blog.view', ['page' => $data['currentPage'] == 1 ? $data['currentPage'] : $data['currentPage'] - 1]) }}"><i
                                                    class="fa fa-angle-left"></i></a></li>
                                        @for ($i = 1; $i <= $data['lastPage']; $i++)
                                            <li class="{{ $data['currentPage'] == $i ? 'active' : '' }}"><a
                                                    href="{{ route('blog.view', ['page' => $i]) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <li class="next"><a
                                                href="{{ route('blog.view', ['page' => $data['currentPage'] == $data['lastPage'] ? $data['lastPage'] : $data['currentPage'] + 1]) }}"><i
                                                    class="fa fa-angle-right"></i></a></li>
                                    </ul><!-- /.list-inline -->
                                </div><!-- /.pagination-container -->
                            </div><!-- /.text-right -->

                        </div><!-- /.filters-container -->
                    </div>
                    <div class="col-md-3 sidebar">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
