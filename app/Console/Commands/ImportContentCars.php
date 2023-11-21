<?php

namespace App\Console\Commands;

use App\Console\Library\Csv;
use App\Models\Content\Cars;
use App\Models\Content\Category;
use App\Models\Content\Content;
use App\Models\Content\Group;
use Illuminate\Console\Command;

class ImportContentCars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-content-cars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Content CARS';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $importData = Csv::readCsvToAssoc(storage_path('import/jackwestin.csv'));
        foreach($importData as $importRow) {
            Cars::create([
                'label' => $importRow['label'],
                'link' => $importRow['link'],
            ]);
        }
    }
}
