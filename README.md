# UMeng Analytics OpenApi

[![Latest Stable Version](https://img.shields.io/packagist/v/suyar/hyperf-umeng)](https://packagist.org/packages/suyar/hyperf-umeng)
[![Total Downloads](https://img.shields.io/packagist/dt/suyar/hyperf-umeng)](https://packagist.org/packages/suyar/hyperf-umeng)
[![License](https://img.shields.io/packagist/l/suyar/hyperf-umeng)](https://github.com/suyar/hyperf-umeng)

## Installation

Requirements:

- php: >=8.1
- ext-swoole: >=5.0 (SWOOLE_HOOK_NATIVE_CURL)
- Composer >= 2.0

```shell
composer require suyar/hyperf-umeng
```

## Usage

Publish the files of the clickhouse component:

```shell
php bin/hyperf.php vendor:publish suyar/hyperf-umeng
```

Modify your config file `config/autoload/umeng.php`:

```php
<?php

declare(strict_types=1);

use function Hyperf\Support\env;

return [
    'api_key' => (string) env('UMENG_API_KEY'),
    'api_security' => (string) env('UMENG_API_SECURITY'),
    // Guzzle max curl handles.
    'max_handles' => 10,
    // Guzzle default options.
    'options' => [
        'timeout' => 0,
    ],
];
```

Using the `default` ApiKey and ApiSecurity by `[Inject]`:

```php
namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Suyar\UMeng\Client;

class IndexController
{
    #[Inject]
    protected Client $client;

    public function index()
    {
        return $this->client->uapp->getAppCount();
    }
}
```

Or use factory:

```php
namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Suyar\UMeng\Client;use Suyar\UMeng\ClientFactory;

class IndexController
{
    #[Inject]
    protected ClientFactory $clientFactory;

    public function index()
    {
        $client = $this->clientFactory->get('apiKey', 'apiSecret');

        return $client->uapp->getAppCount();
    }
}
```

## Methods

```php
$umeng->uApp; // U-App
$umeng->appTrack; // AppTrack
$umeng->uMini; // U-MiniProgram
```

Refer:
  - [How to use Open API](https://developer.umeng.com/open-api/guide)
  - [U-App](https://developer.umeng.com/open-api/ns/com.umeng.uapp/apply)
  - [AppTrack](https://developer.umeng.com/open-api/ns/com.umeng.apptrack/apply)
  - [U-MiniProgram](https://developer.umeng.com/open-api/ns/com.umeng.umini/apply)

## Via JetBrains

[![](https://resources.jetbrains.com/storage/products/company/brand/logos/jb_beam.svg)](https://www.jetbrains.com/?from=https://github.com/suyar)

## Contact

- [Email](mailto:su@zorzz.com)

## License

[MIT](LICENSE)

## Donate 🍵

If you are using this program or like it, you can support me in the following ways:

- Star、Fork、Watch 🚀
- WechatPay、AliPay ❤

|                                        WechatPay                                         |                                       AliPay                                        |
|:----------------------------------------------------------------------------------------:|:-----------------------------------------------------------------------------------:|
|   <img src="https://ooo.0x0.ooo/2024/07/10/OPsOGq.png" alt="Wechat QRcode" width=170>    | <img src="https://ooo.0x0.ooo/2024/07/10/OPsMev.png" alt="AliPay QRcode" width=170> |
