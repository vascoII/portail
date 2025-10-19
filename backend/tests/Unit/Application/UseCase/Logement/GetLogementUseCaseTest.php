<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\UseCase\Logement;

use App\Application\UseCase\Logement\GetLogementUseCase;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Logement\LogementOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;
use App\Tests\Unit\Application\UseCase\BaseUseCaseTest;
use Mockery;

class GetLogementUseCaseTest extends BaseUseCaseTest
{
  private LogementDataProviderInterface $dataProvider;
  private GetLogementUseCase $useCase;

  protected function setUp(): void
  {
    parent::setUp();
    $this->dataProvider = $this->createDataProviderMock(LogementDataProviderInterface::class);
    $this->useCase = new GetLogementUseCase($this->dataProvider);
  }

  public function testExecuteReturnsLogementOutputDto(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);
    $expectedOutput = Mockery::mock(LogementOutputDto::class);

    $this->dataProvider
      ->shouldReceive('getLogementService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->useCase->execute($inputDto);

    // Assert
    $this->assertInstanceOf(LogementOutputDto::class, $result);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testExecuteCallsDataProviderWithCorrectInput(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(456);
    $expectedOutput = Mockery::mock(LogementOutputDto::class);

    $this->dataProvider
      ->shouldReceive('getLogementService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $this->useCase->execute($inputDto);

    // Assert
    $this->assertMethodCalledOnce($this->dataProvider, 'getLogementService', $inputDto);
  }

  public function testExecuteWithDifferentId(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(789);
    $expectedOutput = Mockery::mock(LogementOutputDto::class);

    $this->dataProvider
      ->shouldReceive('getLogementService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->useCase->execute($inputDto);

    // Assert
    $this->assertInstanceOf(LogementOutputDto::class, $result);
    $this->assertEquals($expectedOutput, $result);
  }
}
