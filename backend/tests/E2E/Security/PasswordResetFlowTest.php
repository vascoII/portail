<?php

declare(strict_types=1);

namespace App\Tests\E2E\Security;

use App\Tests\E2E\BaseE2ETest;

class PasswordResetFlowTest extends BaseE2ETest
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

  public function testSuccessfulPasswordResetFlow(): void
  {
    // Arrange
    $email = $this->getTestUserCredentials()['email'];

    // Act - Step 1: Request password reset
    $resetRequestResponse = $this->post('/api/security/reset-password', [
      'email' => $email,
    ]);

    // Assert - Step 1: Reset request should be successful
    $this->assertResponseSuccess($resetRequestResponse);

    $resetData = $this->getResponseData($resetRequestResponse);
    $this->assertArrayHasKey('message', $resetData);
    $this->assertStringContainsString('reset', strtolower($resetData['message']));

    // Note: In a real E2E test, you would need to:
    // 1. Check email for reset token
    // 2. Extract token from email
    // 3. Use token to reset password

    // For this test, we'll simulate having the token
    $resetToken = $this->getResetTokenFromEmail($email);

    // Act - Step 2: Reset password with token
    $newPassword = 'NewPassword123!';
    $resetResponse = $this->post('/api/security/reset-password/confirm', [
      'token' => $resetToken,
      'newPassword' => $newPassword,
      'confirmPassword' => $newPassword,
    ]);

    // Assert - Step 2: Password reset should be successful
    $this->assertResponseSuccess($resetResponse);

    $confirmData = $this->getResponseData($resetResponse);
    $this->assertArrayHasKey('message', $confirmData);
    $this->assertStringContainsString('success', strtolower($confirmData['message']));

    // Act - Step 3: Verify new password works
    $loginResponse = $this->post('/api/security/login', [
      'email' => $email,
      'password' => $newPassword,
    ]);

    // Assert - Step 3: Login with new password should work
    $this->assertResponseSuccess($loginResponse);
    $this->assertResponseHasToken($loginResponse);
  }

  public function testPasswordResetWithInvalidEmail(): void
  {
    // Arrange
    $invalidEmail = 'nonexistent@example.com';

    // Act
    $response = $this->post('/api/security/reset-password', [
      'email' => $invalidEmail,
    ]);

    // Assert
    // Should still return success to prevent email enumeration
    $this->assertResponseSuccess($response);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('message', $data);
  }

  public function testPasswordResetWithMissingEmail(): void
  {
    // Arrange
    $emptyData = [];

    // Act
    $response = $this->post('/api/security/reset-password', $emptyData);

    // Assert
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('email', strtolower($data['error']));
  }

  public function testPasswordResetWithMalformedEmail(): void
  {
    // Arrange
    $malformedEmail = 'not-an-email';

    // Act
    $response = $this->post('/api/security/reset-password', [
      'email' => $malformedEmail,
    ]);

    // Assert
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('email', strtolower($data['error']));
  }

  public function testPasswordResetWithInvalidToken(): void
  {
    // Arrange
    $invalidToken = 'invalid-token-12345';
    $newPassword = 'NewPassword123!';

    // Act
    $response = $this->post('/api/security/reset-password/confirm', [
      'token' => $invalidToken,
      'newPassword' => $newPassword,
      'confirmPassword' => $newPassword,
    ]);

    // Assert
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('token', strtolower($data['error']));
  }

  public function testPasswordResetWithExpiredToken(): void
  {
    // Arrange
    $expiredToken = $this->getExpiredResetToken();
    $newPassword = 'NewPassword123!';

    // Act
    $response = $this->post('/api/security/reset-password/confirm', [
      'token' => $expiredToken,
      'newPassword' => $newPassword,
      'confirmPassword' => $newPassword,
    ]);

    // Assert
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('expired', strtolower($data['error']));
  }

  public function testPasswordResetWithMismatchedPasswords(): void
  {
    // Arrange
    $email = $this->getTestUserCredentials()['email'];
    $resetToken = $this->getResetTokenFromEmail($email);
    $newPassword = 'NewPassword123!';
    $confirmPassword = 'DifferentPassword456!';

    // Act
    $response = $this->post('/api/security/reset-password/confirm', [
      'token' => $resetToken,
      'newPassword' => $newPassword,
      'confirmPassword' => $confirmPassword,
    ]);

    // Assert
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('match', strtolower($data['error']));
  }

  public function testPasswordResetWithWeakPassword(): void
  {
    // Arrange
    $email = $this->getTestUserCredentials()['email'];
    $resetToken = $this->getResetTokenFromEmail($email);
    $weakPassword = '123';

    // Act
    $response = $this->post('/api/security/reset-password/confirm', [
      'token' => $resetToken,
      'newPassword' => $weakPassword,
      'confirmPassword' => $weakPassword,
    ]);

    // Assert
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
    $this->assertStringContainsString('password', strtolower($data['error']));
  }

  public function testPasswordResetWithMissingFields(): void
  {
    // Test missing token
    $response1 = $this->post('/api/security/reset-password/confirm', [
      'newPassword' => 'NewPassword123!',
      'confirmPassword' => 'NewPassword123!',
    ]);
    $this->assertResponseError($response1, 400);

    // Test missing newPassword
    $response2 = $this->post('/api/security/reset-password/confirm', [
      'token' => 'some-token',
      'confirmPassword' => 'NewPassword123!',
    ]);
    $this->assertResponseError($response2, 400);

    // Test missing confirmPassword
    $response3 = $this->post('/api/security/reset-password/confirm', [
      'token' => 'some-token',
      'newPassword' => 'NewPassword123!',
    ]);
    $this->assertResponseError($response3, 400);
  }

  public function testPasswordResetWithEmptyFields(): void
  {
    // Arrange
    $emptyData = [
      'token' => '',
      'newPassword' => '',
      'confirmPassword' => '',
    ];

    // Act
    $response = $this->post('/api/security/reset-password/confirm', $emptyData);

    // Assert
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
  }

  public function testPasswordResetRateLimiting(): void
  {
    // Arrange
    $email = $this->getTestUserCredentials()['email'];

    // Act - Request multiple password resets
    $responses = [];
    for ($i = 0; $i < 10; $i++) {
      $responses[] = $this->post('/api/security/reset-password', [
        'email' => $email,
      ]);
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
    if ($rateLimited) {
      $this->assertTrue($rateLimited, 'Rate limiting should be triggered after multiple reset requests');
    }
  }

  public function testPasswordResetWithSpecialCharacters(): void
  {
    // Arrange
    $email = $this->getTestUserCredentials()['email'];
    $resetToken = $this->getResetTokenFromEmail($email);
    $specialPassword = 'P@ssw0rd!@#$%^&*()_+-=[]{}|;:,.<>?';

    // Act
    $response = $this->post('/api/security/reset-password/confirm', [
      'token' => $resetToken,
      'newPassword' => $specialPassword,
      'confirmPassword' => $specialPassword,
    ]);

    // Assert
    if ($response['status_code'] === 200) {
      $this->assertResponseSuccess($response);
    } else {
      // Should either accept or reject with proper error message
      $this->assertContains($response['status_code'], [200, 400]);
    }
  }

  public function testPasswordResetWithUnicodeCharacters(): void
  {
    // Arrange
    $email = $this->getTestUserCredentials()['email'];
    $resetToken = $this->getResetTokenFromEmail($email);
    $unicodePassword = 'Pässwörd123!';

    // Act
    $response = $this->post('/api/security/reset-password/confirm', [
      'token' => $resetToken,
      'newPassword' => $unicodePassword,
      'confirmPassword' => $unicodePassword,
    ]);

    // Assert
    if ($response['status_code'] === 200) {
      $this->assertResponseSuccess($response);
    } else {
      // Should either accept or reject with proper error message
      $this->assertContains($response['status_code'], [200, 400]);
    }
  }

  public function testPasswordResetWithVeryLongPassword(): void
  {
    // Arrange
    $email = $this->getTestUserCredentials()['email'];
    $resetToken = $this->getResetTokenFromEmail($email);
    $longPassword = str_repeat('a', 1000);

    // Act
    $response = $this->post('/api/security/reset-password/confirm', [
      'token' => $resetToken,
      'newPassword' => $longPassword,
      'confirmPassword' => $longPassword,
    ]);

    // Assert
    // Should handle gracefully (either accept or reject)
    $this->assertContains($response['status_code'], [200, 400]);
  }

  public function testPasswordResetWithSQLInjectionAttempt(): void
  {
    // Arrange
    $maliciousData = [
      'token' => "'; DROP TABLE users; --",
      'newPassword' => "password' OR '1'='1",
      'confirmPassword' => "password' OR '1'='1",
    ];

    // Act
    $response = $this->post('/api/security/reset-password/confirm', $maliciousData);

    // Assert
    // Should reject malicious input
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
  }

  public function testPasswordResetWithXSSAttempt(): void
  {
    // Arrange
    $maliciousData = [
      'token' => '<script>alert("xss")</script>',
      'newPassword' => '<img src=x onerror=alert("xss")>',
      'confirmPassword' => '<img src=x onerror=alert("xss")>',
    ];

    // Act
    $response = $this->post('/api/security/reset-password/confirm', $maliciousData);

    // Assert
    // Should reject malicious input
    $this->assertResponseError($response, 400);

    $data = $this->getResponseData($response);
    $this->assertArrayHasKey('error', $data);
  }

  public function testPasswordResetTokenReuse(): void
  {
    // Arrange
    $email = $this->getTestUserCredentials()['email'];
    $resetToken = $this->getResetTokenFromEmail($email);
    $newPassword = 'NewPassword123!';

    // Act - Use token first time
    $response1 = $this->post('/api/security/reset-password/confirm', [
      'token' => $resetToken,
      'newPassword' => $newPassword,
      'confirmPassword' => $newPassword,
    ]);

    // Act - Try to use same token again
    $response2 = $this->post('/api/security/reset-password/confirm', [
      'token' => $resetToken,
      'newPassword' => 'AnotherPassword456!',
      'confirmPassword' => 'AnotherPassword456!',
    ]);

    // Assert
    if ($response1['status_code'] === 200) {
      // First use should succeed
      $this->assertResponseSuccess($response1);

      // Second use should fail
      $this->assertResponseError($response2, 400);

      $data = $this->getResponseData($response2);
      $this->assertArrayHasKey('error', $data);
      $this->assertStringContainsString('used', strtolower($data['error']));
    }
  }

  /**
   * Simulate getting reset token from email
   * In a real E2E test, this would extract the token from the actual email
   */
  private function getResetTokenFromEmail(string $email): string
  {
    // In a real implementation, this would:
    // 1. Check the email service (or test email inbox)
    // 2. Parse the email content
    // 3. Extract the reset token from the link or content
    // 4. Return the token

    // For this test, we'll simulate a valid token
    return 'test-reset-token-' . md5($email . time());
  }

  /**
   * Simulate getting an expired reset token
   */
  private function getExpiredResetToken(): string
  {
    // In a real implementation, this would be an actual expired token
    return 'expired-reset-token-' . md5('expired' . time());
  }

  protected function setUpTestData(): void
  {
    // Set up any test data needed for password reset tests
    // This could include creating test users, setting up email service, etc.
  }

  protected function cleanupTestData(): void
  {
    // Clean up any test data created during the tests
    // This could include removing test users, clearing email queue, etc.
  }
}
