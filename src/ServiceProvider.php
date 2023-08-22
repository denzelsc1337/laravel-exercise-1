<?php

namespace Byancode\LaravelExercise1;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Byancode\LaravelExercise1\ExerciseCommand;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../stubs/testing.stub' => base_path('tests/Feature/Exercise1Test.php'),
            __DIR__.'/../stubs/workflow.stub' => base_path('.github/workflows/ci.yml'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                ExerciseCommand::class,
            ]);
        }
    }
}
