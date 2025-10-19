<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Hydrator;

use App\Infrastructure\Service\Hydrator\AdminHydrator;
use App\Application\Dto\Input\Admin\LoginFromParamInputDto;
use App\Application\Dto\Input\Admin\ResetPasswordFromEmailInputDto;
use App\Application\Dto\Input\Admin\UpdateEmailFromPKUserInputDto;
use App\Application\Dto\Input\Admin\UpdateCGUFromPKUserInputDto;

class AdminHydratorTest extends BaseHydratorTest
{
  private AdminHydrator $hydrator;
  private string $superLoginID;
  private string $superPassword;
  private string $adminSessionId;

  protected function setUp(): void
  {
    $this->superLoginID = 'super_admin';
    $this->superPassword = 'super_password';
    $this->adminSessionId = 'admin_session_123';
    $this->hydrator = new AdminHydrator(
      $this->superLoginID,
      $this->superPassword,
      $this->adminSessionId
    );
  }

  public function testHydrateLoginFromParam(): void
  {
    // Arrange
    $inputDto = new LoginFromParamInputDto('test_param');

    // Act
    $result = $this->hydrator->hydrateLoginFromParam($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'SuperLoginID' => $this->superLoginID,
      'SuperPassword' => $this->superPassword,
      'Param' => 'test_param'
    ]);
    $this->assertHydratedObjectPropertyCount($result, 3);
  }

  public function testHydrateResetPasswordFromEmail(): void
  {
    // Arrange
    $inputDto = new ResetPasswordFromEmailInputDto(123);

    // Act
    $result = $this->hydrator->hydrateResetPasswordFromEmail($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'SessionID' => $this->adminSessionId,
      'PkUser' => -1,
      'Email' => 123
    ]);
    $this->assertHydratedObjectPropertyCount($result, 3);
  }

  public function testHydrateUpdateEmailFromPKUser(): void
  {
    // Arrange
    $inputDto = new UpdateEmailFromPKUserInputDto(123, 'new@example.com');

    // Act
    $result = $this->hydrator->hydrateUpdateEmailFromPKUser($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'SuperLoginID' => $this->superLoginID,
      'SuperPassword' => $this->superPassword,
      'PKUser' => 123,
      'Email' => 'new@example.com'
    ]);
    $this->assertHydratedObjectPropertyCount($result, 4);
  }

  public function testHydrateUpdateCGUFromPKUser(): void
  {
    // Arrange
    $inputDto = new UpdateCGUFromPKUserInputDto(123, 'accepted');

    // Act
    $result = $this->hydrator->hydrateUpdateCGUFromPKUser($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'SuperLoginID' => $this->superLoginID,
      'SuperPassword' => $this->superPassword,
      'PKUser' => 123,
      'CGU' => 'accepted'
    ]);
    $this->assertHydratedObjectPropertyCount($result, 4);
  }

  public function testHydrateGetSousTraitants(): void
  {
    // Act
    $result = $this->hydrator->hydrateGetSousTraitants();

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'SuperLoginID' => $this->superLoginID,
      'SuperPassword' => $this->superPassword
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateLoginFromParamWithDifferentParams(): void
  {
    // Arrange
    $inputDto1 = new LoginFromParamInputDto('param1');
    $inputDto2 = new LoginFromParamInputDto('param2');

    // Act
    $result1 = $this->hydrator->hydrateLoginFromParam($inputDto1);
    $result2 = $this->hydrator->hydrateLoginFromParam($inputDto2);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, [
      'SuperLoginID' => $this->superLoginID,
      'SuperPassword' => $this->superPassword,
      'Param' => 'param1'
    ]);
    $this->assertHydratedObjectHasProperties($result2, [
      'SuperLoginID' => $this->superLoginID,
      'SuperPassword' => $this->superPassword,
      'Param' => 'param2'
    ]);
  }

  public function testHydrateResetPasswordFromEmailWithDifferentEmails(): void
  {
    // Arrange
    $inputDto1 = new ResetPasswordFromEmailInputDto(111);
    $inputDto2 = new ResetPasswordFromEmailInputDto(222);

    // Act
    $result1 = $this->hydrator->hydrateResetPasswordFromEmail($inputDto1);
    $result2 = $this->hydrator->hydrateResetPasswordFromEmail($inputDto2);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, [
      'SessionID' => $this->adminSessionId,
      'PkUser' => -1,
      'Email' => 111
    ]);
    $this->assertHydratedObjectHasProperties($result2, [
      'SessionID' => $this->adminSessionId,
      'PkUser' => -1,
      'Email' => 222
    ]);
  }

  public function testHydrateUpdateEmailFromPKUserWithDifferentUsers(): void
  {
    // Arrange
    $inputDto1 = new UpdateEmailFromPKUserInputDto(123, 'user1@example.com');
    $inputDto2 = new UpdateEmailFromPKUserInputDto(456, 'user2@example.com');

    // Act
    $result1 = $this->hydrator->hydrateUpdateEmailFromPKUser($inputDto1);
    $result2 = $this->hydrator->hydrateUpdateEmailFromPKUser($inputDto2);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, [
      'SuperLoginID' => $this->superLoginID,
      'SuperPassword' => $this->superPassword,
      'PKUser' => 123,
      'Email' => 'user1@example.com'
    ]);
    $this->assertHydratedObjectHasProperties($result2, [
      'SuperLoginID' => $this->superLoginID,
      'SuperPassword' => $this->superPassword,
      'PKUser' => 456,
      'Email' => 'user2@example.com'
    ]);
  }

  public function testHydrateUpdateCGUFromPKUserWithDifferentUsers(): void
  {
    // Arrange
    $inputDto1 = new UpdateCGUFromPKUserInputDto(123, 'accepted');
    $inputDto2 = new UpdateCGUFromPKUserInputDto(456, 'pending');

    // Act
    $result1 = $this->hydrator->hydrateUpdateCGUFromPKUser($inputDto1);
    $result2 = $this->hydrator->hydrateUpdateCGUFromPKUser($inputDto2);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, [
      'SuperLoginID' => $this->superLoginID,
      'SuperPassword' => $this->superPassword,
      'PKUser' => 123,
      'CGU' => 'accepted'
    ]);
    $this->assertHydratedObjectHasProperties($result2, [
      'SuperLoginID' => $this->superLoginID,
      'SuperPassword' => $this->superPassword,
      'PKUser' => 456,
      'CGU' => 'pending'
    ]);
  }

  public function testAllMethodsReturnObjects(): void
  {
    // Arrange
    $loginInput = new LoginFromParamInputDto('test_param');
    $resetInput = new ResetPasswordFromEmailInputDto(999);
    $updateEmailInput = new UpdateEmailFromPKUserInputDto(123, 'test@example.com');
    $updateCGUInput = new UpdateCGUFromPKUserInputDto(123, 'accepted');

    // Act & Assert
    $this->assertIsObject($this->hydrator->hydrateLoginFromParam($loginInput));
    $this->assertIsObject($this->hydrator->hydrateResetPasswordFromEmail($resetInput));
    $this->assertIsObject($this->hydrator->hydrateUpdateEmailFromPKUser($updateEmailInput));
    $this->assertIsObject($this->hydrator->hydrateUpdateCGUFromPKUser($updateCGUInput));
    $this->assertIsObject($this->hydrator->hydrateGetSousTraitants());
  }

  public function testHydratedObjectsAreConsistent(): void
  {
    // Arrange
    $inputDto = new LoginFromParamInputDto('test_param');

    // Act
    $result1 = $this->hydrator->hydrateLoginFromParam($inputDto);
    $result2 = $this->hydrator->hydrateLoginFromParam($inputDto);

    // Assert
    $this->assertEquals($result1, $result2);
  }

  public function testHydratedObjectsContainSuperCredentials(): void
  {
    // Arrange
    $inputDto = new LoginFromParamInputDto('test_param');

    // Act
    $result = $this->hydrator->hydrateLoginFromParam($inputDto);

    // Assert
    $this->assertHydratedObjectContainsValues($result, [
      $this->superLoginID,
      $this->superPassword
    ]);
  }
}
