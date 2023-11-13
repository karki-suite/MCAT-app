<?php

namespace App\Console\Commands;

use App\Models\Content\Category;
use App\Models\Content\Content;
use App\Models\Content\Group;
use Illuminate\Console\Command;

class ImportContentSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-content-schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Content Schedule';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $importData = $this->readCsvToAssoc(storage_path('import/content.csv'));
        foreach($importData as $importRow) {
            print_r($importRow);
            // Get Group...
            $group = Group::where('shortname', $importRow['Group'])->get();
            if (count($group) == 0) {
                $group = Group::create([
                    'shortname' => $importRow['Group'],
                    'title' => $importRow['Group'],
                    'subtitle' => $importRow['Group'],
                ]);
            } else {
                $group = $group[0];
            }

            // Get Category...
            $category = $group->categories()->where('title', $importRow['Category'])->get();
            if (count($category) == 0) {
                $category = Category::create([
                    'title' => $importRow['Category'],
                    'group_id' => $group->id,
                ]);
            } else {
                $category = $category[0];
            }

            // Insert Content
            Content::create([
                'category_id' => $category->id,
                'subcategory' => strtoupper($importRow['Subcategory']),
                'tracking' => strtoupper($importRow['Response']),
                'label' => $importRow['Title'],
                'link_text' => $importRow['Link: Text'],
                'ref_text' => $importRow['Ref: Text'],
                'link_video' => $importRow['Link: Video'],
                'ref_kaplan' => $importRow['Ref: Kaplan'],
                'notes' => $importRow['Notes']
            ]);
        }
    }

    protected function readCsvToAssoc(string $file): array
    {
        $csvHandle = fopen($file, 'r');
        $this->info('Running Import...');
        $csvHeaders = fgetcsv($csvHandle);
        $csvData = [];
        while(!feof($csvHandle))
        {
            $processedRow = [];
            $csvRow = fgetcsv($csvHandle);
            for($i = 0; $i < count($csvRow); $i++) {
                $processedRow[$csvHeaders[$i]] = $csvRow[$i];
            }
            $csvData[] = $processedRow;
        }
        fclose($csvHandle);

        return $csvData;
    }
}
