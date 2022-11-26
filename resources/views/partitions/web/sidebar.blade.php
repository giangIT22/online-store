<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Danh mục sản phẩm</div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">
            <li class="dropdown menu-item"> <a href="{{ route('category.all.products') }}">Tất cả sản phẩm</a></li>
            @foreach ($categories as $category)
                @if (isset($category->products) && $category->products->sum('amount') > 0)
                    <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle"
                            data-toggle="dropdown">{{ $category->name }}</a>
                        <ul class="dropdown-menu mega-menu">
                            <li class="yamm-content">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <ul class="links list-unstyled">
                                            @foreach ($category->subCategories as $item)
                                                @if (isset($item->products) && $item->products->sum('amount') > 0)
                                                    <li>
                                                        <a
                                                            href="{{ route('sub_category.index', ['sub_category_id' => $item->id]) }}">
                                                            {{ $item->sub_category_name }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- /.yamm-content -->
                        </ul>
                        <!-- /.dropdown-menu -->
                    </li>
                @endif
                <!-- /.menu-item -->
            @endforeach
            <li class="dropdown menu-item"> <a href="{{ route('blog.view') }}">Tin tức</a></li>
        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>
