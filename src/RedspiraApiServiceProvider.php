<?php

namespace Javleds\RedspiraApi;

use Illuminate\Support\ServiceProvider;

class RedspiraApiServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes(
            [
                $this->getBaseDir('config/redspira.php') => config_path('redspira.php'),
            ],
            'redspira-api-config'
        );
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            $this->getBaseDir('config/redspira.php'),
            'redspira'
        );

        $this->app->singleton('redspira-api', static function () {
            $baseClient = new \Javleds\RedspiraApi\HttpClient(config('redspira.base_url'));
            $apiClient = new \Javleds\RedspiraApi\HttpClient(config('redspira.api_base_url'));
            return new \Javleds\RedspiraApi\Redspira($baseClient, $apiClient);
        });

        $this->app->singleton('area-registry-repository', static function () {
            return new \Javleds\RedspiraApi\Repository\AreaRegistryRepository();
        });

        $this->app->singleton('device-repository', static function () {
            return new \Javleds\RedspiraApi\Repository\DeviceRepository();
        });

        $this->app->singleton('device-registry-repository', static function () {
            return new \Javleds\RedspiraApi\Repository\DeviceRegistryRepository();
        });

        $this->app->singleton('area-repository', static function () {
            return new \Javleds\RedspiraApi\Repository\AreaRepository();
        });
    }

    private function getBaseDir(string $path): string
    {
        return sprintf(
            '%s/../%s',
            __DIR__,
            $path
        );
    }
}
