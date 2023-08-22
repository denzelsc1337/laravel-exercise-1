<?php

namespace Byancode\LaravelExercise1;

use Illuminate\Console\Command;

class ExerciseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exercise:ci';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run octane server in background for CI';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->loadEnv();
        $this->setEnv('DB_DATABASE', ':memory:');
        $this->setEnv('DB_CONNECTION', 'sqlite');
        $this->setEnv('REDIS_HOST', '127.0.0.1');
        $this->setEnv('MAIL_HOST', '127.0.0.1');
        $this->setEnv('MAIL_MAILER', 'smtp');
        $this->setEnv('MAIL_PORT', '1025');
        $this->saveEnv();
    }

    public $content;

    private function loadEnv(): void {
        $this->content =  file_get_contents(base_path('.env'));
    }

    private function saveEnv(): void {
        file_put_contents($this->content, $this->content);
    }

    private function setEnv(string $key, string $value): void
    {
        $this->content = preg_replace("/{$key}=.*/", "{$key}={$value}", $this->content);
    }
}
