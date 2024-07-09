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
use Suyar\Umeng\OpenApi\Umini;

/**
 * 友盟统计分析-API.
 *
 * @property UApp $uapp
 * @property AppTrack $appTrack
 * @property Umini $umini
 */
class Umeng
{
    protected Client $client;

    protected UApp $uapp;

    protected AppTrack $apptrack;

    protected Umini $umini;

    public function __construct(protected string $apiKey, protected string $apiSecurity)
    {
        $this->client = new Client($this->apiKey, $this->apiSecurity);
    }

    public function __get(string $name)
    {
        return match ($name) {
            'uapp' => $this->uapp ??= new UApp($this->client),
            'appTrack' => $this->apptrack ??= new AppTrack($this->client),
            'umini' => $this->umini ??= new Umini($this->client),
        };
    }
}
