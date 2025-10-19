<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Hydrator;

use App\Infrastructure\Service\Hydrator\SecurityHydrator;
use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Input\Security\ResetPasswordFromPKUserInputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;

class SecurityHydratorTest extends BaseHydratorTest
{
  private SecurityHydrator $hydrator;

  protected function setUp(): void
  {
    $this->hydrator = new SecurityHydrator();
  }

  public function testHydrateLogin(): void
  {
    // Arrange
    $inputDto = new LoginInputDto('test_user', 'test_password');

    // Act
    $result = $this->hydrator->hydrateLogin($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'LoginID' => 'test_user',
      'Password' => 'test_password'
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateResetPasswordFromPKUser(): void
  {
    // Arrange
    $inputDto = new ResetPasswordFromPKUserInputDto(123);

    // Act
    $result = $this->hydrator->hydrateResetPasswordFromPKUser($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PKUser' => 123
    ]);
    $this->assertHydratedObjectPropertyCount($result, 1);
  }

  public function testHydrateUpdatePassword(): void
  {
    // Arrange
    $inputDto = new UpdatePasswordInputDto('123', 'new_password');

    // Act
    $result = $this->hydrator->hydrateUpdatePassword($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkUserChild' => 123,
      'Password' => 'new_password'
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateLoginFromParam(): void
  {
    // Arrange
    $inputDto = new LoginFromParamInputDto('test_user', 'test_password', 'test_param');

    // Act
    $result = $this->hydrator->hydrateLoginFromParam($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'LoginID' => 'test_user',
      'Password' => 'test_password',
      'Param' => 'test_param'
    ]);
    $this->assertHydratedObjectPropertyCount($result, 3);
  }

  public function testHydrateResetPassword(): void
  {
    // Arrange
    $inputDto = new ResetPasswordInputDto('test@example.com');

    // Act
    $result = $this->hydrator->hydrateResetPassword($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'Email' => 'test@example.com'
    ]);
    $this->assertHydratedObjectPropertyCount($result, 1);
  }

  public function testHydrateLoginWithDifferentCredentials(): void
  {
    // Arrange
    $inputDto1 = new LoginInputDto('user1', 'password1');
    $inputDto2 = new LoginInputDto('user2', 'password2');
    $inputDto3 = new LoginInputDto('admin', 'admin123');

    // Act
    $result1 = $this->hydrator->hydrateLogin($inputDto1);
    $result2 = $this->hydrator->hydrateLogin($inputDto2);
    $result3 = $this->hydrator->hydrateLogin($inputDto3);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, [
      'LoginID' => 'user1',
      'Password' => 'password1'
    ]);
    $this->assertHydratedObjectHasProperties($result2, [
      'LoginID' => 'user2',
      'Password' => 'password2'
    ]);
    $this->assertHydratedObjectHasProperties($result3, [
      'LoginID' => 'admin',
      'Password' => 'admin123'
    ]);
  }

  public function testHydrateResetPasswordFromPKUserWithDifferentUsers(): void
  {
    // Arrange
    $inputDto1 = new ResetPasswordFromPKUserInputDto(123);
    $inputDto2 = new ResetPasswordFromPKUserInputDto(456);
    $inputDto3 = new ResetPasswordFromPKUserInputDto(789);

    // Act
    $result1 = $this->hydrator->hydrateResetPasswordFromPKUser($inputDto1);
    $result2 = $this->hydrator->hydrateResetPasswordFromPKUser($inputDto2);
    $result3 = $this->hydrator->hydrateResetPasswordFromPKUser($inputDto3);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, ['PKUser' => 123]);
    $this->assertHydratedObjectHasProperties($result2, ['PKUser' => 456]);
    $this->assertHydratedObjectHasProperties($result3, ['PKUser' => 789]);
  }

  public function testHydrateUpdatePasswordWithDifferentUsers(): void
  {
    // Arrange
    $inputDto1 = new UpdatePasswordInputDto('123', 'password1');
    $inputDto2 = new UpdatePasswordInputDto('456', 'password2');
    $inputDto3 = new UpdatePasswordInputDto('789', 'password3');

    // Act
    $result1 = $this->hydrator->hydrateUpdatePassword($inputDto1);
    $result2 = $this->hydrator->hydrateUpdatePassword($inputDto2);
    $result3 = $this->hydrator->hydrateUpdatePassword($inputDto3);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, [
      'PkUserChild' => 123,
      'Password' => 'password1'
    ]);
    $this->assertHydratedObjectHasProperties($result2, [
      'PkUserChild' => 456,
      'Password' => 'password2'
    ]);
    $this->assertHydratedObjectHasProperties($result3, [
      'PkUserChild' => 789,
      'Password' => 'password3'
    ]);
  }

  public function testHydrateLoginFromParamWithDifferentParams(): void
  {
    // Arrange
    $inputDto1 = new LoginFromParamInputDto('user1', 'pass1', 'param1');
    $inputDto2 = new LoginFromParamInputDto('user2', 'pass2', 'param2');
    $inputDto3 = new LoginFromParamInputDto('admin', 'admin123', 'admin_param');

    // Act
    $result1 = $this->hydrator->hydrateLoginFromParam($inputDto1);
    $result2 = $this->hydrator->hydrateLoginFromParam($inputDto2);
    $result3 = $this->hydrator->hydrateLoginFromParam($inputDto3);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, [
      'LoginID' => 'user1',
      'Password' => 'pass1',
      'Param' => 'param1'
    ]);
    $this->assertHydratedObjectHasProperties($result2, [
      'LoginID' => 'user2',
      'Password' => 'pass2',
      'Param' => 'param2'
    ]);
    $this->assertHydratedObjectHasProperties($result3, [
      'LoginID' => 'admin',
      'Password' => 'admin123',
      'Param' => 'admin_param'
    ]);
  }

  public function testHydrateResetPasswordWithDifferentEmails(): void
  {
    // Arrange
    $inputDto1 = new ResetPasswordInputDto('user1@example.com');
    $inputDto2 = new ResetPasswordInputDto('user2@example.com');
    $inputDto3 = new ResetPasswordInputDto('admin@example.com');

    // Act
    $result1 = $this->hydrator->hydrateResetPassword($inputDto1);
    $result2 = $this->hydrator->hydrateResetPassword($inputDto2);
    $result3 = $this->hydrator->hydrateResetPassword($inputDto3);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, ['Email' => 'user1@example.com']);
    $this->assertHydratedObjectHasProperties($result2, ['Email' => 'user2@example.com']);
    $this->assertHydratedObjectHasProperties($result3, ['Email' => 'admin@example.com']);
  }

  public function testAllMethodsReturnObjects(): void
  {
    // Arrange
    $loginInput = new LoginInputDto('test_user', 'test_password');
    $resetPKInput = new ResetPasswordFromPKUserInputDto(123);
    $updateInput = new UpdatePasswordInputDto('123', 'new_password');
    $loginParamInput = new LoginFromParamInputDto('test_user', 'test_password', 'test_param');
    $resetInput = new ResetPasswordInputDto('test@example.com');

    // Act & Assert
    $this->assertIsObject($this->hydrator->hydrateLogin($loginInput));
    $this->assertIsObject($this->hydrator->hydrateResetPasswordFromPKUser($resetPKInput));
    $this->assertIsObject($this->hydrator->hydrateUpdatePassword($updateInput));
    $this->assertIsObject($this->hydrator->hydrateLoginFromParam($loginParamInput));
    $this->assertIsObject($this->hydrator->hydrateResetPassword($resetInput));
  }

  public function testHydratedObjectsAreConsistent(): void
  {
    // Arrange
    $inputDto = new LoginInputDto('test_user', 'test_password');

    // Act
    $result1 = $this->hydrator->hydrateLogin($inputDto);
    $result2 = $this->hydrator->hydrateLogin($inputDto);

    // Assert
    $this->assertEquals($result1, $result2);
  }

  public function testHydratedObjectsHaveCorrectPropertyTypes(): void
  {
    // Arrange
    $loginInput = new LoginInputDto('test_user', 'test_password');
    $resetPKInput = new ResetPasswordFromPKUserInputDto(123);
    $updateInput = new UpdatePasswordInputDto('123', 'new_password');
    $loginParamInput = new LoginFromParamInputDto('test_user', 'test_password', 'test_param');
    $resetInput = new ResetPasswordInputDto('test@example.com');

    // Act
    $loginResult = $this->hydrator->hydrateLogin($loginInput);
    $resetPKResult = $this->hydrator->hydrateResetPasswordFromPKUser($resetPKInput);
    $updateResult = $this->hydrator->hydrateUpdatePassword($updateInput);
    $loginParamResult = $this->hydrator->hydrateLoginFromParam($loginParamInput);
    $resetResult = $this->hydrator->hydrateResetPassword($resetInput);

    // Assert
    $this->assertHydratedObjectPropertyTypes($loginResult, [
      'LoginID' => 'string',
      'Password' => 'string'
    ]);
    $this->assertHydratedObjectPropertyTypes($resetPKResult, [
      'PKUser' => 'int'
    ]);
    $this->assertHydratedObjectPropertyTypes($updateResult, [
      'PkUserChild' => 'string',
      'Password' => 'string'
    ]);
    $this->assertHydratedObjectPropertyTypes($loginParamResult, [
      'LoginID' => 'string',
      'Password' => 'string',
      'Param' => 'string'
    ]);
    $this->assertHydratedObjectPropertyTypes($resetResult, [
      'Email' => 'string'
    ]);
  }

  public function testMethodsReturnStdClassObjects(): void
  {
    // Arrange
    $inputDto = new LoginInputDto('test_user', 'test_password');

    // Act
    $result = $this->hydrator->hydrateLogin($inputDto);

    // Assert
    $this->assertInstanceOf(\stdClass::class, $result);
  }
}
