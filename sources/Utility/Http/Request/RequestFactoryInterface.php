<?php

declare(strict_types=1);

namespace OCR\Utility\Http\Request;

use OCR\Engine\EngineInterface;
use OCR\Input\InputInterface;
use Psr\Http\Message\RequestInterface;

interface RequestFactoryInterface
{
    public function createRequest(EngineInterface $engine, InputInterface $input): RequestInterface;
}
