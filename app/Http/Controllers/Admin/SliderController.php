<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\StoreImageTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
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
        $data = Slider::all();
        $sliders = $data->forPage($page, 10);
        $lastPage = ceil(count($data) / Slider::PER_PAGE);

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
        $sliderImage = $this->uploadImage($request, 'slider_image', 'slider');
        $data['slider_image'] = $sliderImage['file_path'];

        Slider::create($data);

        $notification = [
            'message' => 'Create slider successfully',
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
        $slider = Slider::findOrFail($slider_id);

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
        $slider = Slider::findOrFail($sliderId);

        if ($request->slider_image) {
            $sliderImage = $this->uploadImage($request, 'slider_image', 'slider');
            $data['slider_image'] = $sliderImage['file_path'];
        }

        $data['slider_image'] = $slider->slider_image;
        $slider->update($data);

        $notification = [
            'message' => 'Update slider successfully',
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
            Slider::findOrFail($slider_id)->delete();
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
