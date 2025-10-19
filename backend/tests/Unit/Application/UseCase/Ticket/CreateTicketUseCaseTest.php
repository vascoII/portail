<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\UseCase\Ticket;

use App\Application\UseCase\Ticket\CreateTicketUseCase;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\TicketDataProviderInterface;
use App\Tests\Unit\Application\UseCase\BaseUseCaseTest;
use Mockery;

class CreateTicketUseCaseTest extends BaseUseCaseTest
{
  private TicketDataProviderInterface $dataProvider;
  private CreateTicketUseCase $useCase;

  protected function setUp(): void
  {
    parent::setUp();
    $this->dataProvider = $this->createDataProviderMock(TicketDataProviderInterface::class);
    $this->useCase = new CreateTicketUseCase($this->dataProvider);
  }

  public function testExecuteReturnsSuccessOutputDto(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataProvider
      ->shouldReceive('createTicketService')
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
      ->shouldReceive('createTicketService')
      ->with($inputDto)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $this->useCase->execute($inputDto);

    // Assert
    $this->assertMethodCalledOnce($this->dataProvider, 'createTicketService', $inputDto);
  }

  public function testExecuteHandlesDataProviderFailure(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(789);
    $expectedOutput = new SuccessOutputDto(false);

    $this->dataProvider
      ->shouldReceive('createTicketService')
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
