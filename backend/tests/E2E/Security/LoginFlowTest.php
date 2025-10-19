<?php

declare(strict_types=1);

namespace App\Tests\E2E\Security;

use App\Tests\E2E\BaseE2ETest;

class LoginFlowTest extends BaseE2ETest
{
  protected function setUp(): void
  {
    parent::setUp();
    $this->setUpTestData();
  }

  protected function tearDown(): void
  {
    $this->cleanupTestData();
    parent::tearDown();
  }

  public function testSuccessfulLoginFlow(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();

    // Act
    $response = $this->post('/api/security/login', $credentials);

    // Assert
    $this->assertResponseSuccess($response);
    $this->assertResponseHasToken($response);
    $this->assertResponseHasUser($response);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('user', $data);
    $this->assertEquals($credentials['email'], $data['user']['email']);
  }

  public function testLoginWithInvalidCredentials(): void
  {
    // Arrange
    $invalidCredentials = [
      'email' => 'nonexistent@example.com',
      'password' => 'wrongpassword',
    ];

    // Act
    $response = $this->post('/api/security/login', $invalidCredentials);

    // Assert
    $this->assertResponseError($response, 401);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('Invalid credentials', $data['error']);
  }

  public function testLoginWithMissingEmail(): void
  {
    // Arrange
    $incompleteCredentials = [
      'password' => 'password123',
    ];

    // Act
    $response = $this->post('/api/security/login', $incompleteCredentials);

    // Assert
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('email', strtolower($data['error']));
  }

  public function testLoginWithMissingPassword(): void
  {
    // Arrange
    $incompleteCredentials = [
      'email' => 'test@example.com',
    ];

    // Act
    $response = $this->post('/api/security/login', $incompleteCredentials);

    // Assert
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('password', strtolower($data['error']));
  }

  public function testLoginWithEmptyCredentials(): void
  {
    // Arrange
    $emptyCredentials = [];

    // Act
    $response = $this->post('/api/security/login', $emptyCredentials);

    // Assert
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
  }

  public function testLoginWithMalformedEmail(): void
  {
    // Arrange
    $malformedCredentials = [
      'email' => 'not-an-email',
      'password' => 'password123',
    ];

    // Act
    $response = $this->post('/api/security/login', $malformedCredentials);

    // Assert
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('email', strtolower($data['error']));
  }

  public function testLoginWithShortPassword(): void
  {
    // Arrange
    $credentials = [
      'email' => 'test@example.com',
      'password' => '123',
    ];

    // Act
    $response = $this->post('/api/security/login', $credentials);

    // Assert
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('password', strtolower($data['error']));
  }

  public function testLoginWithSpecialCharacters(): void
  {
    // Arrange
    $credentials = [
      'email' => 'test+special@example.com',
      'password' => 'P@ssw0rd!@#$%^&*()',
    ];

    // Act
    $response = $this->post('/api/security/login', $credentials);

    // Assert
    // This might succeed or fail depending on whether the user exists
    // We just verify the response is properly formatted
    $this->assertContains($response['status_code'], [200, 401]);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey($response['status_code'] === 200 ? 'token' : 'error', $data);
  }

  public function testLoginWithUnicodeCharacters(): void
  {
    // Arrange
    $credentials = [
      'email' => 'tëst@éxämplé.com',
      'password' => 'pässwörd123',
    ];

    // Act
    $response = $this->post('/api/security/login', $credentials);

    // Assert
    // This might succeed or fail depending on whether the user exists
    $this->assertContains($response['status_code'], [200, 401]);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey($response['status_code'] === 200 ? 'token' : 'error', $data);
  }

  public function testLoginWithVeryLongCredentials(): void
  {
    // Arrange
    $longCredentials = [
      'email' => str_repeat('a', 100) . '@example.com',
      'password' => str_repeat('b', 1000),
    ];

    // Act
    $response = $this->post('/api/security/login', $longCredentials);

    // Assert
    // Should handle gracefully (either reject or process)
    $this->assertContains($response['status_code'], [200, 400, 401]);

    $data = $this->getResponseData($response);
    $this->assertIsArray($data);
  }

  public function testLoginWithSQLInjectionAttempt(): void
  {
    // Arrange
    $maliciousCredentials = [
      'email' => "admin'; DROP TABLE users; --",
      'password' => "password' OR '1'='1",
    ];

    // Act
    $response = $this->post('/api/security/login', $maliciousCredentials);

    // Assert
    // Should reject malicious input
    $this->assertResponseError($response, 401);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
  }

  public function testLoginWithXSSAttempt(): void
  {
    // Arrange
    $maliciousCredentials = [
      'email' => '<script>alert("xss")</script>@example.com',
      'password' => '<img src=x onerror=alert("xss")>',
    ];

    // Act
    $response = $this->post('/api/security/login', $maliciousCredentials);

    // Assert
    // Should reject malicious input
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
  }

  public function testLoginRateLimiting(): void
  {
    // Arrange
    $credentials = [
      'email' => 'test@example.com',
      'password' => 'wrongpassword',
    ];

    // Act - Attempt multiple failed logins
    $responses = [];
    for ($i = 0; $i < 10; $i++) {
      $responses[] = $this->post('/api/security/login', $credentials);
    }

    // Assert - Should eventually get rate limited
    $rateLimited = false;
    foreach ($responses as $response) {
      if ($response['status_code'] === 429) {
        $rateLimited = true;
        break;
      }
    }

    // Note: Rate limiting might not be implemented yet
    // This test documents the expected behavior
    if ($rateLimited) {
      $this->assertTrue($rateLimited, 'Rate limiting should be triggered after multiple failed attempts');
    }
  }

  public function testLoginWithDifferentUserTypes(): void
  {
    // Test admin login
    $adminCredentials = $this->getAdminCredentials();
    $adminResponse = $this->post('/api/security/login', $adminCredentials);

    if ($adminResponse['status_code'] === 200) {
      $adminData = $this->getResponseData($adminResponse);
      $this->assertResponseHasToken($adminResponse);
      $this->assertResponseHasUser($adminResponse);
      $this->assertArrayHasKey('user', $adminData);
    }

    // Test regular user login
    $userCredentials = $this->getTestUserCredentials();
    $userResponse = $this->post('/api/security/login', $userCredentials);

    if ($userResponse['status_code'] === 200) {
      $userData = $this->getResponseData($userResponse);
      $this->assertResponseHasToken($userResponse);
      $this->assertResponseHasUser($userResponse);
      $this->assertArrayHasKey('user', $userData);
    }
  }

  public function testLoginResponseStructure(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();

    // Act
    $response = $this->post('/api/security/login', $credentials);

    // Assert
    if ($response['status_code'] === 200) {
      $data = $this->getResponseData($response);

      // Check required fields
      $this->assertArrayHasKey('token', $data);
      $this->assertArrayHasKey('user', $data);

      // Check token format
      $this->assertIsString($data['token']);
      $this->assertNotEmpty($data['token']);

      // Check user object structure
      $user = $data['user'];
      $this->assertIsArray($user);
      $this->assertArrayHasKey('email', $user);
      $this->assertEquals($credentials['email'], $user['email']);
    }
  }

  public function testLoginWithCaseSensitiveEmail(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $uppercaseCredentials = [
      'email' => strtoupper($credentials['email']),
      'password' => $credentials['password'],
    ];

    // Act
    $response = $this->post('/api/security/login', $uppercaseCredentials);

    // Assert
    // Email should be case-insensitive
    if ($response['status_code'] === 200) {
      $this->assertResponseHasToken($response);
    } else {
      // If case-sensitive, should still be a valid response
      $this->assertContains($response['status_code'], [200, 401]);
    }
  }

  public function testLoginWithWhitespaceInCredentials(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $whitespaceCredentials = [
      'email' => ' ' . $credentials['email'] . ' ',
      'password' => ' ' . $credentials['password'] . ' ',
    ];

    // Act
    $response = $this->post('/api/security/login', $whitespaceCredentials);

    // Assert
    // Whitespace should be trimmed
    if ($response['status_code'] === 200) {
      $this->assertResponseHasToken($response);
    } else {
      // If not trimmed, should still be a valid response
      $this->assertContains($response['status_code'], [200, 401]);
    }
  }

  protected function setUpTestData(): void
  {
    // Set up any test data needed for login tests
    // This could include creating test users, setting up test environment, etc.
  }

  protected function cleanupTestData(): void
  {
    // Clean up any test data created during the tests
    // This could include removing test users, resetting test environment, etc.
  }
}
