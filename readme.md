## 简介

Easy sdk HttpClient扩展组件包

[![Latest Stable Version](https://poser.pugx.org/f-oris/easy-sdk-httpclient/v)](//packagist.org/packages/f-oris/easy-sdk-httpclient) [![Total Downloads](https://poser.pugx.org/f-oris/easy-sdk-httpclient/downloads)](//packagist.org/packages/f-oris/easy-sdk-httpclient) [![Latest Unstable Version](https://poser.pugx.org/f-oris/easy-sdk-httpclient/v/unstable)](//packagist.org/packages/f-oris/easy-sdk-httpclient) [![License](https://poser.pugx.org/f-oris/easy-sdk-httpclient/license)](//packagist.org/packages/f-oris/easy-sdk-httpclient)

## 安装

通过composer引入扩展包

```bash
composer require f-oris/easy-sdk-httpclient
```

Publish日志配置信息

```bash
php artisan vendor:publish --provider="Foris\Easy\Sdk\HttpClient\ServiceProvider"
```

## 使用

通过服务容器，获取HttpClient实例，按照[easy-httpclient](https://github.com/itsanr-oris/easy-httpclient)使用说明进行调用即可

```php
<?php

$app = new \Foris\Easy\Sdk\Application();
$app->get('http_client')->request('http://url');

```

## License

MIT License

Copyright (c) 2019-present F.oris <us@f-oris.me>

