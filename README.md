# 友盟统计分析 OpenApi

[![Latest Stable Version](https://img.shields.io/packagist/v/suyar/hyperf-umeng)](https://packagist.org/packages/suyar/hyperf-umeng)
[![Total Downloads](https://img.shields.io/packagist/dt/suyar/hyperf-umeng)](https://packagist.org/packages/suyar/hyperf-umeng)
[![License](https://img.shields.io/packagist/l/suyar/hyperf-umeng)](https://github.com/suyar/hyperf-umeng)

## Installation

```shell
composer require suyar/hyperf-umeng
```

## Usage

- Inject

```shell
php bin/hyperf.php vendor:publish suyar/hyperf-umeng
```

```php
namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Suyar\UMeng\Client;

class IndexController
{
    #[Inject]
    protected Client $umeng;

    public function index()
    {
        return $this->umeng->uapp->getAllAppData();
    }
}
```

- New From Api Info

```php
namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Suyar\UMeng\Client;

class IndexController
{
    public function index()
    {
        $umeng = new Client('apiKey', 'apiSecret');

        return $umeng->uapp->getAllAppData();
    }
}
```

## Methods

```php
$umeng->uapp; // U-App-移动统计.
$umeng->appTrack; // AppTrack-移动广告监测.
$umeng->umini; // U-MiniProgram-小程序统计.
```

Refer:
  - [如何使用Open API](https://developer.umeng.com/open-api/guide)
  - [U-App-移动统计](https://developer.umeng.com/open-api/ns/com.umeng.uapp/apply)
  - [AppTrack-移动广告监测](https://developer.umeng.com/open-api/ns/com.umeng.apptrack/apply)
  - [U-MiniProgram-小程序统计](https://developer.umeng.com/open-api/ns/com.umeng.umini/apply)

## Contact

- [Email](mailto:su@zorzz.com)

## License

[MIT](LICENSE)

## Donate 🍵

如果你正在使用这个项目或者喜欢这个项目的，可以通过以下方式支持我：

- Star、Fork、Watch 一键三连 🚀
- 通过微信、支付宝一次性捐款 ❤

|                                         微信                                          |                                         支付宝                                         |
|:-----------------------------------------------------------------------------------:|:-----------------------------------------------------------------------------------:|
| <img src="https://ooo.0x0.ooo/2024/07/10/OPsOGq.png" alt="Wechat QRcode" width=170> | <img src="https://ooo.0x0.ooo/2024/07/10/OPsMev.png" alt="AliPay QRcode" width=170> |
