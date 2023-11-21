<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Cars;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarsController extends Controller
{
    /**
     * Display CARS
     */
    public function index(Request $request): View
    {

        return view('content.cars', [
            'jackwestin' => Cars::all(),
            'carsResponses' => auth()->user()->content_cars_responses
        ]);
    }

    public function save(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $user->content_cars_responses = $request->input('cars_responses');
        $user->save();
        return response()->redirectToRoute('cars');
    }
}
