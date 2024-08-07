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

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'dependencies' => [
                Umeng::class => UmengFactory::class,
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for umeng.',
                    'source' => __DIR__ . '/../publish/umeng.php',
                    'destination' => BASE_PATH . '/config/autoload/umeng.php',
                ],
            ],
        ];
    }
}
