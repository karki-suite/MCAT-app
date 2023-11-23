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
        $jackWestin = Cars::all()->toArray();
        $jackWestinSplit = [];
        $jackWestinSplit[0] = array_slice($jackWestin, 0, count($jackWestin) / 2);
        $jackWestinSplit[1] = array_slice($jackWestin, count($jackWestin) / 2);

        return view('content.cars', [
            'jackWestin' => $jackWestinSplit,
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
