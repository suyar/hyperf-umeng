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
use Suyar\Umeng\Umeng;

class IndexController
{
    #[Inject]
    protected Umeng $umeng;

    public function index()
    {
        return $this->umeng->uapp->getAllAppData();
    }
}
```

- Factory

```php
namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Suyar\Umeng\UmengFactory;

class IndexController
{
    #[Inject]
    protected UmengFactory $umengFactory;

    public function index()
    {
        $umeng = $this->umengFactory->create('apiKey', 'apiSecret');

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
