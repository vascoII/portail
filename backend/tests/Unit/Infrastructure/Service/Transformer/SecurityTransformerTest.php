<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Transformer;

use App\Infrastructure\Service\Transformer\SecurityTransformer;
use App\Application\Factory\Shared\SharedEntityFactory;
use App\Application\Factory\Security\SecurityOutputFactory;
use App\Application\Dto\Output\Security\CreateOutputDto;
use App\Application\Dto\Output\Shared\SessionDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Dto\Output\Security\ResetOrCreateOutputDto;
use App\Application\Dto\Output\Security\UpdatePasswordOutputDto;
use App\Application\Dto\Output\Security\ResetPasswordFromPKUserOutputDto;
use App\Application\Dto\Output\Security\LogoutOutputDto;
use App\Domain\Entity\User;
use App\Domain\Entity\Session;

class SecurityTransformerTest extends BaseTransformerTest
{
  private SecurityTransformer $transformer;
  private SharedEntityFactory|MockInterface $entityFactory;
  private SecurityOutputFactory|MockInterface $outputFactory;

  protected function setUp(): void
  {
    $this->entityFactory = $this->createFactoryMock(SharedEntityFactory::class);
    $this->outputFactory = $this->createFactoryMock(SecurityOutputFactory::class);
    $this->transformer = new SecurityTransformer($this->entityFactory, $this->outputFactory);
  }

  public function testTransformCreate(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult(['result' => true]);

    // Act
    $result = $this->transformer->transformCreate($dataSourceResult);

    // Assert
    $this->assertInstanceOf(CreateOutputDto::class, $result);
    $this->assertTrue($result->bool);
  }

  public function testTransformLoginFromParam(): void
  {
    // Arrange
    $userRaw = $this->createSoapUser(['PKUser' => 123]);
    $sessionId = 'session_123';
    $isConnected = true;

    $dataSourceResult = $this->createDataSourceResult([
      'User' => $userRaw,
      'SessionID' => $sessionId,
      'Connected' => $isConnected
    ]);

    $user = $this->createEntityMock(User::class);
    $session = $this->createEntityMock(Session::class);
    $expectedOutput = $this->createDtoMock(SessionDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createUserFromRaw')
      ->with($userRaw)
      ->willReturn($user);

    $this->entityFactory
      ->expects($this->once())->method('createSessionFromRaw')
      ->with($isConnected, $sessionId, $user)
      ->willReturn($session);

    $this->outputFactory
      ->expects($this->once())->method('createSessionDto')
      ->with($session)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformLoginFromParam($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformLoginFromParamWithNullValues(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'User' => null,
      'SessionID' => null,
      'Connected' => false
    ]);

    $user = $this->createEntityMock(User::class);
    $session = $this->createEntityMock(Session::class);
    $expectedOutput = $this->createDtoMock(SessionDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createUserFromRaw')
      ->with(null)
      ->willReturn($user);

    $this->entityFactory
      ->expects($this->once())->method('createSessionFromRaw')
      ->with(false, null, $user)
      ->willReturn($session);

    $this->outputFactory
      ->expects($this->once())->method('createSessionDto')
      ->with($session)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformLoginFromParam($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformResetOrCreate(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult(['result' => true]);

    // Act
    $result = $this->transformer->transformResetOrCreate($dataSourceResult);

    // Assert
    $this->assertInstanceOf(ResetOrCreateOutputDto::class, $result);
    $this->assertTrue($result->bool);
  }

  public function testTransformResetPassword(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult(['ResetPasswordResult' => true]);

    // Act
    $result = $this->transformer->transformResetPassword($dataSourceResult);

    // Assert
    $this->assertTrue($result);
  }

  public function testTransformResetPasswordWithNull(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult(['ResetPasswordResult' => null]);

    // Act
    $result = $this->transformer->transformResetPassword($dataSourceResult);

    // Assert
    $this->assertTrue($result);
  }

  public function testTransformResetPasswordWithFalse(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult(['ResetPasswordResult' => false]);

    // Act
    $result = $this->transformer->transformResetPassword($dataSourceResult);

    // Assert
    $this->assertFalse($result);
  }

  public function testTransformUpdatePassword(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult(['UpdatePasswordResult' => true]);

    // Act
    $result = $this->transformer->transformUpdatePassword($dataSourceResult);

    // Assert
    $this->assertInstanceOf(UpdatePasswordOutputDto::class, $result);
    $this->assertTrue($result->updated);
  }

  public function testTransformUpdatePasswordWithFalse(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult(['UpdatePasswordResult' => false]);

    // Act
    $result = $this->transformer->transformUpdatePassword($dataSourceResult);

    // Assert
    $this->assertInstanceOf(UpdatePasswordOutputDto::class, $result);
    $this->assertFalse($result->updated);
  }

  public function testTransformLoginToSession(): void
  {
    // Arrange
    $userRaw = $this->createSoapUser(['PKUser' => 123]);
    $sessionId = 'session_456';
    $isConnected = true;

    $dataSourceResult = $this->createDataSourceResult([
      'User' => $userRaw,
      'SessionID' => $sessionId,
      'Connected' => $isConnected
    ]);

    $user = $this->createEntityMock(User::class);
    $session = $this->createEntityMock(Session::class);
    $expectedOutput = $this->createDtoMock(SessionDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createUserFromRaw')
      ->with($userRaw)
      ->willReturn($user);

    $this->entityFactory
      ->expects($this->once())->method('createSessionFromRaw')
      ->with($isConnected, $sessionId, $user)
      ->willReturn($session);

    $this->outputFactory
      ->expects($this->once())->method('createSessionDto')
      ->with($session)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformLoginToSession($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformToLoginOutput(): void
  {
    // Arrange
    $sessionDto = $this->createDtoMock(SessionDto::class);
    $token = 'jwt_token_123';
    $expectedOutput = $this->createDtoMock(LoginOutputDto::class);

    $this->outputFactory
      ->expects($this->once())->method('createLoginOutputDto')
      ->with($sessionDto, $token)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformToLoginOutput($sessionDto, $token);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformResetPasswordFromPKUser(): void
  {
    // Arrange
    $soapUser = $this->createSoapUser(['PKUser' => 123]);
    $dataSourceResult = $this->createDataSourceResult([
      'ResetPasswordFromPKUserResult' => $soapUser
    ]);

    // Act
    $result = $this->transformer->transformResetPasswordFromPKUser($dataSourceResult);

    // Assert
    $this->assertInstanceOf(ResetPasswordFromPKUserOutputDto::class, $result);
    $this->assertInstanceOf(\App\Application\Dto\Output\Shared\UserDto::class, $result->user);
  }

  public function testTransformLogout(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult(['LogoutResult' => true]);

    // Act
    $result = $this->transformer->transformLogout($dataSourceResult);

    // Assert
    $this->assertInstanceOf(LogoutOutputDto::class, $result);
    $this->assertTrue($result->loggedOut);
  }

  public function testTransformLogoutWithFalse(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult(['LogoutResult' => false]);

    // Act
    $result = $this->transformer->transformLogout($dataSourceResult);

    // Assert
    $this->assertInstanceOf(LogoutOutputDto::class, $result);
    $this->assertFalse($result->loggedOut);
  }

  public function testTransformResetPasswordFromPKUserWithComplexData(): void
  {
    // Arrange
    $soapUser = $this->createSoapUser([
      'PKUser' => 123,
      'UserName' => 'test_user',
      'EMail' => 'test@example.com',
      'UserType' => 'admin'
    ]);
    $dataSourceResult = $this->createDataSourceResult([
      'ResetPasswordFromPKUserResult' => $soapUser
    ]);

    // Act
    $result = $this->transformer->transformResetPasswordFromPKUser($dataSourceResult);

    // Assert
    $this->assertInstanceOf(ResetPasswordFromPKUserOutputDto::class, $result);
    $user = $result->user;
    $this->assertEquals('test_user', $user->userName);
    $this->assertEquals('test@example.com', $user->email);
    $this->assertEquals('admin', $user->userType);
    $this->assertEquals(123, $user->pkUser);
  }
}
