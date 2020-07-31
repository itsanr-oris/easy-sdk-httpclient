<?php

namespace Foris\Easy\Sdk\HttpClient\Traits;

use Foris\Easy\HttpClient\HttpClient;
use Foris\Easy\Sdk\ServiceContainer;

/**
 * Trait HasHttpClient
 */
trait HasHttpClient
{
    /**
     * Get logger instance
     *
     * @return HttpClient
     * @throws \Foris\Easy\Logger\Exception\InvalidConfigException
     */
    public function http()
    {
        if (method_exists($this, 'app')) {
            $app = $this->app();
            if (!empty($app) && $app instanceof ServiceContainer && isset($app['http_client'])) {
                return $app['http_client'];
            }
        }

        return new HttpClient();
    }
}