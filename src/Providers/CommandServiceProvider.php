<?php

namespace nolin\laratools\Providers;

class CommandServiceProvider extends BaseCommandServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        \nolin\laratools\Commands\MakeControllerCommand::class,
        \nolin\laratools\Commands\MakeServiceCommand::class,
        \nolin\laratools\Commands\MakeRepoCommand::class,
        \nolin\laratools\Commands\MakeFullProcessCommand::class,
        \nolin\laratools\Commands\MakeRuleCommand::class,
        \nolin\laratools\Commands\MakeModelCommand::class,
    ];
}
