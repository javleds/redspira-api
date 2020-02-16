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
