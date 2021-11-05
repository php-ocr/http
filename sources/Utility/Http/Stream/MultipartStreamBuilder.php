<?php

declare(strict_types=1);

namespace OCR\Utility\Http\Stream;

use Http\Message\MultipartStream\MultipartStreamBuilder as Builder;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

class MultipartStreamBuilder implements MultipartStreamBuilderInterface
{
    private Builder $builder;

    public function __construct(StreamFactoryInterface $streamFactory)
    {
        $this->builder = new Builder($streamFactory);
    }

    public function addData(string $name, string $data): self
    {
        $this->builder->addResource($name, $data);

        return $this;
    }

    public function addStream(string $name, StreamInterface $stream): self
    {
        $this->builder->addResource($name, $stream);

        return $this;
    }

    public function getBoundary(): string
    {
        $boundary = $this->builder->getBoundary();

        return $boundary;
    }

    public function getContentType(): string
    {
        $template = 'multipart/form-data; boundary="%s"';
        $boundary = $this->getBoundary();
        $contentType = sprintf($template, $boundary);

        return $contentType;
    }

    public function getStream(): StreamInterface
    {
        $stream = $this->builder->build();

        return $stream;
    }

    public function reset(): self
    {
        $this->builder->reset();

        return $this;
    }
}
