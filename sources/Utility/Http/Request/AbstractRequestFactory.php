<?php

declare(strict_types=1);

namespace OCR\Utility\Http\Request;

use OCR\Utility\Http\Request\Multipart\MultipartFormFactoryInterface;
use Psr\Http\Message\RequestFactoryInterface;

abstract class AbstractRequestFactory implements RequestFactoryInterface
{
    protected RequestFactoryInterface $requestFactory;

    protected MultipartFormFactoryInterface $formFactory;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        MultipartFormFactoryInterface $formFactory
    ) {
        $this->requestFactory = $requestFactory;
        $this->formFactory = $formFactory;
    }
}
