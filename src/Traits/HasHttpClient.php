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
     */
    public function http()
    {
        if (method_exists($this, 'app')) {
            $app = $this->app();
            if (!empty($app) && $app instanceof ServiceContainer && $app->has(HttpClient::class)) {
                return $app->get(HttpClient::class);
            }
        }

        return new HttpClient();
    }
}
