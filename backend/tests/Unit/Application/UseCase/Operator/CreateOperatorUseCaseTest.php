<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\UseCase\Operator;

use App\Application\UseCase\Operator\CreateOperatorUseCase;
use App\Application\Dto\Input\Operator\CreateOperatorInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;
use App\Tests\Unit\Application\UseCase\BaseUseCaseTest;
use Mockery;

class CreateOperatorUseCaseTest extends BaseUseCaseTest
{
  private OperatorDataProviderInterface $dataProvider;
  private CreateOperatorUseCase $useCase;

  protected function setUp(): void
  {
    parent::setUp();
    $this->dataProvider = $this->createDataProviderMock(OperatorDataProviderInterface::class);
    $this->useCase = new CreateOperatorUseCase($this->dataProvider);
  }

  public function testExecuteReturnsSuccessOutputDto(): void
  {
    // Arrange
    $inputDto = new CreateOperatorInputDto(
      'test@example.com',
      'Doe',
      'John',
      '1234567890',
      'Developer'
    );
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataProvider
      ->shouldReceive('createOperatorService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->useCase->execute($inputDto);

    // Assert
    $this->assertInstanceOf(SuccessOutputDto::class, $result);
    $this->assertEquals($expectedOutput, $result);
    $this->assertTrue($result->bool);
  }

  public function testExecuteCallsDataProviderWithCorrectInput(): void
  {
    // Arrange
    $inputDto = new CreateOperatorInputDto(
      'another@example.com',
      'Smith',
      'Jane',
      '0987654321',
      'Manager'
    );
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataProvider
      ->shouldReceive('createOperatorService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $this->useCase->execute($inputDto);

    // Assert
    $this->assertMethodCalledOnce($this->dataProvider, 'createOperatorService', $inputDto);
  }

  public function testExecuteHandlesDataProviderFailure(): void
  {
    // Arrange
    $inputDto = new CreateOperatorInputDto(
      'fail@example.com',
      'Error',
      'Test',
      '0000000000',
      'Tester'
    );
    $expectedOutput = new SuccessOutputDto(false);

    $this->dataProvider
      ->shouldReceive('createOperatorService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->useCase->execute($inputDto);

    // Assert
    $this->assertInstanceOf(SuccessOutputDto::class, $result);
    $this->assertFalse($result->bool);
  }
}
