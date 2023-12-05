<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApplicationScheduleController extends Controller
{
    /** @var array<string,string> */
    protected array $sections = [
        'US' => 'Unscored Sample',
        'FL1' => 'FL1',
        'FL2' => 'FL2',
        'FL3' => 'FL3',
        'FL4' => 'FL4',
        'FL5' => 'FL5'
    ];

    /**
     * Display the application schedule
     */
    public function index(Request $request): View
    {
        $sampleTests = json_decode(auth()->user()->sample_tests, true);
        $content = [];
        foreach($this->sections as $sectionKey => $section) {
            if(isset($sampleTests[$sectionKey])) {
                $test = $sampleTests[$sectionKey];

                $categoryCounts = array_count_values(array_filter(array_column($test, 'content-category')));
                arsort($categoryCounts);
                $weakestCategories = array_keys($categoryCounts);
                $weakestCategories = array_column(Category::findMany($weakestCategories)->toArray(), 'title');

                $errorCounts = array_count_values(array_filter(array_column($test, 'error-type')));
                arsort($errorCounts);
                $commonErrorTypes = array_keys($errorCounts);

                $content[$sectionKey] = [
                    'title' => $section,
                    'weakestCategories' => $weakestCategories,
                    'commonErrorTypes' => $commonErrorTypes,
                ];
            }
        }
        return View('content.application-schedule.index', [
            'content' => $content,
        ]);
    }
}
