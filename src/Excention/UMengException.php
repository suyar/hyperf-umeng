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

namespace Suyar\UMeng\Excention;

use Exception;

class UMengException extends Exception
{
    public function __construct(
        string $message = '',
        protected string $errorMessage = '',
        protected string $errorCode = '',
        protected string $exception = '',
        protected string $requestId = ''
    ) {
        parent::__construct(message: $message);
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    public function getException(): string
    {
        return $this->exception;
    }

    public function getRequestId(): string
    {
        return $this->requestId;
    }
}
