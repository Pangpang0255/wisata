<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ServeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'serve {--host=127.0.0.1} {--port=8000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Serve the application using PHP built-in server (simple replacement for artisan serve)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $host = $this->option('host') ?: '127.0.0.1';
        $port = $this->option('port') ?: '8000';

        $docRoot = base_path('public');

        $this->info("Starting PHP built-in server on http://{$host}:{$port} (document root: {$docRoot})");

        // Build the PHP -S command
        $cmd = PHP_BINARY . " -S {$host}:{$port} -t " . escapeshellarg($docRoot);

        // Inform user how to stop
        $this->line('Press Ctrl+C to stop the server.');

        // Use passthru so output is streamed
        passthru($cmd);

        return 0;
    }
}
