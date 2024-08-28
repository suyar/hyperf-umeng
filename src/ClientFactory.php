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

class ClientFactory
{
    public function __invoke(ContainerInterface $container): Client
    {
        $config = $container->get(ConfigInterface::class);

        return new Client(
            (string) $config->get('umeng.api_key'),
            (string) $config->get('umeng.api_security'),
        );
    }
}
