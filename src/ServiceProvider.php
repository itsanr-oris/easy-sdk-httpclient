<?php /** @noinspection PhpUndefinedFieldInspection */

namespace Foris\Easy\Sdk\HttpClient;

use Foris\Easy\HttpClient\HttpClient;
use Psr\Log\LoggerInterface;

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

        $this->app()->singleton(HttpClient::class, function ($app) {
            /** @var \Foris\Easy\Sdk\ServiceContainer $app */
            $client = new HttpClient($app->config['http-client']);

            if ($app->has(LoggerInterface::class)) {
                $client->setLogger($app->get(LoggerInterface::class));
            }

            return $client;
        });
    }
}
