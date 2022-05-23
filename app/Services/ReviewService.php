<?php

namespace App\Services;

use App\Models\Review;

class ReviewService implements ReviewServiceInterface
{
    public function getPendingReviews()
    {
        $reviews = Review::with(['user', 'product'])
					->where('status', 0)
                    ->orderBy('created_at', 'desc')
                    ->paginate(Review::PER_PAGE);

        return $reviews;
    }

    public function getPushlishReviews()
    {
        $reviews = Review::with(['user', 'product'])
					->where('status', 1)
                    ->orderBy('created_at', 'desc')
                    ->paginate(Review::PER_PAGE);

        return $reviews;
    }

    public function approveReview($reviewId)
    {
        $review = Review::findOrFail($reviewId)->update([
            'status' => 1
        ]);

        return $review;
    }

    public function deleteReview($reviewId)
    {
        Review::findOrFail($reviewId)->delete();
    }
}