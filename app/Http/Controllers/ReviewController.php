<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $review = Review::create([
            'author_name'  => $validated['author_name'],
            'comment'      => $validated['comment'],
            'rating'       => (int) $validated['rating'],
            'is_published' => true,
        ]);

        session()->flash('review_success', "Благодарим вас за отзыв, {$review->author_name}! Он опубликован на сайте.");
        session()->put('has_reviewed', true);

        return redirect()->to(url()->previous() . '#reviews');
    }
}
