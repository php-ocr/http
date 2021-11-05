<?php

declare(strict_types=1);

namespace OCR\Utility\Http;

use GuzzleHttp\Psr7\MultipartStream;

/**
 * Warning!
 * Requires `guzzlehttp/psr7` to be installed!
 */
class GuzzleMultipartFormFactory implements MultipartFormFactoryInterface
{
    private MultipartStream $guzzleStream;

    /**
     * @param MultipartFormItemInterface[] $items
     */
    public function __construct(array $items)
    {
        $this->initializeGuzzleStream($items);
    }

    public function getMultipartForm(array $items): MultipartFormInterface
    {
        $stream = $this->guzzleStream;
        $boundary = $this->guzzleStream->getBoundary();
        $form = new MultipartForm($stream, $boundary);

        return $form;
    }

    /**
     * @param MultipartFormItemInterface[] $items
     */
    private function initializeGuzzleStream(array $items): void
    {
        foreach ($items as &$item) {
            $item = $this->getGuzzleMultipartFormItem($item);
        }

        $this->guzzleStream = new MultipartStream($items);
    }

    /**
     * @return mixed[]
     */
    private function getGuzzleMultipartFormItem(MultipartFormItemInterface $item): array
    {
        $data = [];
        $data['name'] = $item->getName();
        $data['contents'] = $item->getData();

        return $data;
    }
}
