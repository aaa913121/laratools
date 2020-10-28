<?php

namespace Nolin\Laratools\Commands;

use Artisan;
use Illuminate\Console\Command;

class MakeFullProcessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laratools:make:fp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create full process, including controller、service and repository with support package';

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
     * @return mixed
     */
    public function handle()
    {
        $className = $this->ask('Please type the process name to generate controller、service、model、migration and repository and rule classes');

        if ($className && preg_match('/^[A-Za-z0-9]+$/', $className)) {
            $controllerName = ucfirst($className) . 'Controller';
            $servicesName = ucfirst($className) . 'Service';
            $repositoryName = ucfirst($className) . 'Repository';

            if ($this->confirm('Are you sure to create ' . $controllerName . "、" . $servicesName . "、" . $repositoryName . " and rule file、model、migration " . ucfirst($className))) {
                Artisan::call('laratools:make:controller', ['name' => ucfirst($className)]);
                Artisan::call('laratools:make:service', ['name' => ucfirst($className)]);
                Artisan::call('laratools:make:repository', ['name' => ucfirst($className)]);
                Artisan::call('laratools:make:rule', ['name' => ucfirst($className)]);
                Artisan::call('laratools:make:model', ['name' => ucfirst($className)]);
                Artisan::call('make:migration', ['name' => 'create' . ucfirst($className) . 'Table']);
            } else {
                $this->error('Bye');
            }
        } else {
            $this->error('Process name should be alphabet or numbers.');
        }
    }
}
