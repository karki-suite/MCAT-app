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
        return view('dashboard', [
            'completion' => auth()->user()->getResponseCompletionSummary(),
            'scores' => auth()->user()->getResponseScoreSummary()
        ]);
    }

    public function resources(Request $request): View
    {
        return view('resources', [
            'resources' => [
                [
                    'title' => 'MCAT Official Prep Hub',
                    'paid' => false,
                    'link' => 'https://students-residents.aamc.org/prepare-mcat-exam/prepare-mcat-exam'
                ],
                [
                    'title' => 'MilesDown Deck',
                    'paid' => false,
                    'link' => 'https://ankiweb.net/shared/info/178384887'
                ],
                [
                    'title' => 'AnkiWeb Download',
                    'paid' => false,
                    'link' => 'https://apps.ankiweb.net/'
                ],
                [
                    'title' => 'JW Chrome Extension',
                    'paid' => false,
                    'link' => 'https://chrome.google.com/webstore/detail/aamc-mcat-interface-by-ja/jgglfdpjpddcdaeapbcfgckfheabbdpi'
                ],
                [
                    'title' => 'UWorld',
                    'paid' => true,
                    'link' => 'https://gradschool.uworld.com/mcat/'
                ],
                [
                    'title' => 'Altius Full Lengths',
                    'paid' => true,
                    'link' => 'https://altiustestprep.com/practice-exam/'
                ],
                [
                    'title' => 'Physics Formula Sheet',
                    'paid' => false,
                    'link' => 'https://www.reddit.com/r/Mcat/comments/e04vcw/physics_formulas/?utm_source=share&utm_medium=web2'
                ],
                [
                    'title' => 'Free Practice Exams',
                    'paid' => false,
                    'link' => 'https://arvindrajan.notion.site/8fd27060dcda48aebb89a1265568879b?v=3483737a1f0c48f0b4656699fa9acfcc'
                ],
                [
                    'title' => 'MCAT Discord',
                    'paid' => false,
                    'link' => 'https://discord.com/invite/6pYxe59qAH'
                ],
                [
                    'title' => 'MedSchoolCoach Podcast',
                    'paid' => false,
                    'link' => 'https://open.spotify.com/show/6vORAMJLFq62hlsnagSkD7?si=eRj1FgcHRt6QUIt5zJfLhA&dl_branch=1'
                ],
                [
                    'title' => 'r/MCAT',
                    'paid' => false,
                    'link' => 'https://www.reddit.com/r/Mcat/'
                ],
                [
                    'title' => 'Arvind\'s Free Compilation',
                    'paid' => false,
                    'link' => 'https://arvindrajan.notion.site/arvindrajan/The-Ultimate-MCAT-Free-Resource-Compilation-fcff61a7f99a4f13871dde51ca5cf4ab'
                ],
                [
                    'title' => 'Kaplan Quicksheets',
                    'paid' => false,
                    'link' => 'https://www.kaptest.com/static/pdf/ktp-mcat-quicksheets.pdf'
                ]
            ],
            'services' => [
                [
                    'title' => 'Office Hours',
                    'paid' => false,
                    'link' => 'https://calendly.com/keepingupwiththekarkis/office_hours'
                ],
                [
                    'title' => 'Testimonials',
                    'paid' => false,
                    'link' => 'https://docs.google.com/document/d/16BeXZ6IQp8AAQXYqwE__OafojjeEFDFXnBbPcBShfRU/edit?usp=sharing'
                ],
                [
                    'title' => 'Feedback Form',
                    'paid' => false,
                    'link' => 'https://docs.google.com/forms/d/e/1FAIpQLSfbQA8k-_rREKZJqYEchW4jugGm16askPHgInThd5QN_OgNYg/viewform?usp=sf_link'
                ]
            ]
        ]);
    }
}
