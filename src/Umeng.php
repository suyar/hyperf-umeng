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

namespace Suyar\Umeng;

use Suyar\Umeng\OpenApi\AppTrack;
use Suyar\Umeng\OpenApi\Client;
use Suyar\Umeng\OpenApi\UApp;
use Suyar\Umeng\OpenApi\UMini;

/**
 * 友盟统计分析-API.
 *
 * @property UApp $uApp
 * @property AppTrack $appTrack
 * @property UMini $uMini
 */
class Umeng
{
    protected Client $client;

    protected UApp $uApp;

    protected AppTrack $appTrack;

    protected UMini $uMini;

    public function __construct(protected string $apiKey, protected string $apiSecurity)
    {
        $this->client = new Client($this->apiKey, $this->apiSecurity);
    }

    public function __get(string $name)
    {
        return match ($name) {
            'uApp' => $this->uApp ??= new UApp($this->client),
            'appTrack' => $this->appTrack ??= new AppTrack($this->client),
            'uMini' => $this->uMini ??= new UMini($this->client),
        };
    }
}
