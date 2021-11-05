<?php

declare(strict_types=1);

namespace OCR\Utility\Http\Stream;

use Psr\Http\Message\StreamInterface;

interface MultipartStreamBuilderInterface
{
    public function addData(string $name, string $data): self;

    public function addStream(string $name, StreamInterface $stream): self;

    public function getBoundary(): string;

    public function getContentType(): string;

    public function getStream(): StreamInterface;

    public function reset(): self;
}
