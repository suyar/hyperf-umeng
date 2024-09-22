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

use Hyperf\Contract\ConfigInterface;
use Psr\Container\ContainerInterface;
use Suyar\UMeng\Transport\Http;

class ClientFactory
{
    protected ConfigInterface $config;

    public function __construct(ContainerInterface $container)
    {
        $this->config = $container->get(ConfigInterface::class);
    }

    public function __invoke(): Client
    {
        return $this->get();
    }

    public function get(string $apiKey = '', string $apiSecurity = ''): Client
    {
        $http = new Http(
            strval($apiKey ?: $this->config->get('umeng.api_key')),
            strval($apiSecurity ?: $this->config->get('umeng.api_security')),
            (int) $this->config->get('umeng.max_handles', 10),
            (array) $this->config->get('umeng.options', []),
        );

        return new Client($http);
    }
}
