<?php

namespace App\Http\Controllers;

use App\Models\CmsContent;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{

    /**
     * Display the dashboard
     */
    public function index(Request $request): View
    {
        return view('dashboard', [
            'completion' => auth()->user()->getResponseCompletionSummary(),
            'scores' => auth()->user()->getResponseScoreSummary(),
            'content' => [
                'welcome' => CmsContent::where('key', 'dashboard-welcome')->first()['content'],
                'welcome-videoid' => CmsContent::where('key', 'dashboard-welcome-videoid')->first()['content'],
            ]
        ]);
    }

    public function resources(Request $request): View
    {
        $resources = Resource::where('section', 'RESOURCES')->get()->toArray();
        $services = Resource::where('section', 'SERVICES')->get()->toArray();
        return view('resources', [
            'resources' => $resources,
            'services' => $services
        ]);
    }
}
