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

namespace Suyar\UMeng\OpenApi;

use GuzzleHttp\Exception\RequestException;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Guzzle\ClientFactory;
use Suyar\UMeng\Excention\UMengException;
use Throwable;

class Http
{
    protected const GATEWAY = 'https://gateway.open.umeng.com/openapi/';

    #[Inject]
    protected ClientFactory $clientFactory;

    public function __construct(protected string $apiKey, protected string $apiSecurity)
    {
    }

    /**
     * @throws UMengException
     */
    public function request(int|string $version, string $namespace, string $function, array $params = []): array
    {
        $path = "param2/{$version}/{$namespace}/{$function}/{$this->apiKey}";
        // $params['_aop_timestamp'] = intval(microtime(true) * 1000);
        $params['_aop_signature'] = $this->signature($path, $params);

        $client = $this->clientFactory->create([
            'base_uri' => self::GATEWAY,
            'timeout' => 30,
        ]);

        $failMessage = "request [{$namespace}:{$function}-{$version}] fail: %s";

        try {
            $response = $client->post($path, [
                'form_params' => $params,
            ]);

            $result = json_decode((string) $response->getBody(), true);

            if (! is_array($result)) {
                throw new UMengException(sprintf($failMessage, 'empty response'));
            }

            if (! empty($result['error_message'])) {
                throw new UMengException(
                    sprintf($failMessage, $result['error_message']),
                    strval($result['error_message']),
                    strval($result['error_code'] ?? ''),
                    strval($result['exception'] ?? ''),
                    strval($result['request_id'] ?? '')
                );
            }

            return $result;
        } catch (RequestException $e) {
            if ($response = $e->getResponse()) {
                $result = json_decode((string) $response->getBody(), true);
                if (! empty($result['error_message'])) {
                    throw new UMengException(
                        sprintf($failMessage, $result['error_message']),
                        strval($result['error_message']),
                        strval($result['error_code'] ?? ''),
                        strval($result['exception'] ?? ''),
                        strval($result['request_id'] ?? '')
                    );
                }
            }

            throw new UMengException(sprintf($failMessage, $e->getMessage()));
        } catch (Throwable $t) {
            throw new UMengException(sprintf($failMessage, $t->getMessage()));
        }
    }

    protected function signature(string $path, array $params): string
    {
        $paramsToSign = [];

        foreach ($params as $k => $v) {
            $paramsToSign[] = "{$k}{$v}";
        }

        sort($paramsToSign);

        $stringToSign = $path . implode('', $paramsToSign);

        return strtoupper(hash_hmac('sha1', $stringToSign, $this->apiSecurity));
    }
}
