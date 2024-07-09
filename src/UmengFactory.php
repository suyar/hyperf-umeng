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

use Hyperf\Contract\ConfigInterface;
use Psr\Container\ContainerInterface;

class UmengFactory
{
    public function __invoke(ContainerInterface $container): Umeng
    {
        $config = $container->get(ConfigInterface::class);

        return $this->create(
            (string) $config->get('umeng.api_key'),
            (string) $config->get('umeng.api_security'),
        );
    }

    public function create(string $apiKey, string $apiSecKey): Umeng
    {
        return new Umeng($apiKey, $apiSecKey);
    }
}
