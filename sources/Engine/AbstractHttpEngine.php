<?php

declare(strict_types=1);

namespace OCR\Engine;

use OCR\Input\InputInterface;
use OCR\Utility\Http\Request\RequestFactoryInterface;
use OCR\Utility\Http\Response\ResponseParserInterface;
use Psr\Http\Client\ClientInterface;

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
        $requestFactory = $this->createRequestFactory();
        $request = $requestFactory->createRequest($this, $input);

        $response = $this->client->sendRequest($request);
        $responseParser = $this->createResponseParser();
        $result = $responseParser->parse($this, $response);

        return $result;
    }

    abstract protected function createRequestFactory(): RequestFactoryInterface;

    abstract protected function createResponseParser(): ResponseParserInterface;
}
