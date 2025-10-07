<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use Exception;
use RuntimeException;
use Symfony\Component\Stopwatch\Stopwatch;
use Psr\Cache\CacheItemPoolInterface;

final class SoapClient
{
  
  /**
   * @var SoapResponseProcessorInterface[]
  */
  private array $processors;

  private ?\SoapClient $client = null;
  private ?string $sessionId = null;
  private ?string $pkUser = null;

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
   * Initialize the SOAP client
   */
  private function initializeClient(): void
  {
    if (empty($this->wsdlUrl)) {
      throw new RuntimeException('WSDL URL is required');
    }

    if (parse_url($this->wsdlUrl) === false) {
      throw new RuntimeException('WSDL URL must be a valid URL');
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
   * Set authentication context
   */
  public function setAuthentication(string $sessionId, int $pkUser): void
  {
    $this->sessionId = $sessionId;
    $this->pkUser = (string) $pkUser;
  }

  /**
   * Call a SOAP method
   */
  public function call(string $method, object $request): object|string
  {
    $this->stopwatchStart('SoapClient::call');

    // Add authentication to request if not already present
    if (!isset($request->SessionID) && $this->sessionId) {
      $request->SessionID = $this->sessionId;
    }
    if (!isset($request->PkUser) && $this->pkUser) {
      $request->PkUser = $this->pkUser;
    }

    $params = [$request];
    $response = null;

    try {
        $response = $this->client->__soapCall($method, $params);

    } catch (Exception $e) {
      $this->stopwatchStop('SoapClient::call');
      throw new RuntimeException("SOAP call failed for method '$method': " . $e->getMessage(), 0, $e);
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
   * Start stopwatch
   */
  private function stopwatchStart(string $name): void
  {
    if ($this->stopwatch) {
      $this->stopwatch->start($name);
    }
  }

  /**
   * Stop stopwatch
   */
  private function stopwatchStop(string $name): void
  {
    if ($this->stopwatch) {
      $this->stopwatch->stop($name);
    }
  }

  /**
   * Get the underlying SOAP client for advanced usage
   */
  public function getClient(): \SoapClient
  {
    return $this->client;
  }
}
