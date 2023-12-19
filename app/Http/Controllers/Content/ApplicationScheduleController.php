<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\Yaml\Yaml;

class ApplicationScheduleController extends Controller
{
    protected array $contentMapping;

    public function __construct()
    {
        $this->contentMapping = Yaml::parseFile(config_path() . '/application_schedule.yaml');
    }

    /**
     * Display the application schedule
     */
    public function index(Request $request): View
    {
        $sampleTests = json_decode(auth()->user()->sample_tests, true);

        $content = [];
        foreach ($this->contentMapping as $contentGroupKey => $contentGroup) {
            $content[$contentGroupKey] = [
                'ready' => $this->checkReady($contentGroup, $sampleTests),
            ];
            foreach ($contentGroup as $contentSection) {
                $newSection = [
                    'title' => $contentSection['title'],
                    'cards' => [],
                ];
                if(isset($contentSection['sections'])) {
                    foreach ($contentSection['sections'] as $subSection) {
                        $newSection['cards'][] = $this->processContentSection($subSection, $sampleTests, $contentGroupKey);
                    }
                }
                $content[$contentGroupKey]['sections'][] = $newSection;
            }
        }



        return View('content.application-schedule.index', [
            'content' => $this->renderContentItems($content, $sampleTests),
            'responses' => auth()->user()->application_responses,
        ]);
    }

    protected function renderContentItems(array $content, array $sampleTests): array {
        foreach ($content as &$contentGroup) {
            foreach ($contentGroup['sections'] as &$section) {
                $cardIndex = 0;
                foreach ($section['cards'] as &$card) {
                    $cardIndex++;
                    $contentIndex = 0;
                    foreach ($card['content'] as &$contentItem) {
                        $contentIndex++;
                        $sectionTitleKey = preg_replace("/[^A-Za-z0-9]+/", "", $section['title']);
                        $cardTitleKey = preg_replace("/[^A-Za-z0-9]+/", "", $card['title']);
                        if (isset($contentItem['text']) && str_starts_with($contentItem['text'], 'WEAKEST_CATEGORIES')) {
                            [$command, $commandSection, $commandIndex, $commandTargetField] = explode(':', $contentItem['text'], 4);
                            $targetCategory = $this->getWeakestCategoryAtIndex($sampleTests, $commandSection, $commandIndex);
                            if (isset($targetCategory['id'])) {
                                $contentItem['key'] = $sectionTitleKey . '-' . $cardTitleKey . '-CAT-' . $targetCategory['id'] . '-' . $cardIndex . '-' . $contentIndex;
                            } else {
                                $contentItem['type'] = 'text';
                            }
                            if(isset($targetCategory['uworld_reference'])) {
                                $contentItem['text'] = $targetCategory['uworld_reference'];
                            } else {
                                $contentItem['text'] = '-';
                            }
                        } else {
                            if (isset($contentItem['text'])) {
                                $contentTitleKey = preg_replace("/[^A-Za-z0-9]+/", "", $contentItem['text']);
                                $contentItem['key'] = $sectionTitleKey . '-' . $cardTitleKey . '-' . $contentTitleKey . '-' . $cardIndex . '-' . $contentIndex;
                            }
                        }
                        $contentItem['renderer'] = match ($contentItem['type']) {
                            'score_summary' => 'score_summary',
                            'score' => 'score',
                            'subtitle' => 'subtitle',
                            'text' => 'text',
                            'percentage' => 'percentage',
                            'checkbox' => 'checkbox',
                        };
                    }
                }
            }
        }
        return $content;
    }

    protected function processContentSection(string|array $sectionConfig, array $sampleTests, string $sectionKey): array
    {
        return match ($sectionConfig) {
            'WEAKEST_CATEGORIES' => [
                'title' => 'Test Review',
                'content' => array_merge(
                    [
                        [
                            'type' => 'subtitle',
                            'text' => 'Weakest Content Categories In Order'
                        ],
                    ],
                    $this->getWeakestCategories($sampleTests, $sectionKey)
                ),
            ],
            'COMMON_ERROR_TYPES' => [
                'title' => 'Exam',
                'content' => array_merge(
                    [
                        [
                            'type' => 'score_summary'
                        ],
                        [
                            'type' => 'subtitle',
                            'text' => 'Breakdown'
                        ],
                        [
                            'type' => 'score',
                            'text' => 'CP Score'
                        ],
                        [
                            'type' => 'score',
                            'text' => 'CARs Score'
                        ],
                        [
                            'type' => 'score',
                            'text' => 'BB Score'
                        ],
                        [
                            'type' => 'score',
                            'text' => 'PS Score'
                        ],
                        [
                            'type' => 'subtitle',
                            'text' => 'Most Common Errors (Organized by Missed)'
                        ],
                    ],
                    $this->getCommonErrorTypes($sampleTests, $sectionKey)
                )
            ],
            'PREDICTIONS' => [
                'title' => 'Predictions',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Predictions'
                    ],
                ],
            ],
            default => $sectionConfig,
        };
    }

    protected function checkReady(array $contentGroup, array $sampleTests): bool
    {
        foreach ($contentGroup as $contentSection) {
            if(isset($contentSection['sections'])) {
                foreach ($contentSection['sections'] as $card) {
                    if (isset($card['content'])) {
                        foreach ($card['content'] as $contentItem) {
                            if (isset($contentItem['text']) && str_starts_with($contentItem['text'], 'WEAKEST_CATEGORIES')) {
                                [$command, $commandSection, $commandIndex, $commandTargetField] = explode(':', $contentItem['text'], 4);
                                return isset($sampleTests[$commandSection]);
                            }
                        }
                    }
                }
            }
        }
        return false;
    }

    protected function getWeakestCategories(array $sampleTests, string $sectionKey): array
    {
        if (!isset($sampleTests[$sectionKey])) {
            return [];
        }
        $test = $sampleTests[$sectionKey];
        $categoryCounts = array_count_values(array_filter(array_column($test, 'content-category')));
        arsort($categoryCounts);
        $weakestCategories = Category::findMany(array_keys($categoryCounts))->toArray();
        return array_map(
            fn($category) => [
                'type' => 'text',
                'text' => $category['title']
            ],
            $weakestCategories
        );
    }

    public function getWeakestCategoryAtIndex(array $sampleTests, string $sectionKey, int $index): array
    {
        if (!isset($sampleTests[$sectionKey])) {
            return [];
        }
        $test = $sampleTests[$sectionKey];
        $categoryCounts = array_count_values(array_filter(array_column($test, 'content-category')));
        arsort($categoryCounts);

        $totalResults = sizeof($categoryCounts);
        if ($totalResults == 0) {
            return [];
        }
        $loopedIndex = (($index-1) % $totalResults);
        try {
            $categoryAtIndex = array_keys($categoryCounts)[$loopedIndex];
            return Category::find($categoryAtIndex)->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    protected function getCommonErrorTypes(array $sampleTests, string $sectionKey): array
    {
        if (!isset($sampleTests[$sectionKey])) {
            return [];
        }
        $test = $sampleTests[$sectionKey];
        $errorCounts = array_count_values(array_filter(array_column($test, 'error-type')));
        arsort($errorCounts);
        return array_map(
            fn($error) => [
                'type' => 'text',
                'text' => $error
            ],
            array_keys($errorCounts)
        );
    }

    public function save(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $user->application_responses = json_encode($request->input('responses'));
        $user->save();
        return response()->redirectToRoute('schedule.application');
    }
}
