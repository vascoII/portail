<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\UseCase\Operator;

use App\Application\UseCase\Operator\DeleteUseCase;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;
use App\Tests\Unit\Application\UseCase\BaseUseCaseTest;
use Mockery;

class DeleteUseCaseTest extends BaseUseCaseTest
{
  private OperatorDataProviderInterface $dataProvider;
  private DeleteUseCase $useCase;

  protected function setUp(): void
  {
    parent::setUp();
    $this->dataProvider = $this->createDataProviderMock(OperatorDataProviderInterface::class);
    $this->useCase = new DeleteUseCase($this->dataProvider);
  }

  public function testExecuteReturnsSuccessOutputDto(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataProvider
      ->shouldReceive('deleteOperatorService')
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
    $inputDto = new GetByIdIntInputDto(456);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataProvider
      ->shouldReceive('deleteOperatorService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $this->useCase->execute($inputDto);

    // Assert
    $this->assertMethodCalledOnce($this->dataProvider, 'deleteOperatorService', $inputDto);
  }

  public function testExecuteHandlesDataProviderFailure(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(789);
    $expectedOutput = new SuccessOutputDto(false);

    $this->dataProvider
      ->shouldReceive('deleteOperatorService')
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
