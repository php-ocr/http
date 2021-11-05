<?php

declare(strict_types=1);

namespace OCR\Engine;

use OCR\Exception\Exception;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use SplFileInfo;

abstract class AbstractHttpEngine extends AbstractEngine
{
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        parent::__construct();

        $this->client = $client;
    }

    public function recognize(SplFileInfo $file): string
    {
        if (!$file->isFile() || !$file->isReadable()) {
            throw new Exception('Invalid file provided.');
        }

        $request = $this->createRequest($file);
        $response = $this->client->sendRequest($request);
        $result = $this->parseResponse($response);

        return $result;
    }

    abstract protected function createRequest(SplFileInfo $file): RequestInterface;

    abstract protected function parseResponse(ResponseInterface $response): string;
}
