<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Stopwatch\Stopwatch;

final class SoapClient
{
    private ?\SoapClient $client = null;

    private ?string $pkUser = null;

    /**
     * @var SoapResponseProcessorInterface[]
     */
    private array $processors;

    private ?string $sessionId = null;

    public function __construct(
        private readonly string $wsdlUrl,
        private readonly ?CacheItemPoolInterface $cache = null,
        private readonly ?Stopwatch $stopwatch = null,
        private readonly bool $debug = false,
        array $processors
    ) {
        $this->processors = $processors;
        $this->initializeClient();
    }

    /**
     * Call a SOAP method.
     */
    public function call(string $method, object $request): bool|object|string
    {
        $this->stopwatchStart('SoapClient::call');

        // Add authentication to request if not already present
        if (! isset($request->SessionID) && $this->sessionId) {
            $request->SessionID = $this->sessionId;
        }
        if (! isset($request->PkUser) && $this->pkUser) {
            $request->PkUser = $this->pkUser;
        }

        $params = [$request];
        $response = null;

        try {
            $response = $this->client->__soapCall($method, $params);
        } catch (\Exception $e) {
            $this->stopwatchStop('SoapClient::call');

            throw new \RuntimeException("SOAP call failed for method '{$method}': " . $e->getMessage(), 0, $e);
        }

        foreach ($this->processors as $processor) {
            if ($processor->supports($method)) {
                $result = $processor->process($method, $response);
            }
        }

        $this->stopwatchStop('SoapClient::call');

        return $result;
    }

    /**
     * Get the underlying SOAP client for advanced usage.
     */
    public function getClient(): \SoapClient
    {
        return $this->client;
    }

    /**
     * Set authentication context.
     */
    public function setAuthentication(string $sessionId, int $pkUser): void
    {
        $this->sessionId = $sessionId;
        $this->pkUser = (string) $pkUser;
    }

    /**
     * Initialize the SOAP client.
     */
    private function initializeClient(): void
    {
        if (empty($this->wsdlUrl)) {
            throw new \RuntimeException('WSDL URL is required');
        }

        if (false === parse_url($this->wsdlUrl)) {
            throw new \RuntimeException('WSDL URL must be a valid URL');
        }

        $this->stopwatchStart('SoapClient::initializeClient');

        $this->client = new \SoapClient($this->wsdlUrl, [
            'trace' => 1,
            'exception' => true,
            'cache_wsdl' => WSDL_CACHE_MEMORY,
        ]);

        $this->stopwatchStop('SoapClient::initializeClient');
    }

    /**
     * Start stopwatch.
     */
    private function stopwatchStart(string $name): void
    {
        if ($this->stopwatch) {
            $this->stopwatch->start($name);
        }
    }

    /**
     * Stop stopwatch.
     */
    private function stopwatchStop(string $name): void
    {
        if ($this->stopwatch) {
            $this->stopwatch->stop($name);
        }
    }
}
