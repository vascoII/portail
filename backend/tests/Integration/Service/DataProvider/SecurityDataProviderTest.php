<?php

declare(strict_types=1);

namespace App\Tests\Integration\Service\DataProvider;

use App\Infrastructure\Service\DataProvider\SecurityDataProvider;
use App\Application\Service\DataSource\SecurityDataSourceInterface;
use App\Application\Service\Transformer\SecurityTransformerInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Service\Jwt\JwtServiceInterface;
use App\Application\Service\Redis\RedisServiceInterface;
use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;
use App\Application\Dto\Input\Security\ResetOrCreateInputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Dto\Output\Security\LogoutOutputDto;
use App\Application\Dto\Output\Security\ResetPasswordOutputDto;
use App\Application\Dto\Output\Security\UpdatePasswordOutputDto;
use App\Application\Dto\Output\Security\ResetPasswordFromPKUserOutputDto;
use Mockery;

class SecurityDataProviderTest extends BaseDataProviderTest
{
  private SecurityDataSourceInterface $dataSource;
  private SecurityTransformerInterface $transformer;
  private AuthServiceInterface $authService;
  private JwtServiceInterface $jwtService;
  private RedisServiceInterface $redisService;
  private SecurityDataProvider $dataProvider;

  protected function setUp(): void
  {
    $this->dataSource = $this->createDataSourceMock(SecurityDataSourceInterface::class);
    $this->transformer = $this->createTransformerMock(SecurityTransformerInterface::class);
    $this->authService = $this->createAuthServiceMock();
    $this->jwtService = $this->createJwtServiceMock();
    $this->redisService = $this->createRedisServiceMock();

    $this->dataProvider = new SecurityDataProvider(
      $this->dataSource,
      $this->transformer,
      $this->authService,
      $this->jwtService,
      $this->redisService
    );
  }

  public function testLoginService(): void
  {
    // Arrange
    $inputDto = new LoginInputDto('test@example.com', 'password123');
    $rawData = $this->createDataSourceResult([
      'User' => ['id' => 123, 'email' => 'test@example.com'],
      'SessionID' => 'session_123'
    ]);
    $sessionDto = $this->createTestSessionDto();
    $expectedOutput = new LoginOutputDto('jwt_token_123', 'test@example.com', 'Test User', 'test@example.com', 'admin', '123 Main St', '12345', 'City', '1234567890', 'John', 'admin', 'Client Name', 5, 100, 200, 300, 400, true, 'test@example.com', true, true, true, true);

    $this->dataSource
      ->shouldReceive('fetchLogin')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformLoginToSession')
      ->with($rawData)
      ->once()
      ->andReturn($sessionDto);

    $this->jwtService
      ->shouldReceive('generateToken')
      ->with($sessionDto)
      ->once()
      ->andReturn('jwt_token_123');

    $this->redisService
      ->shouldReceive('storeSession')
      ->with('test_session_123', $sessionDto)
      ->once();

    $this->transformer
      ->shouldReceive('transformToLoginOutput')
      ->with($sessionDto, 'jwt_token_123')
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->loginService($inputDto);

    // Assert
    $this->assertResultType($result, LoginOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testLoginFromParamService(): void
  {
    // Arrange
    $inputDto = new LoginFromParamInputDto('test_param');
    $rawData = $this->createDataSourceResult([
      'User' => ['id' => 123, 'email' => 'test@example.com'],
      'SessionID' => 'session_123'
    ]);
    $sessionDto = $this->createTestSessionDto();
    $expectedOutput = new LoginOutputDto('jwt_token_123', 'test@example.com', 'Test User', 'test@example.com', 'admin', '123 Main St', '12345', 'City', '1234567890', 'John', 'admin', 'Client Name', 5, 100, 200, 300, 400, true, 'test@example.com', true, true, true, true);

    $this->dataSource
      ->shouldReceive('fetchLoginFromParam')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformLoginFromParam')
      ->with($rawData)
      ->once()
      ->andReturn($sessionDto);

    $this->jwtService
      ->shouldReceive('generateToken')
      ->with($sessionDto)
      ->once()
      ->andReturn('jwt_token_123');

    $this->redisService
      ->shouldReceive('storeSession')
      ->with('test_session_123', $sessionDto)
      ->once();

    $this->transformer
      ->shouldReceive('transformToLoginOutput')
      ->with($sessionDto, 'jwt_token_123')
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->loginFromParamService($inputDto);

    // Assert
    $this->assertResultType($result, LoginOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testLogoutService(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = (object) ['success' => true];

    $this->dataSource
      ->shouldReceive('fetchLogout')
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformLogout')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    $this->authService
      ->shouldReceive('getCurrentSessionId')
      ->once()
      ->andReturn('test_session_123');

    $this->redisService
      ->shouldReceive('deleteSession')
      ->with('test_session_123')
      ->once();

    $this->authService
      ->shouldReceive('clearAuthenticatedUser')
      ->once();

    // Act
    $result = $this->dataProvider->logoutService();

    // Assert
    $this->assertResultType($result, LogoutOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testResetPasswordService(): void
  {
    // Arrange
    $inputDto = new ResetPasswordInputDto('test@example.com');
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new ResetPasswordOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchResetPassword')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformResetPassword')
      ->with($rawData)
      ->once()
      ->andReturn(true);

    // Act
    $result = $this->dataProvider->resetPasswordService($inputDto);

    // Assert
    $this->assertResultType($result, ResetPasswordOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testUpdatePasswordService(): void
  {
    // Arrange
    $inputDto = new UpdatePasswordInputDto('123', 'new_password');
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new UpdatePasswordOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchUpdatePassword')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformUpdatePassword')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->updatePasswordService($inputDto);

    // Assert
    $this->assertResultType($result, UpdatePasswordOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testResetOrCreateService(): void
  {
    // Arrange
    $inputDto = new ResetOrCreateInputDto('test@example.com');
    $rawData = $this->createDataSourceResult(['success' => true]);
    $user = Mockery::mock(\App\Domain\Entity\User::class);
    $expectedOutput = new ResetPasswordFromPKUserOutputDto($user);

    $this->dataSource
      ->shouldReceive('fetchResetOrCreate')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformResetOrCreateResponse')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->resetOrCreateService($inputDto);

    // Assert
    $this->assertResultType($result, ResetPasswordFromPKUserOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testLoginServiceWithDifferentCredentials(): void
  {
    // Arrange
    $inputDto1 = new LoginInputDto('user1@example.com', 'password1');
    $inputDto2 = new LoginInputDto('user2@example.com', 'password2');

    $rawData1 = $this->createDataSourceResult(['User' => ['id' => 1], 'SessionID' => 'session_1']);
    $rawData2 = $this->createDataSourceResult(['User' => ['id' => 2], 'SessionID' => 'session_2']);

    $sessionDto1 = (object) ['session' => (object) ['sessionId' => 'session_1'], 'user' => (object) ['id' => 1]];
    $sessionDto2 = (object) ['session' => (object) ['sessionId' => 'session_2'], 'user' => (object) ['id' => 2]];

    $expectedOutput1 = new LoginOutputDto('token_1', $sessionDto1->user);
    $expectedOutput2 = new LoginOutputDto('token_2', $sessionDto2->user);

    // Setup mocks for first call
    $this->dataSource->shouldReceive('fetchLogin')->with($inputDto1)->andReturn($rawData1);
    $this->transformer->shouldReceive('transformLoginToSession')->with($rawData1)->andReturn($sessionDto1);
    $this->jwtService->shouldReceive('generateToken')->with($sessionDto1)->andReturn('token_1');
    $this->redisService->shouldReceive('storeSession')->with('session_1', $sessionDto1);
    $this->transformer->shouldReceive('transformToLoginOutput')->with($sessionDto1, 'token_1')->andReturn($expectedOutput1);

    // Setup mocks for second call
    $this->dataSource->shouldReceive('fetchLogin')->with($inputDto2)->andReturn($rawData2);
    $this->transformer->shouldReceive('transformLoginToSession')->with($rawData2)->andReturn($sessionDto2);
    $this->jwtService->shouldReceive('generateToken')->with($sessionDto2)->andReturn('token_2');
    $this->redisService->shouldReceive('storeSession')->with('session_2', $sessionDto2);
    $this->transformer->shouldReceive('transformToLoginOutput')->with($sessionDto2, 'token_2')->andReturn($expectedOutput2);

    // Act
    $result1 = $this->dataProvider->loginService($inputDto1);
    $result2 = $this->dataProvider->loginService($inputDto2);

    // Assert
    $this->assertNotEquals($result1, $result2);
    $this->assertResultType($result1, LoginOutputDto::class);
    $this->assertResultType($result2, LoginOutputDto::class);
  }

  public function testAllMethodsReturnCorrectTypes(): void
  {
    // Arrange
    $loginInput = new LoginInputDto('test@example.com', 'password');
    $loginParamInput = new LoginFromParamInputDto('param');
    $resetInput = new ResetPasswordInputDto('test@example.com');
    $updateInput = new UpdatePasswordInputDto('123', 'password');
    $resetOrCreateInput = new ResetOrCreateInputDto('test@example.com');

    // Setup common mocks
    $this->dataSource->shouldReceive('fetchLogin')->andReturn($this->createDataSourceResult([]));
    $this->dataSource->shouldReceive('fetchLoginFromParam')->andReturn($this->createDataSourceResult([]));
    $this->dataSource->shouldReceive('fetchLogout')->andReturn($this->createDataSourceResult(['success' => true]));
    $this->dataSource->shouldReceive('fetchResetPassword')->andReturn($this->createDataSourceResult([]));
    $this->dataSource->shouldReceive('fetchUpdatePassword')->andReturn($this->createDataSourceResult([]));
    $this->dataSource->shouldReceive('fetchResetOrCreate')->andReturn($this->createDataSourceResult([]));

    $this->transformer->shouldReceive('transformLoginToSession')->andReturn($this->createTestSessionDto());
    $this->transformer->shouldReceive('transformLoginFromParam')->andReturn($this->createTestSessionDto());
    $this->transformer->shouldReceive('transformLogout')->andReturn(new LogoutOutputDto(true));
    $this->transformer->shouldReceive('transformResetPassword')->andReturn(true);
    $this->transformer->shouldReceive('transformUpdatePassword')->andReturn(new UpdatePasswordOutputDto(true));
    $this->transformer->shouldReceive('transformResetOrCreateResponse')->andReturn(new ResetPasswordFromPKUserOutputDto(true));
    $this->transformer->shouldReceive('transformToLoginOutput')->andReturn(new LoginOutputDto('token', (object)[]));

    $this->jwtService->shouldReceive('generateToken')->andReturn('token');
    $this->redisService->shouldReceive('storeSession');
    $this->redisService->shouldReceive('deleteSession');
    $this->authService->shouldReceive('getCurrentSessionId')->andReturn('session_id');
    $this->authService->shouldReceive('clearAuthenticatedUser');

    // Act & Assert
    $this->assertResultType($this->dataProvider->loginService($loginInput), LoginOutputDto::class);
    $this->assertResultType($this->dataProvider->loginFromParamService($loginParamInput), LoginOutputDto::class);
    $this->assertResultType($this->dataProvider->logoutService(), LogoutOutputDto::class);
    $this->assertResultType($this->dataProvider->resetPasswordService($resetInput), ResetPasswordOutputDto::class);
    $this->assertResultType($this->dataProvider->updatePasswordService($updateInput), UpdatePasswordOutputDto::class);
    $this->assertResultType($this->dataProvider->resetOrCreateService($resetOrCreateInput), ResetPasswordFromPKUserOutputDto::class);
  }

  public function testDataFlowIntegration(): void
  {
    // Arrange
    $inputDto = new LoginInputDto('test@example.com', 'password123');
    $rawData = $this->createDataSourceResult([
      'User' => ['id' => 123, 'email' => 'test@example.com'],
      'SessionID' => 'session_123'
    ]);
    $sessionDto = $this->createTestSessionDto();
    $expectedOutput = new LoginOutputDto('jwt_token_123', 'test@example.com', 'Test User', 'test@example.com', 'admin', '123 Main St', '12345', 'City', '1234567890', 'John', 'admin', 'Client Name', 5, 100, 200, 300, 400, true, 'test@example.com', true, true, true, true);

    // Verify the complete data flow
    $this->dataSource
      ->shouldReceive('fetchLogin')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformLoginToSession')
      ->with($rawData)
      ->once()
      ->andReturn($sessionDto);

    $this->jwtService
      ->shouldReceive('generateToken')
      ->with($sessionDto)
      ->once()
      ->andReturn('jwt_token_123');

    $this->redisService
      ->shouldReceive('storeSession')
      ->with('test_session_123', $sessionDto)
      ->once();

    $this->transformer
      ->shouldReceive('transformToLoginOutput')
      ->with($sessionDto, 'jwt_token_123')
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->loginService($inputDto);

    // Assert - Verify the complete integration
    $this->assertEquals($expectedOutput, $result);
    $this->assertResultType($result, LoginOutputDto::class);
  }
}
