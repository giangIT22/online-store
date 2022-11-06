<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Slider;
use App\Traits\StoreImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    use StoreImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = (int) $request->page ?? 1;
        $data = Banner::all();
        $sliders = $data->forPage($page, 10);
        $lastPage = ceil(count($data) / Banner::PER_PAGE);

        return view('admin.slider.index', [
            'sliders' => $sliders,
            'lastPage' => $lastPage,
            'total' => count($data)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $sliderImage = $this->uploadImage($request, 'image', 'slider');
        $data['image'] = $sliderImage['file_path'];
        $data['admin_id'] = Auth::user()->id;
        Banner::create($data);

        $notification = [
            'message' => 'Thêm banner thành công',
            'alert-type' => 'success'
        ];
        
        return redirect()->route('all.sliders')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slider_id)
    {
        $slider = Banner::findOrFail($slider_id);

        return view('admin.slider.update', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sliderId)
    {
        $data = $request->all();
        $slider = Banner::findOrFail($sliderId);

        if ($request->slider_image) {
            $sliderImage = $this->uploadImage($request, 'image', 'slider');
            $data['image'] = $sliderImage['file_path'];
        } else {
            $data['image'] = $slider->image;
        }
        
        $slider->update($data);

        $notification = [
            'message' => 'Cập nhật slider thành công',
            'alert-type' => 'success'
        ];
        
        return redirect()->route('all.sliders')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($slider_id)
    {
        try {
            Banner::findOrFail($slider_id)->delete();
            return response()->json([
                'code' => 200,
                'status' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 200,
                'status' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
