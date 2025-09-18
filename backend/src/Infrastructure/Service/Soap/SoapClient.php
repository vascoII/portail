<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use Exception;
use RuntimeException;
use Symfony\Component\Stopwatch\Stopwatch;
use Psr\Cache\CacheItemPoolInterface;

final class SoapClient
{
  private ?\SoapClient $client = null;
  private ?string $sessionId = null;
  private ?string $pkUser = null;

  public function __construct(
    private readonly string $wsdlUrl,
    private readonly ?CacheItemPoolInterface $cache = null,
    private readonly ?Stopwatch $stopwatch = null,
    private readonly bool $debug = false
  ) {
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
  public function call(string $method, object $request): array
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

    // Check cache if available
    if ($this->cache && $this->shouldUseCache($method)) {
      $response = $this->getCachedResponse($method, $request);
    }

    // Make SOAP call if not cached
    if ($response === null) {
      try {
        $response = $this->client->__soapCall($method, $params);

        // Cache the response if cache is available
        if ($this->cache && $this->shouldUseCache($method)) {
          $this->cacheResponse($method, $request, $response);
        }
      } catch (Exception $e) {
        $this->stopwatchStop('SoapClient::call');
        throw new RuntimeException("SOAP call failed for method '$method': " . $e->getMessage(), 0, $e);
      }
    }

    $result = $this->processResponse($method, $response);

    $this->stopwatchStop('SoapClient::call');

    return $result;
  }

  /**
   * Process SOAP response and extract result
   */
  private function processResponse(string $method, $response): array
  {
    $resultName = $method . 'Result';

    if (!isset($response->{$resultName})) {
      throw new RuntimeException("SOAP method '$method' failed: No result found");
    }

    $result = $response->{$resultName};

    // Check for SOAP errors
    if (isset($result->Erreur) && !empty($result->Erreur)) {
      $errorMessage = $result->Erreur;
      if ($this->debug) {
        $errorMessage .= ' (Debug mode enabled)';
      }
      throw new RuntimeException("SOAP error in method '$method': $errorMessage");
    }

    return $this->objectToArray($result);
  }

  /**
   * Convert object to array recursively
   */
  private function objectToArray($obj): array
  {
    if (is_object($obj)) {
      $obj = (array) $obj;
    }

    if (is_array($obj)) {
      return array_map([$this, 'objectToArray'], $obj);
    }

    return $obj;
  }

  /**
   * Check if method should use cache
   */
  private function shouldUseCache(string $method): bool
  {
    // Don't cache report methods as they return dynamic content
    return !in_array($method, ['GetReport', 'GetFile'], true);
  }

  /**
   * Get cached response
   */
  private function getCachedResponse(string $method, object $request): ?array
  {
    if (!$this->cache) {
      return null;
    }

    $requestCache = clone $request;
    unset($requestCache->SessionID);

    $key = md5($method . json_encode($requestCache));
    $cacheItem = $this->cache->getItem($key);

    if ($cacheItem->isHit()) {
      return json_decode($cacheItem->get(), true);
    }

    return null;
  }

  /**
   * Cache response
   */
  private function cacheResponse(string $method, object $request, $response): void
  {
    if (!$this->cache) {
      return;
    }

    $requestCache = clone $request;
    unset($requestCache->SessionID);

    $key = md5($method . json_encode($requestCache));
    $cacheItem = $this->cache->getItem($key);
    $cacheItem->set(json_encode($response));
    $this->cache->save($cacheItem);
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
