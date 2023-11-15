<?php

namespace App\Http\Controllers;

use App\Models\Content\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DashboardController extends Controller
{

    /**
     * Display the dashboard
     */
    public function index(Request $request): View
    {
        $completion = auth()->user()->getResponseCompletionSummary();
        return view('dashboard', [
            'completion' => $completion
        ]);
    }
}
