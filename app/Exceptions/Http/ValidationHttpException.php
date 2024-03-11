<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Exceptions\Http;

use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * @author Ben Ramsey <ben@benramsey.com>
 */
class ValidationHttpException extends HttpException
{
    public function __construct(string $message = '', \Throwable $previous = null, int $code = 0, array $headers = [])
    {
        parent::__construct(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY, $message, $previous, $headers, $code);
    }
}
