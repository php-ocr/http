<?php

declare(strict_types=1);

namespace OCR\Utility\Http\Response;

use OCR\Engine\EngineInterface;
use Psr\Http\Message\ResponseInterface;

interface ResponseParserInterface
{
    public function parse(EngineInterface $engine, ResponseInterface $response): string;
}
