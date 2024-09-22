<?php

declare(strict_types=1);
/**
 * This file is part of suyar/hyperf-umeng.
 *
 * @link     https://github.com/suyar/hyperf-umeng
 * @document https://github.com/suyar/hyperf-umeng/blob/main/README.md
 * @contact  su@zorzz.com
 * @license  https://github.com/suyar/hyperf-umeng/blob/master/LICENSE
 */

namespace Suyar\UMeng;

use Suyar\UMeng\OpenApi\AppTrack;
use Suyar\UMeng\OpenApi\UApp;
use Suyar\UMeng\OpenApi\UMini;
use Suyar\UMeng\Transport\Http;

/**
 * 友盟统计分析-API.
 *
 * @property UApp $uApp
 * @property AppTrack $appTrack
 * @property UMini $uMini
 */
class Client
{
    protected UApp $uApp;

    protected AppTrack $appTrack;

    protected UMini $uMini;

    public function __construct(protected Http $http)
    {
    }

    public function __get(string $name)
    {
        return match ($name) {
            'uApp' => $this->uApp ??= new UApp($this->http),
            'appTrack' => $this->appTrack ??= new AppTrack($this->http),
            'uMini' => $this->uMini ??= new UMini($this->http),
        };
    }
}
