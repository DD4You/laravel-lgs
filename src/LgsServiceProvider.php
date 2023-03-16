<?php

namespace DD4You\Lgs;

use DD4You\Lgs\Console\InstallLGS;
use Illuminate\Support\ServiceProvider;

class LgsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallLGS::class,
            ]);

            if (!class_exists('CreateGlobalSettingsTable')) {
                $this->publishes([
                    __DIR__ . '/database/migrations/create_global_settings_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_global_settings_table.php'),
                    __DIR__ . '/database/seeders/SettingsSeeder.php.stub' => database_path('seeders/SettingsSeeder.php'),
                ], 'migrations');
            }
        }
    }
    public function register()
    {
        $this->app->bind('g_settings', function ($app) {
            return new GlobalSetting();
        });
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }
}
