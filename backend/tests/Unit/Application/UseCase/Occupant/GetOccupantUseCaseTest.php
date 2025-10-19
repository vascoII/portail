<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\UseCase\Occupant;

use App\Application\UseCase\Occupant\GetOccupantUseCase;
use App\Application\Dto\Output\Occupant\GetOccupantOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;
use App\Tests\Unit\Application\UseCase\BaseUseCaseTest;
use Mockery;

class GetOccupantUseCaseTest extends BaseUseCaseTest
{
  private OccupantDataProviderInterface $dataProvider;
  private GetOccupantUseCase $useCase;

  protected function setUp(): void
  {
    parent::setUp();
    $this->dataProvider = $this->createDataProviderMock(OccupantDataProviderInterface::class);
    $this->useCase = new GetOccupantUseCase($this->dataProvider);
  }

  public function testExecuteReturnsGetOccupantOutputDto(): void
  {
    // Arrange
    $expectedOutput = Mockery::mock(GetOccupantOutputDto::class);

    $this->dataProvider
      ->shouldReceive('getOccupantService')
      ->withNoArgs()
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->useCase->execute();

    // Assert
    $this->assertInstanceOf(GetOccupantOutputDto::class, $result);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testExecuteCallsDataProviderWithNoArguments(): void
  {
    // Arrange
    $expectedOutput = Mockery::mock(GetOccupantOutputDto::class);

    $this->dataProvider
      ->shouldReceive('getOccupantService')
      ->withNoArgs()
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $this->useCase->execute();

    // Assert
    $this->assertMethodCalledOnce($this->dataProvider, 'getOccupantService');
  }
}
