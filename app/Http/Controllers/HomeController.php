<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $cars = Car::where('is_available', true)
            ->latest('id')
            ->take(8)
            ->get();

        $reviews = Review::published()
            ->latest('id')
            ->take(6)
            ->get();

        $avgRating = round(Review::published()->avg('rating') ?: 4.9, 1);
        $reviewsCount = Review::published()->count();

        $viewedIds = session()->get('recently_viewed', []);
        $recentlyViewedCars = !empty($viewedIds)
            ? Car::whereIn('id', $viewedIds)->get()
            : collect();

        session()->increment('visits_count');

        return view('home', compact(
            'cars',
            'reviews',
            'avgRating',
            'reviewsCount',
            'recentlyViewedCars'
        ));
    }
}
