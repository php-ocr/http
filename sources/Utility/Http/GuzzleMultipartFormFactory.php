<?php

declare(strict_types=1);

namespace OCR\Utility\Http;

use GuzzleHttp\Psr7\MultipartStream;
use OCR\Input\InputInterface;

/**
 * Warning!
 * Requires `guzzlehttp/psr7` to be installed!
 */
class GuzzleMultipartFormFactory implements MultipartFormFactoryInterface
{
    public function createForm(array $items): MultipartFormInterface
    {
        $stream = $this->getGuzzleStream($items);
        $boundary = $stream->getBoundary();

        $form = new MultipartForm($stream, $boundary);

        return $form;
    }

    /**
     * @param MultipartFormItemInterface[] $items
     */
    private function getGuzzleStream(array $items): MultipartStream
    {
        foreach ($items as &$item) {
            $item = $this->getGuzzleMultipartFormItem($item);
        }

        $stream = new MultipartStream($items);

        return $stream;
    }

    /**
     * @return mixed[]
     */
    private function getGuzzleMultipartFormItem(MultipartFormItemInterface $item): array
    {
        $data = [];

        $name = $item->getName();
        $data['name'] = $name;

        $contents = $item->getData();
        if ($contents instanceof InputInterface) {
            $contents = $contents->getStream();
        }
        $data['contents'] = $contents;

        return $data;
    }
}
