<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeServiceCommand extends Command
{
    protected $signature = 'make:service {name}';

    protected $description = 'Create a new service class';

    public function handle()
    {
        $name = $this->argument('name');

        $name = Str::studly($name);

        $directory = app_path('Services');

        $path = $directory . '/Http' . $name . '.php';

        if (File::exists($path)) {
            $this->error("Service {$name} already exists.");

            return Command::FAILURE;
        }

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $content = <<<PHP
<?php

namespace App\Services;

class {$name}
{
    //
}
PHP;

        File::put($path, $content);

        $this->info("Service {$name} created successfully.");

        return Command::SUCCESS;
    }
}