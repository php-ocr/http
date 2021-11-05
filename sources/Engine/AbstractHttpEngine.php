<?php

declare(strict_types=1);

namespace OCR\Engine;

use OCR\Input\InputInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractHttpEngine extends AbstractEngine
{
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        parent::__construct();

        $this->client = $client;
    }

    public function process(InputInterface $input): string
    {
        $request = $this->createRequest($input);
        $response = $this->client->sendRequest($request);
        $result = $this->parseResponse($response);

        return $result;
    }

    abstract protected function createRequest(InputInterface $input): RequestInterface;

    abstract protected function parseResponse(ResponseInterface $response): string;
}
