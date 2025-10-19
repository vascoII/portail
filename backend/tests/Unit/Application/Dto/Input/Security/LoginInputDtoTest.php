<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Dto\Input\Security;

use App\Application\Dto\Input\Security\LoginInputDto;
use App\Tests\Unit\Application\Dto\BaseDtoTest;

class LoginInputDtoTest extends BaseDtoTest
{
  public function testConstructorSetsUsernameAndPassword(): void
  {
    // Arrange
    $testData = $this->getTestData('login');

    // Act
    $dto = new LoginInputDto($testData['username'], $testData['password']);

    // Assert
    $this->assertDtoProperties($dto, $testData);
  }

  public function testDtoHasExpectedProperties(): void
  {
    // Arrange
    $dto = new LoginInputDto('', '');

    // Assert
    $this->assertDtoHasProperties($dto, ['username', 'password']);
  }

  public function testDtoPropertiesAreReadonly(): void
  {
    // Arrange
    $dto = new LoginInputDto('', '');

    // Assert
    $this->assertDtoPropertiesAreReadonly($dto);
  }

  public function testDtoIsImmutable(): void
  {
    // Arrange
    $dto = new LoginInputDto('', '');

    // Assert
    $this->assertDtoIsImmutable($dto);
  }

  public function testConstructorRequiresUsernameAndPassword(): void
  {
    // Assert
    $this->assertDtoConstructorRequiresAllParameters(LoginInputDto::class, ['username', 'password']);
  }

  public function testWithEmailAsUsername(): void
  {
    // Arrange
    $username = 'user@example.com';
    $password = 'securePassword123';

    // Act
    $dto = new LoginInputDto($username, $password);

    // Assert
    $this->assertEquals($username, $dto->username);
    $this->assertEquals($password, $dto->password);
  }

  public function testWithUsernameAsUsername(): void
  {
    // Arrange
    $username = 'johndoe';
    $password = 'mySecretPassword';

    // Act
    $dto = new LoginInputDto($username, $password);

    // Assert
    $this->assertEquals($username, $dto->username);
    $this->assertEquals($password, $dto->password);
  }

  public function testWithEmptyCredentials(): void
  {
    // Arrange & Act
    $dto = new LoginInputDto('', '');

    // Assert
    $this->assertEquals('', $dto->username);
    $this->assertEquals('', $dto->password);
  }

  public function testWithSpecialCharacters(): void
  {
    // Arrange
    $username = 'user+test@example.com';
    $password = 'P@ssw0rd!@#$%^&*()';

    // Act
    $dto = new LoginInputDto($username, $password);

    // Assert
    $this->assertEquals($username, $dto->username);
    $this->assertEquals($password, $dto->password);
  }

  public function testDtoIsFinalClass(): void
  {
    // Assert
    $reflection = new \ReflectionClass(LoginInputDto::class);
    $this->assertTrue($reflection->isFinal(), 'LoginInputDto should be final');
  }
}
