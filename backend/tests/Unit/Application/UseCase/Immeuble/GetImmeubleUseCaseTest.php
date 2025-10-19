<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\UseCase\Immeuble;

use App\Application\UseCase\Immeuble\GetImmeubleUseCase;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Immeuble\GetImmeubleOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;
use App\Tests\Unit\Application\UseCase\BaseUseCaseTest;
use Mockery;

class GetImmeubleUseCaseTest extends BaseUseCaseTest
{
  private ImmeubleDataProviderInterface $dataProvider;
  private GetImmeubleUseCase $useCase;

  protected function setUp(): void
  {
    parent::setUp();
    $this->dataProvider = $this->createDataProviderMock(ImmeubleDataProviderInterface::class);
    $this->useCase = new GetImmeubleUseCase($this->dataProvider);
  }

  public function testExecuteReturnsGetImmeubleOutputDto(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);
    $expectedOutput = Mockery::mock(GetImmeubleOutputDto::class);

    $this->dataProvider
      ->shouldReceive('getImmeubleService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->useCase->execute($inputDto);

    // Assert
    $this->assertInstanceOf(GetImmeubleOutputDto::class, $result);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testExecuteCallsDataProviderWithCorrectInput(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(456);
    $expectedOutput = Mockery::mock(GetImmeubleOutputDto::class);

    $this->dataProvider
      ->shouldReceive('getImmeubleService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $this->useCase->execute($inputDto);

    // Assert
    $this->assertMethodCalledOnce($this->dataProvider, 'getImmeubleService', $inputDto);
  }

  public function testExecuteWithDifferentId(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(789);
    $expectedOutput = Mockery::mock(GetImmeubleOutputDto::class);

    $this->dataProvider
      ->shouldReceive('getImmeubleService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->useCase->execute($inputDto);

    // Assert
    $this->assertInstanceOf(GetImmeubleOutputDto::class, $result);
    $this->assertEquals($expectedOutput, $result);
  }
}
