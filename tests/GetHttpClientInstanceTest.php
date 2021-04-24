<?php

namespace Foris\Easy\Sdk\HttpClient\Tests;

use Foris\Easy\HttpClient\HttpClient;
use Foris\Easy\Sdk\HttpClient\ServiceProvider;
use Foris\Easy\Sdk\HttpClient\Tests\Components\NonSdkComponent;
use Foris\Easy\Sdk\HttpClient\Tests\Components\SdkComponent;
use Psr\Log\LoggerInterface;
use Psr\Log\Test\TestLogger;

/**
 * Class TestCase
 */
class GetHttpClientInstanceTest extends \Foris\Easy\Sdk\Develop\TestCase
{
    /**
     * Set up test environment.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->app()->registerProviders([ServiceProvider::class]);
    }

    /**
     * Test get http-client instance.
     */
    public function testGetHttpClientInstance()
    {
        $this->assertInstanceOf(HttpClient::class, $this->app()->get(HttpClient::class));
    }

    /**
     * Test get http-client configuration.
     */
    public function testGetHttpClientConfiguration()
    {
        $config = require __DIR__ . '/../src/config/http-client.php';
        $this->assertEquals($config, $this->app()->get('config')->get('http-client'));
    }

    /**
     * Test get http-client form 'HasHttpClient' trait
     */
    public function testGetHttpClientInstanceFromTrait()
    {
        $component = new NonSdkComponent();
        $this->assertInstanceOf(HttpClient::class, $component->http());

        $this->app()->bind(SdkComponent::name(), function ($app) {
            return new SdkComponent($app);
        });
        $this->assertInstanceOf(HttpClient::class, $this->app()->get(SdkComponent::name())->http());
    }

    /**
     * Test get logger from http-client instance.
     */
    public function testGetLogger()
    {
        $this->app()->singleton(LoggerInterface::class, function () {
            return new TestLogger();
        });

        $this->assertInstanceOf(TestLogger::class, $this->app()->get(HttpClient::class)->getLogger());
    }
}
