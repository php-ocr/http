<?php

declare(strict_types=1);

namespace OCR\Utility\Http\Response;

use OCR\Engine\EngineInterface;
use OCR\Exception\Exception;
use Psr\Http\Message\ResponseInterface;
use Throwable;

abstract class JsonResponseParser implements ResponseParserInterface
{
    public function parse(EngineInterface $engine, ResponseInterface $response): string
    {
        $statusCode = $response->getStatusCode();
        if (!$this->validateStatusCode($statusCode)) {
            $this->throw($response);
        }

        $json = $response->getBody()->getContents();

        /** @var mixed[]|bool|null */
        $data = json_decode($json, true);
        if (!is_array($data)) {
            $this->throw($response);
        }

        /** @var mixed[] $data */
        if (!$this->validateResponseData($data)) {
            $this->throw($response);
        }

        $result = null;
        try {
            $result = $this->parseResponseData($data);
        } catch (Throwable $error) {
            $this->throw($response);
        }

        /** @var string $result */

        return $result;
    }

    protected function validateStatusCode(int $code): bool
    {
        $success = (
            $code >= 200
                &&
            $code <= 299
        );

        return $success;
    }

    /**
     * @param mixed[] $data
     */
    abstract protected function validateResponseData(array $data): bool;

    /**
     * @param mixed[] $data
     */
    abstract protected function parseResponseData(array $data): string;

    private function throw(ResponseInterface $response): void
    {
        $template = implode("\n", [
            'Request failed.',
            'Response code: %d',
            'Response body:',
            '%s',
        ]);

        $message = vsprintf($template, [
            $response->getStatusCode(),
            $response->getBody(),
        ]);

        $exception = new Exception($message);

        throw $exception;
    }
}
