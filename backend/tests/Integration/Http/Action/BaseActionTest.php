<?php

declare(strict_types=1);

namespace App\Tests\Integration\Http\Action;

use PHPUnit\Framework\TestCase;
use Mockery;
use Mockery\MockInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class BaseActionTest extends TestCase
{
  protected function tearDown(): void
  {
    Mockery::close();
  }

  /**
   * Create a mock for UseCase interfaces
   */
  protected function createUseCaseMock(string $useCaseClass): MockInterface
  {
    return Mockery::mock('alias:' . $useCaseClass);
  }

  /**
   * Create a mock for Factory interfaces
   */
  protected function createFactoryMock(string $factoryClass): MockInterface
  {
    return Mockery::mock('alias:' . $factoryClass);
  }

  /**
   * Create a mock for ResponderInterface
   */
  protected function createResponderMock(): MockInterface
  {
    return Mockery::mock(\App\Http\Responder\ResponderInterface::class);
  }

  /**
   * Create a mock HTTP request
   */
  protected function createRequest(
    string $method = 'GET',
    string $uri = '/',
    array $query = [],
    array $request = [],
    array $attributes = [],
    string $content = '',
    array $server = []
  ): Request {
    return Request::create($uri, $method, $query, [], [], $server, $content);
  }

  /**
   * Create a mock JSON request
   */
  protected function createJsonRequest(
    string $method = 'POST',
    string $uri = '/',
    array $data = [],
    array $headers = []
  ): Request {
    $headers = array_merge([
      'CONTENT_TYPE' => 'application/json',
      'HTTP_ACCEPT' => 'application/json'
    ], $headers);

    return Request::create(
      $uri,
      $method,
      [],
      [],
      [],
      $headers,
      json_encode($data)
    );
  }

  /**
   * Create a mock HTTP response
   */
  protected function createResponse(
    mixed $data = null,
    int $status = Response::HTTP_OK,
    array $headers = []
  ): Response {
    if ($data !== null) {
      return new JsonResponse($data, $status, $headers);
    }
    return new Response('', $status, $headers);
  }

  /**
   * Assert that a response has the expected status code
   */
  protected function assertResponseStatus(Response $response, int $expectedStatus): void
  {
    $this->assertEquals($expectedStatus, $response->getStatusCode());
  }

  /**
   * Assert that a response is a JSON response
   */
  protected function assertJsonResponse(Response $response): void
  {
    $this->assertInstanceOf(JsonResponse::class, $response);
  }

  /**
   * Assert that a response has the expected JSON data
   */
  protected function assertResponseData(Response $response, mixed $expectedData): void
  {
    $this->assertJsonResponse($response);
    $actualData = json_decode($response->getContent(), true);
    $this->assertEquals($expectedData, $actualData);
  }

  /**
   * Assert that a response has the expected headers
   */
  protected function assertResponseHeaders(Response $response, array $expectedHeaders): void
  {
    foreach ($expectedHeaders as $name => $value) {
      $this->assertEquals($value, $response->headers->get($name));
    }
  }

  /**
   * Assert that a response contains specific data
   */
  protected function assertResponseContains(Response $response, array $expectedData): void
  {
    $this->assertJsonResponse($response);
    $actualData = json_decode($response->getContent(), true);

    foreach ($expectedData as $key => $value) {
      $this->assertArrayHasKey($key, $actualData);
      $this->assertEquals($value, $actualData[$key]);
    }
  }

  /**
   * Assert that a response has the expected content type
   */
  protected function assertResponseContentType(Response $response, string $expectedContentType): void
  {
    $this->assertEquals($expectedContentType, $response->headers->get('Content-Type'));
  }

  /**
   * Assert that a response is successful (2xx status)
   */
  protected function assertResponseSuccess(Response $response): void
  {
    $this->assertGreaterThanOrEqual(200, $response->getStatusCode());
    $this->assertLessThan(300, $response->getStatusCode());
  }

  /**
   * Assert that a response is a client error (4xx status)
   */
  protected function assertResponseClientError(Response $response): void
  {
    $this->assertGreaterThanOrEqual(400, $response->getStatusCode());
    $this->assertLessThan(500, $response->getStatusCode());
  }

  /**
   * Assert that a response is a server error (5xx status)
   */
  protected function assertResponseServerError(Response $response): void
  {
    $this->assertGreaterThanOrEqual(500, $response->getStatusCode());
    $this->assertLessThan(600, $response->getStatusCode());
  }

  /**
   * Create test route arguments
   */
  protected function createRouteArgs(array $args = []): array
  {
    return $args;
  }

  /**
   * Create test request with authentication headers
   */
  protected function createAuthenticatedRequest(
    string $method = 'GET',
    string $uri = '/',
    string $token = 'test_token_123',
    array $data = []
  ): Request {
    $headers = [
      'HTTP_AUTHORIZATION' => 'Bearer ' . $token,
      'CONTENT_TYPE' => 'application/json',
      'HTTP_ACCEPT' => 'application/json'
    ];

    return Request::create(
      $uri,
      $method,
      [],
      [],
      [],
      $headers,
      json_encode($data)
    );
  }

  /**
   * Create test request with query parameters
   */
  protected function createQueryRequest(
    string $uri = '/',
    array $query = []
  ): Request {
    return Request::create($uri, 'GET', $query);
  }

  /**
   * Assert that a response has the expected structure
   */
  protected function assertResponseStructure(Response $response, array $expectedKeys): void
  {
    $this->assertJsonResponse($response);
    $actualData = json_decode($response->getContent(), true);
    $actualKeys = array_keys($actualData);

    foreach ($expectedKeys as $key) {
      $this->assertContains($key, $actualKeys);
    }
  }

  /**
   * Assert that a response has the expected pagination structure
   */
  protected function assertResponsePagination(Response $response): void
  {
    $this->assertJsonResponse($response);
    $actualData = json_decode($response->getContent(), true);

    $this->assertArrayHasKey('data', $actualData);
    $this->assertArrayHasKey('pagination', $actualData);
    $this->assertIsArray($actualData['data']);
  }

  /**
   * Assert that a response has the expected error structure
   */
  protected function assertResponseError(Response $response, string $expectedMessage = null): void
  {
    $this->assertJsonResponse($response);
    $actualData = json_decode($response->getContent(), true);

    $this->assertArrayHasKey('error', $actualData);

    if ($expectedMessage) {
      $this->assertEquals($expectedMessage, $actualData['error']);
    }
  }
}
