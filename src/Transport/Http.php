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

namespace Suyar\UMeng\Transport;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlFactory;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use Suyar\UMeng\Excention\UMengException;
use Throwable;

class Http
{
    protected const GATEWAY = 'https://gateway.open.umeng.com/openapi/';

    protected Client $httpClient;

    public function __construct(
        protected string $apiKey,
        protected string $apiSecurity,
        protected int $maxHandles = 10,
        protected array $options = [],
    ) {
        $curlFactory = new CurlFactory(max($this->maxHandles, 1));
        $handler = new CurlHandler(['handle_factory' => $curlFactory]);
        $stack = HandlerStack::create($handler);

        $defaultHeaders = $options['headers'] ?? [];
        is_array($defaultHeaders) || ($defaultHeaders = []);

        $options['handler'] = $stack;
        $options['base_uri'] = self::GATEWAY;
        $options['http_errors'] = false;
        $options['headers'] = array_replace($defaultHeaders, [
            'User-Agent' => 'suyar/hyperf-umeng',
            'Connection' => 'keep-alive',
        ]);

        $this->httpClient = new Client($options);
    }

    /**
     * @throws UMengException
     */
    public function request(int|string $version, string $namespace, string $function, array $params = []): array
    {
        $path = "param2/{$version}/{$namespace}/{$function}/{$this->apiKey}";
        // $params['_aop_timestamp'] = intval(microtime(true) * 1000);
        $params['_aop_signature'] = $this->signature($path, $params);

        $failMessage = "request [{$namespace}:{$function}-{$version}] fail: %s";

        try {
            $response = $this->httpClient->post($path, [
                'form_params' => $params,
            ]);

            $body = $response->getBody()->getContents();
            $result = json_decode($body, true);

            if (! empty($result['error_message'])) {
                throw new UMengException(
                    sprintf($failMessage, $result['error_message']),
                    strval($result['error_message']),
                    strval($result['error_code'] ?? ''),
                    strval($result['exception'] ?? ''),
                    strval($result['request_id'] ?? '')
                );
            }

            if ($response->getStatusCode() !== 200 || ! is_array($result)) {
                throw new UMengException(sprintf($failMessage, $body));
            }

            return $result;
        } catch (UMengException $e) {
            throw $e;
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
