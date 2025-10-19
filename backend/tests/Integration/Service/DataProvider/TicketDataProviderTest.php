<?php

declare(strict_types=1);

namespace App\Tests\Integration\Service\DataProvider;

use App\Infrastructure\Service\DataProvider\TicketDataProvider;
use App\Application\Service\DataSource\TicketDataSourceInterface;
use App\Application\Service\Transformer\TicketTransformerInterface;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;

class TicketDataProviderTest extends BaseDataProviderTest
{
  private TicketDataSourceInterface $dataSource;
  private TicketTransformerInterface $transformer;
  private TicketDataProvider $dataProvider;

  protected function setUp(): void
  {
    $this->dataSource = $this->createDataSourceMock(TicketDataSourceInterface::class);
    $this->transformer = $this->createTransformerMock(TicketTransformerInterface::class);

    $this->dataProvider = new TicketDataProvider(
      $this->dataSource,
      $this->transformer
    );
  }

  public function testListTicketsService(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['tickets' => []]);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchListTickets')
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformListTickets')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->listTicketsService();

    // Assert
    $this->assertResultType($result, SuccessOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testGetTicketService(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);
    $rawData = $this->createDataSourceResult(['ticket' => ['id' => 123]]);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchGetTicket')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetTicket')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getTicketService($inputDto);

    // Assert
    $this->assertResultType($result, SuccessOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testCreateTicketService(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchCreateTicket')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformCreateTicket')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->createTicketService($inputDto);

    // Assert
    $this->assertResultType($result, SuccessOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testPatchTicketService(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchPatchTicket')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformPatchTicket')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->patchTicketService($inputDto);

    // Assert
    $this->assertResultType($result, SuccessOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testAllMethodsReturnCorrectTypes(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new SuccessOutputDto(true);
    $idInput = new GetByIdIntInputDto(123);

    // Setup common mocks
    $this->dataSource->shouldReceive('fetchListTickets')->andReturn($rawData);
    $this->dataSource->shouldReceive('fetchGetTicket')->andReturn($rawData);
    $this->dataSource->shouldReceive('fetchCreateTicket')->andReturn($rawData);
    $this->dataSource->shouldReceive('fetchPatchTicket')->andReturn($rawData);

    $this->transformer->shouldReceive('transformListTickets')->andReturn($expectedOutput);
    $this->transformer->shouldReceive('transformGetTicket')->andReturn($expectedOutput);
    $this->transformer->shouldReceive('transformCreateTicket')->andReturn($expectedOutput);
    $this->transformer->shouldReceive('transformPatchTicket')->andReturn($expectedOutput);

    // Act & Assert
    $this->assertResultType($this->dataProvider->listTicketsService(), SuccessOutputDto::class);
    $this->assertResultType($this->dataProvider->getTicketService($idInput), SuccessOutputDto::class);
    $this->assertResultType($this->dataProvider->createTicketService($idInput), SuccessOutputDto::class);
    $this->assertResultType($this->dataProvider->patchTicketService($idInput), SuccessOutputDto::class);
  }

  public function testDataFlowIntegration(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new SuccessOutputDto(true);

    // Verify the complete data flow
    $this->dataSource
      ->shouldReceive('fetchGetTicket')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetTicket')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getTicketService($inputDto);

    // Assert - Verify the complete integration
    $this->assertEquals($expectedOutput, $result);
    $this->assertResultType($result, SuccessOutputDto::class);
  }

  public function testConsistencyAcrossMultipleCalls(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchListTickets')
      ->times(3)
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformListTickets')
      ->with($rawData)
      ->times(3)
      ->andReturn($expectedOutput);

    // Act
    $result1 = $this->dataProvider->listTicketsService();
    $result2 = $this->dataProvider->listTicketsService();
    $result3 = $this->dataProvider->listTicketsService();

    // Assert
    $this->assertEquals($result1, $result2);
    $this->assertEquals($result2, $result3);
    $this->assertResultType($result1, SuccessOutputDto::class);
  }
}
