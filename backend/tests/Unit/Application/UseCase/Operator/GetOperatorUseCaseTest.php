<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\UseCase\Operator;

use App\Application\UseCase\Operator\GetOperatorUseCase;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Operator\GetOperatorOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;
use App\Tests\Unit\Application\UseCase\BaseUseCaseTest;
use Mockery;

class GetOperatorUseCaseTest extends BaseUseCaseTest
{
  private OperatorDataProviderInterface $dataProvider;
  private GetOperatorUseCase $useCase;

  protected function setUp(): void
  {
    parent::setUp();
    $this->dataProvider = $this->createDataProviderMock(OperatorDataProviderInterface::class);
    $this->useCase = new GetOperatorUseCase($this->dataProvider);
  }

  public function testExecuteReturnsGetOperatorOutputDto(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);
    $expectedOutput = $this->createMock(GetOperatorOutputDto::class);

    $this->dataProvider
      ->shouldReceive('getOperatorService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->useCase->execute($inputDto);

    // Assert
    $this->assertInstanceOf(GetOperatorOutputDto::class, $result);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testExecuteCallsDataProviderWithCorrectInput(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(456);
    $expectedOutput = $this->createMock(GetOperatorOutputDto::class);

    $this->dataProvider
      ->shouldReceive('getOperatorService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $this->useCase->execute($inputDto);

    // Assert
    $this->assertMethodCalledOnce($this->dataProvider, 'getOperatorService', $inputDto);
  }

  public function testExecuteWithDifferentId(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(789);
    $expectedOutput = $this->createMock(GetOperatorOutputDto::class);

    $this->dataProvider
      ->shouldReceive('getOperatorService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->useCase->execute($inputDto);

    // Assert
    $this->assertInstanceOf(GetOperatorOutputDto::class, $result);
    $this->assertEquals($expectedOutput, $result);
  }
}
