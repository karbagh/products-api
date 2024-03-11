<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class BackendAppInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backend-app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process will install all dependencies, database structure and back end app.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            /*
            |--------------------------------------------------------------------------
            | Copy .env.example to .env
            |--------------------------------------------------------------------------
            */
            $this->info('Copy .env.example to .env');
//            shell_exec('cp .env.example .env');
            $this->info('Copied successfully.');
            $this->line("\t\t------- 10 % -------");
            /*
            |--------------------------------------------------------------------------
            | Generating Key for Project
            |--------------------------------------------------------------------------
            */
            $this->info('Generating Key for Project!');
            Artisan::call('key:generate');
            $this->info('Key generated successfully');
            $this->line("\t\t------- 30 % -------");

            /*
            |--------------------------------------------------------------------------
            | Create storage link
            |--------------------------------------------------------------------------
            */
            $this->info('Create storage link');
            Artisan::call('storage:link');
            $this->info('Storage link created successfully.');
            $this->line("\t\t------- 35 % -------");
            /*
            |--------------------------------------------------------------------------
            | Migration Database tables
            |--------------------------------------------------------------------------
            */
            $this->info('Migration Database tables');
            Artisan::call('migrate:fresh');
            $this->info('Migrated successfully.');
            $this->line("\t\t------- 50 % -------");

            /*
            |--------------------------------------------------------------------------
            | Seeding Database default values
            |--------------------------------------------------------------------------
            */
            $this->info('Seeding Database default values.');
            Artisan::call('db:seed');
            $this->info('Seeded successfully.');
            $this->line("\t\t------- 80 % -------");

            /*
            |--------------------------------------------------------------------------
            | Optimizing
            |--------------------------------------------------------------------------
            */
            $this->info('Optimizing.');
            Artisan::call('optimize:clear');
            $this->info('Optimized successfully.');
            $this->line("\t\t------- 85 % -------");

            /*
            |--------------------------------------------------------------------------
            | Generating swagger documentation
            |--------------------------------------------------------------------------
            */
            $this->info('Generating swagger documentation.');
            Artisan::call('l5-swagger:generate');
            $this->info('Generated Successfully.');
            $this->line("\t\t------- 100 % -------");

            /*
            |--------------------------------------------------------------------------
            | Finished successfully
            |--------------------------------------------------------------------------
            */
            $this->alert('Back end app installed successfully');
            return 0;
        } catch (Exception $e) {
            $this->error("Back end app installation failed with code: {$e->getCode()}, message: {$e->getMessage()}");
        }

        return 1;
    }
}

