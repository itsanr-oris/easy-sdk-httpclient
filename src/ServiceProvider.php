<?php /** @noinspection PhpUndefinedFieldInspection */

namespace Foris\Easy\Sdk\HttpClient;

use Foris\Easy\HttpClient\HttpClient;
use Foris\Easy\HttpClient\Middleware\LogMiddleware;
use Foris\Easy\HttpClient\Middleware\RetryMiddleware;
use Foris\Easy\Sdk\ServiceContainer;

/**
 * Class ServiceProvider
 */
class ServiceProvider extends \Foris\Easy\Sdk\ServiceProvider
{
    /**
     * Register component to application.
     *
     * @throws \ReflectionException
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/http-client.php', 'http-client');

        $this->publishes([
            __DIR__ . '/config/http-client.php' => $this->app()->getConfigPath('http-client.php')
        ]);

        $this->app()->singleton('http_client', function ($app) {
            $client = new HttpClient($app->config['http-client']);

            $this->addLogMiddleware($app, $client);
            $this->addRetryMiddleware($app, $client);

            return $client;
        });
    }

    /**
     * Add log middleware
     *
     * @param ServiceContainer $app
     * @param HttpClient       $client
     */
    protected function addLogMiddleware(ServiceContainer $app, HttpClient $client)
    {
        if (isset($app['logger'])) {
            $config = isset($app->config['http-client']) ? $app->config['http-client'] : [];
            $client->pushMiddleware(new LogMiddleware($app['logger'], $config));
        }
    }

    /**
     * Add retry middleware
     *
     * @param ServiceContainer $app
     * @param HttpClient       $client
     */
    protected function addRetryMiddleware(ServiceContainer $app, HttpClient $client)
    {
        $config = isset($app->config['http-client']) ? $app->config['http-client'] : [];
        $client->pushMiddleware(new RetryMiddleware($config));
    }
}
