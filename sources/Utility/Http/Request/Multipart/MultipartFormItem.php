<?php

declare(strict_types=1);

namespace OCR\Utility\Http\Request\Multipart;

use OCR\Input\InputInterface;
use Psr\Http\Message\StreamInterface;

class MultipartFormItem implements MultipartFormItemInterface
{
    private string $name;

    /**
     * @var InputInterface|StreamInterface|resource|string
     */
    private $data;

    /**
     * @param InputInterface|StreamInterface|resource|string $data
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
