<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Transformer;

use App\Infrastructure\Service\Transformer\TicketTransformer;
use App\Application\Dto\Output\Shared\SuccessOutputDto;

class TicketTransformerTest extends BaseTransformerTest
{
  private TicketTransformer $transformer;

  protected function setUp(): void
  {
    $this->transformer = new TicketTransformer();
  }

  public function testTransformListTickets(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'tickets' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformListTickets($dataSourceResult);

    // Assert
    $this->assertInstanceOf(SuccessOutputDto::class, $result);
    $this->assertTrue($result->bool);
  }

  public function testTransformGetTicket(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'ticket' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformGetTicket($dataSourceResult);

    // Assert
    $this->assertInstanceOf(SuccessOutputDto::class, $result);
    $this->assertTrue($result->bool);
  }

  public function testTransformCreateTicket(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'created_ticket' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformCreateTicket($dataSourceResult);

    // Assert
    $this->assertInstanceOf(SuccessOutputDto::class, $result);
    $this->assertTrue($result->bool);
  }

  public function testTransformPatchTicket(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'patched_ticket' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformPatchTicket($dataSourceResult);

    // Assert
    $this->assertInstanceOf(SuccessOutputDto::class, $result);
    $this->assertTrue($result->bool);
  }

  public function testAllMethodsReturnSuccessOutputDto(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult(['test' => 'data']);

    // Act & Assert
    $result1 = $this->transformer->transformListTickets($dataSourceResult);
    $this->assertInstanceOf(SuccessOutputDto::class, $result1);
    $this->assertTrue($result1->bool);

    $result2 = $this->transformer->transformGetTicket($dataSourceResult);
    $this->assertInstanceOf(SuccessOutputDto::class, $result2);
    $this->assertTrue($result2->bool);

    $result3 = $this->transformer->transformCreateTicket($dataSourceResult);
    $this->assertInstanceOf(SuccessOutputDto::class, $result3);
    $this->assertTrue($result3->bool);

    $result4 = $this->transformer->transformPatchTicket($dataSourceResult);
    $this->assertInstanceOf(SuccessOutputDto::class, $result4);
    $this->assertTrue($result4->bool);
  }
}
