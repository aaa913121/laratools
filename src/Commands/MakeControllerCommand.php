<?php

namespace nolin\laratools\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeControllerCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'laratools:make:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller class with laratools package';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return file_get_contents(__DIR__ . '/stubs/controller.stub');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Controllers';
    }

    public function handle()
    {
        $name = $this->argument('name');
        $template = str_replace(
            [
                '{{name}}',
                '{{namePluralLowerCase}}',
                '{{nameLowerCase}}',
            ],
            [
                $name,
                strtolower(Str::plural($name)),
                strtolower($name),
            ],
            $this->getStub()
        );

        file_put_contents(app_path("Http/Controllers/{$name}Controller.php"), $template);
    }
}
