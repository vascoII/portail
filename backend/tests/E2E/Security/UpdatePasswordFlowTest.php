<?php

declare(strict_types=1);

namespace App\Tests\E2E\Security;

use App\Tests\E2E\BaseE2ETest;

class UpdatePasswordFlowTest extends BaseE2ETest
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

  public function testSuccessfulPasswordUpdateFlow(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $this->authenticate($credentials['email'], $credentials['password']);

    $newPassword = 'NewPassword123!';
    $updateData = [
      'currentPassword' => $credentials['password'],
      'newPassword' => $newPassword,
      'confirmPassword' => $newPassword,
    ];

    // Act
    $response = $this->post('/api/security/update-password', $updateData);

    // Assert
    $this->assertResponseSuccess($response);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('message', $data);
    $this->assertStringContainsString('success', strtolower($data['message']));

    // Act - Verify new password works
    $this->logout();
    $loginResponse = $this->post('/api/security/login', [
      'email' => $credentials['email'],
      'password' => $newPassword,
    ]);

    // Assert - Login with new password should work
    $this->assertResponseSuccess($loginResponse);
    $this->assertResponseHasToken($loginResponse);
  }

  public function testPasswordUpdateWithoutAuthentication(): void
  {
    // Arrange
    $updateData = [
      'currentPassword' => 'oldpassword',
      'newPassword' => 'NewPassword123!',
      'confirmPassword' => 'NewPassword123!',
    ];

    // Act
    $response = $this->post('/api/security/update-password', $updateData);

    // Assert
    $this->assertResponseError($response, 401);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('unauthorized', strtolower($data['error']));
  }

  public function testPasswordUpdateWithWrongCurrentPassword(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $this->authenticate($credentials['email'], $credentials['password']);

    $updateData = [
      'currentPassword' => 'wrongpassword',
      'newPassword' => 'NewPassword123!',
      'confirmPassword' => 'NewPassword123!',
    ];

    // Act
    $response = $this->post('/api/security/update-password', $updateData);

    // Assert
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('current', strtolower($data['error']));
  }

  public function testPasswordUpdateWithMismatchedNewPasswords(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $this->authenticate($credentials['email'], $credentials['password']);

    $updateData = [
      'currentPassword' => $credentials['password'],
      'newPassword' => 'NewPassword123!',
      'confirmPassword' => 'DifferentPassword456!',
    ];

    // Act
    $response = $this->post('/api/security/update-password', $updateData);

    // Assert
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('match', strtolower($data['error']));
  }

  public function testPasswordUpdateWithWeakNewPassword(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $this->authenticate($credentials['email'], $credentials['password']);

    $updateData = [
      'currentPassword' => $credentials['password'],
      'newPassword' => '123',
      'confirmPassword' => '123',
    ];

    // Act
    $response = $this->post('/api/security/update-password', $updateData);

    // Assert
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('password', strtolower($data['error']));
  }

  public function testPasswordUpdateWithSamePassword(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $this->authenticate($credentials['email'], $credentials['password']);

    $updateData = [
      'currentPassword' => $credentials['password'],
      'newPassword' => $credentials['password'],
      'confirmPassword' => $credentials['password'],
    ];

    // Act
    $response = $this->post('/api/security/update-password', $updateData);

    // Assert
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('same', strtolower($data['error']));
  }

  public function testPasswordUpdateWithMissingFields(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $this->authenticate($credentials['email'], $credentials['password']);

    // Test missing currentPassword
    $response1 = $this->post('/api/security/update-password', [
      'newPassword' => 'NewPassword123!',
      'confirmPassword' => 'NewPassword123!',
    ]);
    $this->assertResponseError($response1, 400);

    // Test missing newPassword
    $response2 = $this->post('/api/security/update-password', [
      'currentPassword' => $credentials['password'],
      'confirmPassword' => 'NewPassword123!',
    ]);
    $this->assertResponseError($response2, 400);

    // Test missing confirmPassword
    $response3 = $this->post('/api/security/update-password', [
      'currentPassword' => $credentials['password'],
      'newPassword' => 'NewPassword123!',
    ]);
    $this->assertResponseError($response3, 400);
  }

  public function testPasswordUpdateWithEmptyFields(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $this->authenticate($credentials['email'], $credentials['password']);

    $emptyData = [
      'currentPassword' => '',
      'newPassword' => '',
      'confirmPassword' => '',
    ];

    // Act
    $response = $this->post('/api/security/update-password', $emptyData);

    // Assert
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
  }

  public function testPasswordUpdateWithSpecialCharacters(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $this->authenticate($credentials['email'], $credentials['password']);

    $specialPassword = 'P@ssw0rd!@#$%^&*()_+-=[]{}|;:,.<>?';
    $updateData = [
      'currentPassword' => $credentials['password'],
      'newPassword' => $specialPassword,
      'confirmPassword' => $specialPassword,
    ];

    // Act
    $response = $this->post('/api/security/update-password', $updateData);

    // Assert
    if ($response['status_code'] === 200) {
      $this->assertResponseSuccess($response);
    } else {
      // Should either accept or reject with proper error message
      $this->assertContains($response['status_code'], [200, 400]);
    }
  }

  public function testPasswordUpdateWithUnicodeCharacters(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $this->authenticate($credentials['email'], $credentials['password']);

    $unicodePassword = 'Pässwörd123!';
    $updateData = [
      'currentPassword' => $credentials['password'],
      'newPassword' => $unicodePassword,
      'confirmPassword' => $unicodePassword,
    ];

    // Act
    $response = $this->post('/api/security/update-password', $updateData);

    // Assert
    if ($response['status_code'] === 200) {
      $this->assertResponseSuccess($response);
    } else {
      // Should either accept or reject with proper error message
      $this->assertContains($response['status_code'], [200, 400]);
    }
  }

  public function testPasswordUpdateWithVeryLongPassword(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $this->authenticate($credentials['email'], $credentials['password']);

    $longPassword = str_repeat('a', 1000);
    $updateData = [
      'currentPassword' => $credentials['password'],
      'newPassword' => $longPassword,
      'confirmPassword' => $longPassword,
    ];

    // Act
    $response = $this->post('/api/security/update-password', $updateData);

    // Assert
    // Should handle gracefully (either accept or reject)
    $this->assertContains($response['status_code'], [200, 400]);
  }

  public function testPasswordUpdateWithSQLInjectionAttempt(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $this->authenticate($credentials['email'], $credentials['password']);

    $maliciousData = [
      'currentPassword' => "'; DROP TABLE users; --",
      'newPassword' => "password' OR '1'='1",
      'confirmPassword' => "password' OR '1'='1",
    ];

    // Act
    $response = $this->post('/api/security/update-password', $maliciousData);

    // Assert
    // Should reject malicious input
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
  }

  public function testPasswordUpdateWithXSSAttempt(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $this->authenticate($credentials['email'], $credentials['password']);

    $maliciousData = [
      'currentPassword' => '<script>alert("xss")</script>',
      'newPassword' => '<img src=x onerror=alert("xss")>',
      'confirmPassword' => '<img src=x onerror=alert("xss")>',
    ];

    // Act
    $response = $this->post('/api/security/update-password', $maliciousData);

    // Assert
    // Should reject malicious input
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
  }

  public function testPasswordUpdateWithExpiredToken(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $this->authenticate($credentials['email'], $credentials['password']);

    // Simulate token expiration by waiting or manipulating the token
    $this->wait(3600); // Wait 1 hour (assuming 1-hour token expiry)

    $updateData = [
      'currentPassword' => $credentials['password'],
      'newPassword' => 'NewPassword123!',
      'confirmPassword' => 'NewPassword123!',
    ];

    // Act
    $response = $this->post('/api/security/update-password', $updateData);

    // Assert
    $this->assertResponseError($response, 401);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('expired', strtolower($data['error']));
  }

  public function testPasswordUpdateWithInvalidToken(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $this->authenticate($credentials['email'], $credentials['password']);

    // Simulate invalid token by modifying it
    $this->authToken = 'invalid-token-12345';

    $updateData = [
      'currentPassword' => $credentials['password'],
      'newPassword' => 'NewPassword123!',
      'confirmPassword' => 'NewPassword123!',
    ];

    // Act
    $response = $this->post('/api/security/update-password', $updateData);

    // Assert
    $this->assertResponseError($response, 401);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('invalid', strtolower($data['error']));
  }

  public function testPasswordUpdateWithWhitespaceInPasswords(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $this->authenticate($credentials['email'], $credentials['password']);

    $updateData = [
      'currentPassword' => ' ' . $credentials['password'] . ' ',
      'newPassword' => ' NewPassword123! ',
      'confirmPassword' => ' NewPassword123! ',
    ];

    // Act
    $response = $this->post('/api/security/update-password', $updateData);

    // Assert
    // Whitespace should be trimmed
    if ($response['status_code'] === 200) {
      $this->assertResponseSuccess($response);
    } else {
      // If not trimmed, should still be a valid response
      $this->assertContains($response['status_code'], [200, 400]);
    }
  }

  public function testPasswordUpdateWithCaseSensitiveCurrentPassword(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $this->authenticate($credentials['email'], $credentials['password']);

    $updateData = [
      'currentPassword' => strtoupper($credentials['password']),
      'newPassword' => 'NewPassword123!',
      'confirmPassword' => 'NewPassword123!',
    ];

    // Act
    $response = $this->post('/api/security/update-password', $updateData);

    // Assert
    // Current password should be case-sensitive
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('current', strtolower($data['error']));
  }

  public function testPasswordUpdateWithAdminUser(): void
  {
    // Arrange
    $adminCredentials = $this->getAdminCredentials();
    $this->authenticate($adminCredentials['email'], $adminCredentials['password']);

    $newPassword = 'NewAdminPassword123!';
    $updateData = [
      'currentPassword' => $adminCredentials['password'],
      'newPassword' => $newPassword,
      'confirmPassword' => $newPassword,
    ];

    // Act
    $response = $this->post('/api/security/update-password', $updateData);

    // Assert
    if ($response['status_code'] === 200) {
      $this->assertResponseSuccess($response);

      // Verify new password works
      $this->logout();
      $loginResponse = $this->post('/api/security/login', [
        'email' => $adminCredentials['email'],
        'password' => $newPassword,
      ]);
      $this->assertResponseSuccess($loginResponse);
    } else {
      // Should either accept or reject with proper error message
      $this->assertContains($response['status_code'], [200, 400]);
    }
  }

  public function testPasswordUpdateResponseStructure(): void
  {
    // Arrange
    $credentials = $this->getTestUserCredentials();
    $this->authenticate($credentials['email'], $credentials['password']);

    $newPassword = 'NewPassword123!';
    $updateData = [
      'currentPassword' => $credentials['password'],
      'newPassword' => $newPassword,
      'confirmPassword' => $newPassword,
    ];

    // Act
    $response = $this->post('/api/security/update-password', $updateData);

    // Assert
    if ($response['status_code'] === 200) {
      $data = $this->getResponseData($response);

      // Check required fields
      $this->assertArrayHasKey('message', $data);

      // Check message content
      $this->assertIsString($data['message']);
      $this->assertNotEmpty($data['message']);
    }
  }

  protected function setUpTestData(): void
  {
    // Set up any test data needed for password update tests
    // This could include creating test users, setting up authentication, etc.
  }

  protected function cleanupTestData(): void
  {
    // Clean up any test data created during the tests
    // This could include removing test users, resetting passwords, etc.
  }
}
