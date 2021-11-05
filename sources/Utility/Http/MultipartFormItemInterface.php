<?php

declare(strict_types=1);

namespace OCR\Utility\Http;

use Psr\Http\Message\StreamInterface;

interface MultipartFormItemInterface
{
    public function getName(): string;

    /**
     * @return StreamInterface|resource|string
     */
    public function getData();
}
