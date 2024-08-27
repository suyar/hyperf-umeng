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
use function Hyperf\Support\env;

return [
    'api_key' => (string) env('UMENG_API_KEY'),
    'api_security' => (string) env('UMENG_API_SECURITY'),
];
