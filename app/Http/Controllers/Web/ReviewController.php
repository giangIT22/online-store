<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\ReviewServiceInterface;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewServiceInterface $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function viewPending()
    {
        $data = $this->reviewService->getPendingReviews();

        return view('admin.review.review_pending', [
            'listReviews' => $data->items(),
            'total' => $data->total(),
            'lastPage' => $data->lastPage()
        ]);
    }

    public function view()
    {
        $data = $this->reviewService->getPushlishReviews();

        return view('admin.review.view', [
            'listReviews' => $data->items(),
            'total' => $data->total(),
            'lastPage' => $data->lastPage()
        ]);
    }

    /**
     * update status review to publis review
     * 
     * @return response
     */
    public function update()
    {
        $this->reviewService->approveReview(request('review_id'));

        $notification = [
            'message' => 'Đánh giá đã được công khai',
            'alert-type' => 'success'
        ];
        
        return redirect()->route('review.pending')->with($notification);
    }

    public function delete()
    {
        $this->reviewService->deleteReview(request('review_id'));

        $notification = [
            'message' => 'Đánh giá đã xóa thành công',
            'alert-type' => 'success'
        ];
        
        return redirect()->route('all.reviews')->with($notification);
    }
}
