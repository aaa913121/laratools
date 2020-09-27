<?php

namespace Nolin\Laratools\Providers;

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
        \Nolin\Laratools\Commands\MakeControllerCommand::class,
        \Nolin\Laratools\Commands\MakeServiceCommand::class,
        \Nolin\Laratools\Commands\MakeRepoCommand::class,
        \Nolin\Laratools\Commands\MakeFullProcessCommand::class,
        \Nolin\Laratools\Commands\MakeRuleCommand::class,
        \Nolin\Laratools\Commands\MakeModelCommand::class,
    ];
}
