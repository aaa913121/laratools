<?php

namespace Nolin\Laratools\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeRuleCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'laratools:make:rule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new rule class with laratools package';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Rules';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return file_get_contents(__DIR__ . '/stubs/rule.stub');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Validations';
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

        if (!file_exists(app_path('Validations'))) {
            mkdir(app_path('Validations'));
        }

        file_put_contents(app_path("Validations/{$name}.php"), $template);
    }
}
