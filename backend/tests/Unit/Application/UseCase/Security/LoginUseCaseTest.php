<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\UseCase\Security;

use App\Application\UseCase\Security\LoginUseCase;
use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Service\DataProvider\SecurityDataProviderInterface;
use App\Tests\Unit\Application\UseCase\BaseUseCaseTest;
use Mockery;

class LoginUseCaseTest extends BaseUseCaseTest
{
  private SecurityDataProviderInterface $dataProvider;
  private LoginUseCase $useCase;

  protected function setUp(): void
  {
    parent::setUp();
    $this->dataProvider = $this->createDataProviderMock(SecurityDataProviderInterface::class);
    $this->useCase = new LoginUseCase($this->dataProvider);
  }

  public function testExecuteReturnsLoginOutputDto(): void
  {
    // Arrange
    $inputDto = new LoginInputDto('test@example.com', 'password123');
    $expectedOutput = Mockery::mock(LoginOutputDto::class);

    $this->dataProvider
      ->shouldReceive('loginService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->useCase->execute($inputDto);

    // Assert
    $this->assertInstanceOf(LoginOutputDto::class, $result);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testExecuteCallsDataProviderWithCorrectInput(): void
  {
    // Arrange
    $inputDto = new LoginInputDto('user@example.com', 'securepassword');
    $expectedOutput = Mockery::mock(LoginOutputDto::class);

    $this->dataProvider
      ->shouldReceive('loginService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $this->useCase->execute($inputDto);

    // Assert
    $this->assertMethodCalledOnce($this->dataProvider, 'loginService', $inputDto);
  }

  public function testExecuteWithDifferentCredentials(): void
  {
    // Arrange
    $inputDto = new LoginInputDto('admin@example.com', 'adminpass');
    $expectedOutput = Mockery::mock(LoginOutputDto::class);

    $this->dataProvider
      ->shouldReceive('loginService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->useCase->execute($inputDto);

    // Assert
    $this->assertInstanceOf(LoginOutputDto::class, $result);
    $this->assertEquals($expectedOutput, $result);
  }
}
