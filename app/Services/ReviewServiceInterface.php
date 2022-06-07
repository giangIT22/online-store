<?php

namespace App\Services;

interface ReviewServiceInterface
{
    public function getPendingReviews();
    public function getPushlishReviews();
    public function approveReview($reviewId);
    public function deleteReview($reviewId);
}
