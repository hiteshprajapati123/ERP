<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AddLogsActivityTrait extends Command
{
    protected $signature = 'activity:add-trait';
    protected $description = 'Add LogsActivity trait to all models';

    public function handle()
    {
        $modelsPath = app_path('Models');
        $files = File::allFiles($modelsPath);
        
        $traitUse = "    use \\App\\Traits\\LogsActivity;\n";
        $traitImport = "use App\\Traits\\LogsActivity;\n";
        
        foreach ($files as $file) {
            $modelName = $file->getBasename('.php');
            if ($modelName === 'UserActivity') {
                continue; // Skip UserActivity model
            }
            
            $content = file_get_contents($file->getPathname());
            
            // Skip if already has the trait
            if (str_contains($content, 'use LogsActivity;') || 
                str_contains($content, 'use \\App\\Traits\\LogsActivity;')) {
                $this->info("Skipped: {$modelName} - Already has LogsActivity trait");
                continue;
            }
            
            // Add use statement if not exists
            if (!str_contains($content, 'use App\\Traits\\LogsActivity;')) {
                $content = str_replace(
                    '<?php\n\nnamespace',
                    '<?php\n\nnamespace',
                    $content
                );
                $content = preg_replace(
                    '/namespace ([^;]+);/i',
                    "namespace $1;\n\n" . 'use App\\Traits\\LogsActivity;',
                    $content,
                    1
                );
            }
            
            // Add trait to class
            $content = preg_replace(
                '/(class ' . $modelName . '.*?\{.*?)(\n\s*use)/s',
                "$1\n    use LogsActivity;\n\n$2",
                $content,
                1
            );
            
            file_put_contents($file->getPathname(), $content);
            $this->info("Updated: {$modelName} - Added LogsActivity trait");
        }
        
        $this->info('All models have been processed!');
    }
}
