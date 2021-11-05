<?php

declare(strict_types=1);

namespace OCR\Utility\Http;

use OCR\Input\InputInterface;
use Psr\Http\Message\StreamInterface;

interface MultipartFormItemInterface
{
    public function getName(): string;

    /**
     * @return InputInterface|StreamInterface|resource|string
     */
    public function getData();
}
