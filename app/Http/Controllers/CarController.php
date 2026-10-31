<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarController extends Controller
{
    public function index(Request $request): View
    {
        $query = Car::where('is_available', true);

        if ($request->filled('brand')) {
            $query->where('brand', $request->input('brand'));
        }

        if ($request->filled('year')) {
            $query->where('year', $request->input('year'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%");
            });
        }

        $cars = $query->latest('id')->paginate(9)->withQueryString();
        $brands = Car::select('brand')->distinct()->pluck('brand');
        $years = Car::select('year')->distinct()->orderByDesc('year')->pluck('year');

        return view('cars.index', compact('cars', 'brands', 'years'));
    }

    public function show(Car $car, Request $request): View
    {
        $recentlyViewed = session()->get('recently_viewed', []);

        if (!in_array($car->id, $recentlyViewed)) {
            array_unshift($recentlyViewed, $car->id);
            $recentlyViewed = array_slice($recentlyViewed, 0, 5);
            session()->put('recently_viewed', $recentlyViewed);
        }

        $similarCars = Car::where('is_available', true)
            ->where('id', '!=', $car->id)
            ->where('brand', $car->brand)
            ->take(3)
            ->get();

        if ($similarCars->isEmpty()) {
            $similarCars = Car::where('is_available', true)
                ->where('id', '!=', $car->id)
                ->take(3)
                ->get();
        }

        return view('cars.show', compact('car', 'similarCars'));
    }
}
