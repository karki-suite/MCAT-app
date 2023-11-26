<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SampleTestsController extends Controller
{
    /** @var array<string,string> */
    protected array $tests = [
        'US' => 'Unscored Sample',
        'FL1' => 'FL1',
        'FL2' => 'FL2',
        'FL3' => 'FL3',
        'FL4' => 'FL4',
        'FL5' => 'FL5'
    ];

    /**
     * Display list of sample tests
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {

        return view('sampletests.list', [
            'tests' => $this->tests
        ]);
    }

    /**
     * Show a sample test
     *
     * @param Request $request
     * @param string $id
     * @return View
     */
    public function show(Request $request, string $id): View
    {
        $sampleTests = json_decode(auth()->user()->sample_tests, true);
        $testResponse = [];
        if(isset($sampleTests[$id])) {
            $testResponse = $sampleTests[$id];
        }

        return view('sampletests.show', [
            'testName' => $this->tests[$id],
            'testId' => $id,
            'testResponse' => json_encode($testResponse)
        ]);
    }

    /**
     * Save a sample test
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function save(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $testId = $request->input('test_id');
        $sampleTestInput = $request->input('sample_test');
        $sampleTests = json_decode($user->sample_tests, true);
        $sampleTests[$testId] = $sampleTestInput;
        $user->sample_tests = $sampleTests;
        $user->save();
        return response()->redirectToRoute('cars');
    }
}
