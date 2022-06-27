 @extends('layouts.admin', ['titlePage' => 'Thông tin tài khoản'])

 @section('content')
     <div class="container-full">
         <!-- Content Header (Page header) -->
         <!-- Main content -->
         <section class="content">

             <!-- Basic Forms -->
             <div class="box">
                <div class="box-header with-border">
                    <div class="d-flex justify-content-between">
                        <h4 class="box-title">Thông tin người dùng</h4>
                        <a href="{{ route('invoice.monthy') }}" type="button" class="btn btn-rounded btn-primary mb-5">Quay lại</a>
                    </div>
                </div>
                 <div class="box box-widget widget-user">
                     <!-- Add the bg color to the header using any of the bg-* classes -->
                     <div class="widget-user-header bg-black"
                         style="background: url('../images/gallery/full/10.jpg') center center;">
                         <h3 class="widget-user-username">{{ $admin->name }}</h3>
                         <h6 class="widget-user-desc">{{ $admin->email }}</h6>
                     </div>
                     <div class="widget-user-image">
                         <img class="rounded-circle"
                             src="{{ $admin->profile_photo_path ? asset($admin->profile_photo_path) : asset('backend/images/no-image.jpg') }}"
                             alt="User Avatar">
                     </div>
                 </div>
             </div>
         </section>
     </div>
 @endsection
