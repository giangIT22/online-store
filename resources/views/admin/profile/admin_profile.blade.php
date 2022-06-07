 @extends('layouts.admin')

 @section('content')
     <div class="container-full">
         <!-- Content Header (Page header) -->
         <!-- Main content -->
         <section class="content">

             <!-- Basic Forms -->
             <div class="box">
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
