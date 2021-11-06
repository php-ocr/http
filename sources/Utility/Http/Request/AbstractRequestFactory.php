<?php

declare(strict_types=1);

namespace OCR\Utility\Http\Request;

use OCR\Utility\Http\Request\Multipart\MultipartFormFactoryInterface;
use Psr\Http\Message\RequestFactoryInterface as HttpRequestFactoryInterface;

abstract class AbstractRequestFactory implements RequestFactoryInterface
{
    protected HttpRequestFactoryInterface $requestFactory;

    protected MultipartFormFactoryInterface $formFactory;

    public function __construct(
        HttpRequestFactoryInterface $requestFactory,
        MultipartFormFactoryInterface $formFactory
    ) {
        $this->requestFactory = $requestFactory;
        $this->formFactory = $formFactory;
    }
}
