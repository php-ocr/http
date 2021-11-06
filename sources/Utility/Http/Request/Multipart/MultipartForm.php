<?php

declare(strict_types=1);

namespace OCR\Utility\Http\Request\Multipart;

use Psr\Http\Message\StreamInterface;

class MultipartForm implements MultipartFormInterface
{
    private StreamInterface $stream;

    private string $boundary;

    public function __construct(StreamInterface $stream, string $boundary)
    {
        $this->stream = $stream;
        $this->boundary = $boundary;
    }

    public function getStream(): StreamInterface
    {
        return $this->stream;
    }

    public function getBoundary(): string
    {
        return $this->boundary;
    }

    public function getContentType(): string
    {
        $template = 'multipart/form-data; boundary="%s"';
        $boundary = $this->getBoundary();
        $contentType = sprintf($template, $boundary);

        return $contentType;
    }
}
