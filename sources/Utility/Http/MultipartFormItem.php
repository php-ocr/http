<?php

declare(strict_types=1);

namespace OCR\Utility\Http;

use Psr\Http\Message\StreamInterface;

class MultipartFormItem implements MultipartFormItemInterface
{
    private string $name;

    /**
     * @var StreamInterface|resource|string
     */
    private $data;

    /**
     * @param StreamInterface|resource|string $data
     */
    public function __construct(string $name, $data)
    {
        $this->name = $name;
        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->data;
    }
}
