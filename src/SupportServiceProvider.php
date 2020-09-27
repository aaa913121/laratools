<?php

namespace nolin\laratools;

use nolin\laratools\Support\ThrowException;
use Illuminate\Support\ServiceProvider;

class LaratoolsServiceProvider extends ServiceProvider
{
    use ThrowException;

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // 載入config(多筆config須分開寫)
        $this->mergeConfigFrom(__DIR__ . '/../config/Common.php', 'laratools_common');

        // Register the service the package provides.
        $this->app->singleton('laratools', function ($app) {
            return new Laratools;
        });

        // Register router.
        $this->registerRouter(__NAMESPACE__);

        // Register commands.
        $this->registerConsoleServiceProvider(Providers\CommandServiceProvider::class);
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        // 只有本機會每次檢查table是否有建立
        if (env('APP_ENV') == 'local' && isset($this->neededTable)) {
            $this->checkTableExist();
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laratools'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/Common.php' => config_path('LaratoolsCommon.php'),
        ], 'laratools.config');

        // 發佈語系(使用php artisan vendor:publish，選擇support.lang)
        $this->publishes([
            __DIR__.'/resources/lang' => resource_path('lang/'),
        ], 'laratools.lang');
    }

    /**
     * registerRouter
     *
     * @return void
     */
    public function registerRouter($namespace)
    {
        //建立路由
        app('router')->prefix('api')
            ->namespace($namespace . '\Controllers')
            ->group(base_path('vendor/nolin/laratools/src/Routing/route.php'));
    }

    /**
     * checkTableExist
     *
     * 檢查所需的
     *
     * @return void
     */
    public function checkTableExist()
    {
        foreach ($this->neededTable as $table) {
            if (!\Schema::hasTable($table)) {
                throw new \Exception($table . ' table hasn\'t been created', 500);
            };
        }
    }

    /**
     * registerConsoleServiceProvider
     *
     * @param  mixed $provider
     * @param  mixed $options
     * @param  mixed $force
     * @return void
     */
    protected function registerConsoleServiceProvider($provider, array $options = [], $force = false)
    {
        if ($this->app->runningInConsole()) {
            return $this->app->register($provider, $options, $force);
        }

        return null;
    }
}
