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

namespace Test\Cases;

use Suyar\UMeng\Client;
use Suyar\UMeng\Transport\Http;

/**
 * @internal
 * @coversNothing
 */
class ClientTest extends AbstractTestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        $http = new Http(
            '3879406',
            'RGIkGgvCoT',
            10,
            [
                'timeout' => 10,
            ],
        );

        $this->client = new Client($http);
    }

    public function testClient()
    {
        $appCount = $this->client->uApp->getAppCount();

        $this->assertArrayHasKey('count', $appCount);
    }
}
