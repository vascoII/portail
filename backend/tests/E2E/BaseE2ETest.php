<?php

declare(strict_types=1);

namespace App\Tests\E2E;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseE2ETest extends TestCase
{
  protected string $baseUrl;
  protected ?string $authToken = null;
  protected array $defaultHeaders = [];

  protected function setUp(): void
  {
    $this->baseUrl = $_ENV['E2E_BASE_URL'] ?? 'http://localhost:8000';
    $this->defaultHeaders = [
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
    ];
  }

  protected function tearDown(): void
  {
    $this->authToken = null;
  }

  /**
   * Make an HTTP request to the API
   */
  protected function makeRequest(
    string $method,
    string $endpoint,
    array $data = [],
    array $headers = []
  ): array {
    $url = $this->baseUrl . $endpoint;
    $requestHeaders = array_merge($this->defaultHeaders, $headers);

    if ($this->authToken) {
      $requestHeaders['Authorization'] = 'Bearer ' . $this->authToken;
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $this->formatHeaders($requestHeaders));
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    if (!empty($data)) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
      throw new \RuntimeException('cURL Error: ' . $error);
    }

    return [
      'status_code' => $httpCode,
      'content' => $response,
      'headers' => $requestHeaders,
    ];
  }

  /**
   * Format headers for cURL
   */
  private function formatHeaders(array $headers): array
  {
    $formatted = [];
    foreach ($headers as $key => $value) {
      $formatted[] = $key . ': ' . $value;
    }
    return $formatted;
  }

  /**
   * Make a GET request
   */
  protected function get(string $endpoint, array $headers = []): array
  {
    return $this->makeRequest('GET', $endpoint, [], $headers);
  }

  /**
   * Make a POST request
   */
  protected function post(string $endpoint, array $data = [], array $headers = []): array
  {
    return $this->makeRequest('POST', $endpoint, $data, $headers);
  }

  /**
   * Make a PUT request
   */
  protected function put(string $endpoint, array $data = [], array $headers = []): array
  {
    return $this->makeRequest('PUT', $endpoint, $data, $headers);
  }

  /**
   * Make a PATCH request
   */
  protected function patch(string $endpoint, array $data = [], array $headers = []): array
  {
    return $this->makeRequest('PATCH', $endpoint, $data, $headers);
  }

  /**
   * Make a DELETE request
   */
  protected function delete(string $endpoint, array $headers = []): array
  {
    return $this->makeRequest('DELETE', $endpoint, [], $headers);
  }

  /**
   * Authenticate and store the token
   */
  protected function authenticate(string $email, string $password): array
  {
    $response = $this->post('/api/security/login', [
      'email' => $email,
      'password' => $password,
    ]);

    $this->assertEquals(200, $response['status_code']);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('token', $data);

    $this->authToken = $data['token'];
    return $data;
  }

  /**
   * Logout and clear the token
   */
  protected function logout(): void
  {
    if ($this->authToken) {
      $this->post('/api/security/logout');
      $this->authToken = null;
    }
  }

  /**
   * Get response data as array
   */
  protected function getResponseData(array $response): array
  {
    $content = $response['content'];
    $data = json_decode($content, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
      throw new \RuntimeException('Invalid JSON response: ' . json_last_error_msg());
    }

    return $data;
  }

  /**
   * Assert that a response is successful
   */
  protected function assertResponseSuccess(array $response, int $expectedStatusCode = 200): void
  {
    $this->assertEquals($expectedStatusCode, $response['status_code']);
  }

  /**
   * Assert that a response is an error
   */
  protected function assertResponseError(array $response, int $expectedStatusCode = 400): void
  {
    $this->assertEquals($expectedStatusCode, $response['status_code']);
  }

  /**
   * Assert that a response contains specific data
   */
  protected function assertResponseContains(array $response, array $expectedData): void
  {
    $data = $this->getResponseData($response);

    foreach ($expectedData as $key => $expectedValue) {
      $this->assertArrayHasKey($key, $data);
      $this->assertEquals($expectedValue, $data[$key]);
    }
  }

  /**
   * Assert that a response contains a specific field
   */
  protected function assertResponseHasField(array $response, string $field): void
  {
    $data = $this->getResponseData($response);
    $this->assertArrayHasKey($field, $data);
  }

  /**
   * Assert that a response contains a token
   */
  protected function assertResponseHasToken(array $response): void
  {
    $this->assertResponseHasField($response, 'token');
    $data = $this->getResponseData($response);
    $this->assertNotEmpty($data['token']);
    $this->assertIsString($data['token']);
  }

  /**
   * Assert that a response contains user information
   */
  protected function assertResponseHasUser(array $response): void
  {
    $this->assertResponseHasField($response, 'user');
    $data = $this->getResponseData($response);
    $this->assertIsArray($data['user']);
    $this->assertArrayHasKey('email', $data['user']);
  }

  /**
   * Wait for a specified number of seconds
   */
  protected function wait(int $seconds): void
  {
    sleep($seconds);
  }

  /**
   * Get test user credentials
   */
  protected function getTestUserCredentials(): array
  {
    return [
      'email' => $_ENV['E2E_TEST_USER_EMAIL'] ?? 'test@example.com',
      'password' => $_ENV['E2E_TEST_USER_PASSWORD'] ?? 'password123',
    ];
  }

  /**
   * Get admin user credentials
   */
  protected function getAdminCredentials(): array
  {
    return [
      'email' => $_ENV['E2E_ADMIN_EMAIL'] ?? 'admin@example.com',
      'password' => $_ENV['E2E_ADMIN_PASSWORD'] ?? 'admin123',
    ];
  }

  /**
   * Create a test user for the test
   */
  protected function createTestUser(array $userData = []): array
  {
    $defaultUserData = [
      'email' => 'test_' . uniqid() . '@example.com',
      'password' => 'TestPassword123!',
      'firstName' => 'Test',
      'lastName' => 'User',
    ];

    $userData = array_merge($defaultUserData, $userData);

    // This would typically create a user via API or database
    // For now, we'll return the user data
    return $userData;
  }

  /**
   * Clean up test data
   */
  protected function cleanupTestData(): void
  {
    // Override in specific test classes to clean up test data
  }

  /**
   * Set up test data
   */
  protected function setUpTestData(): void
  {
    // Override in specific test classes to set up test data
  }
}
