<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\UseCase\Operator;

use App\Application\UseCase\Operator\ListOperatorsUseCase;
use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Output\Operator\ListOperatorsOutputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;
use App\Tests\Unit\Application\UseCase\BaseUseCaseTest;
use Mockery;

class ListOperatorsUseCaseTest extends BaseUseCaseTest
{
  private OperatorDataProviderInterface $dataProvider;
  private ListOperatorsUseCase $useCase;

  protected function setUp(): void
  {
    parent::setUp();
    $this->dataProvider = $this->createDataProviderMock(OperatorDataProviderInterface::class);
    $this->useCase = new ListOperatorsUseCase($this->dataProvider);
  }

  public function testExecuteReturnsListOperatorsOutputDto(): void
  {
    // Arrange
    $inputDto = new ListOperatorsInputDto('all');
    $expectedOutput = Mockery::mock(ListOperatorsOutputDto::class);

    $this->dataProvider
      ->shouldReceive('listOperatorsService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->useCase->execute($inputDto);

    // Assert
    $this->assertInstanceOf(ListOperatorsOutputDto::class, $result);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testExecuteCallsDataProviderWithCorrectInput(): void
  {
    // Arrange
    $inputDto = new ListOperatorsInputDto('active');
    $expectedOutput = Mockery::mock(ListOperatorsOutputDto::class);

    $this->dataProvider
      ->shouldReceive('listOperatorsService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $this->useCase->execute($inputDto);

    // Assert
    $this->assertMethodCalledOnce($this->dataProvider, 'listOperatorsService', $inputDto);
  }

  public function testExecuteWithDifferentType(): void
  {
    // Arrange
    $inputDto = new ListOperatorsInputDto('inactive');
    $expectedOutput = Mockery::mock(ListOperatorsOutputDto::class);

    $this->dataProvider
      ->shouldReceive('listOperatorsService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->useCase->execute($inputDto);

    // Assert
    $this->assertInstanceOf(ListOperatorsOutputDto::class, $result);
    $this->assertEquals($expectedOutput, $result);
  }
}
