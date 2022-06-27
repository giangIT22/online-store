@php
$reviews = DB::table('reviews')
    ->where('product_id', $productId)
    ->where('status', 1)
    ->orderBy('created_at', 'desc')
    ->get();
$averageRating = $reviews->avg('rating');
@endphp
<div>
    @if (empty($averageRating))
        <span class="fa fa-star star-unchecked"></span>
        <span class="fa fa-star star-unchecked"></span>
        <span class="fa fa-star star-unchecked"></span>
        <span class="fa fa-star star-unchecked"></span>
        <span class="fa fa-star star-unchecked"></span>
    @elseif($averageRating == 1 || $averageRating < 2)
        <span class="fa fa-star star-checked"></span>
        <span class="fa fa-star star-unchecked"></span>
        <span class="fa fa-star star-unchecked"></span>
        <span class="fa fa-star star-unchecked"></span>
        <span class="fa fa-star star-unchecked"></span>
    @elseif($averageRating == 2 || $averageRating < 3)
        <span class="fa fa-star star-checked"></span>
        <span class="fa fa-star star-checked"></span>
        <span class="fa fa-star star-unchecked"></span>
        <span class="fa fa-star star-unchecked"></span>
        <span class="fa fa-star star-unchecked"></span>
        <span class="fa fa-star star-unchecked"></span>
    @elseif($averageRating == 3 || $averageRating < 4)
        <span class="fa fa-star star-checked"></span>
        <span class="fa fa-star star-checked"></span>
        <span class="fa fa-star star-checked"></span>
        <span class="fa fa-star star-unchecked"></span>
        <span class="fa fa-star star-unchecked"></span>
    @elseif($averageRating == 4 || $averageRating < 5)
        <span class="fa fa-star star-checked"></span>
        <span class="fa fa-star star-checked"></span>
        <span class="fa fa-star star-checked"></span>
        <span class="fa fa-star star-checked"></span>
        <span class="fa fa-star star-unchecked"></span>
    @elseif($averageRating == 5 || $averageRating < 5)
        <span class="fa fa-star star-checked"></span>
        <span class="fa fa-star star-checked"></span>
        <span class="fa fa-star star-checked"></span>
        <span class="fa fa-star star-checked"></span>
        <span class="fa fa-star star-checked"></span>
    @endif
</div>
