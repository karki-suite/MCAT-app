<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    /**
     * Display the content schedule
     */
    public function index(Request $request): View
    {

        return view('content.schedule', [
            'groups' => Group::all(),
            'contentResponses' => auth()->user()->content_responses,
        ]);
    }

    public function save(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $user->content_responses = $request->input('responses');
        $user->save();
        return response()->redirectToRoute('schedule');
    }
}
