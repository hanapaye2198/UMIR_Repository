<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Paper;

class FixPdfFilePaths extends Command
{
    protected $signature = 'fix:pdf-file-paths';
    protected $description = 'Fix PDF filenames in DB to match actual files (case sensitive fix)';

    public function handle()
    {
        $papers = Paper::all();
        $path = storage_path('app/public/uploads');

        foreach ($papers as $paper) {
            if (!$paper->file_path) continue;

            $filename = basename($paper->file_path);
            $expectedPath = $path . '/' . $filename;

            if (!file_exists($expectedPath)) {
                // Try lowercase fallback
                $lower = strtolower($filename);
                $lowerPath = $path . '/' . $lower;

                if (file_exists($lowerPath)) {
                    $paper->file_path = 'uploads/' . $lower;
                    $paper->save();
                    $this->info("✔ Fixed: {$filename} → {$lower}");
                } else {
                    $this->warn("✖ Missing: $filename");
                }
            }
        }

        $this->info('✅ Done fixing file paths.');
    }
}
