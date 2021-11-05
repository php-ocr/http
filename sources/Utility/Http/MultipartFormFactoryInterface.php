<?php

declare(strict_types=1);

namespace OCR\Utility\Http;

interface MultipartFormFactoryInterface
{
    /**
     * @param MultipartFormItemInterface[] $items
     */
    public function createForm(array $items): MultipartFormInterface;
}
