<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $filePath = app_path("Services/{$name}.php");

        if (file_exists($filePath)) {
            $this->error('Service already exists!');
            return 1;
        }

        $template = "<?php\n\nnamespace App\Services;\n\nclass {$name}\n{\n    // Your service methods here\n}\n";

        if (!file_exists(app_path('Services'))) {
            mkdir(app_path('Services'));
        }

        file_put_contents($filePath, $template);

        $this->info("Service created successfully: {$filePath}");
        return 0;
    }
}
