<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Hydrator;

use App\Infrastructure\Service\Hydrator\TicketHydrator;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

class TicketHydratorTest extends BaseHydratorTest
{
  private TicketHydrator $hydrator;

  protected function setUp(): void
  {
    $this->hydrator = new TicketHydrator();
  }

  public function testHydrateListTickets(): void
  {
    // Act
    $result = $this->hydrator->hydrateListTickets();

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectPropertyCount($result, 0);
  }

  public function testHydrateGetTicket(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act
    $result = $this->hydrator->hydrateGetTicket($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'Id' => 123
    ]);
    $this->assertHydratedObjectPropertyCount($result, 1);
  }

  public function testHydrateCreateTicket(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(456);

    // Act
    $result = $this->hydrator->hydrateCreateTicket($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'Id' => 456
    ]);
    $this->assertHydratedObjectPropertyCount($result, 1);
  }

  public function testHydratePatchTicket(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(789);

    // Act
    $result = $this->hydrator->hydratePatchTicket($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'Id' => 789
    ]);
    $this->assertHydratedObjectPropertyCount($result, 1);
  }

  public function testHydrateGetTicketWithDifferentIds(): void
  {
    // Arrange
    $inputDto1 = new GetByIdIntInputDto(123);
    $inputDto2 = new GetByIdIntInputDto(456);
    $inputDto3 = new GetByIdIntInputDto(789);

    // Act
    $result1 = $this->hydrator->hydrateGetTicket($inputDto1);
    $result2 = $this->hydrator->hydrateGetTicket($inputDto2);
    $result3 = $this->hydrator->hydrateGetTicket($inputDto3);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, ['Id' => 123]);
    $this->assertHydratedObjectHasProperties($result2, ['Id' => 456]);
    $this->assertHydratedObjectHasProperties($result3, ['Id' => 789]);
  }

  public function testHydrateCreateTicketWithDifferentIds(): void
  {
    // Arrange
    $inputDto1 = new GetByIdIntInputDto(111);
    $inputDto2 = new GetByIdIntInputDto(222);
    $inputDto3 = new GetByIdIntInputDto(333);

    // Act
    $result1 = $this->hydrator->hydrateCreateTicket($inputDto1);
    $result2 = $this->hydrator->hydrateCreateTicket($inputDto2);
    $result3 = $this->hydrator->hydrateCreateTicket($inputDto3);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, ['Id' => 111]);
    $this->assertHydratedObjectHasProperties($result2, ['Id' => 222]);
    $this->assertHydratedObjectHasProperties($result3, ['Id' => 333]);
  }

  public function testHydratePatchTicketWithDifferentIds(): void
  {
    // Arrange
    $inputDto1 = new GetByIdIntInputDto(444);
    $inputDto2 = new GetByIdIntInputDto(555);
    $inputDto3 = new GetByIdIntInputDto(666);

    // Act
    $result1 = $this->hydrator->hydratePatchTicket($inputDto1);
    $result2 = $this->hydrator->hydratePatchTicket($inputDto2);
    $result3 = $this->hydrator->hydratePatchTicket($inputDto3);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, ['Id' => 444]);
    $this->assertHydratedObjectHasProperties($result2, ['Id' => 555]);
    $this->assertHydratedObjectHasProperties($result3, ['Id' => 666]);
  }

  public function testAllMethodsReturnObjects(): void
  {
    // Arrange
    $idInput = new GetByIdIntInputDto(123);

    // Act & Assert
    $this->assertIsObject($this->hydrator->hydrateListTickets());
    $this->assertIsObject($this->hydrator->hydrateGetTicket($idInput));
    $this->assertIsObject($this->hydrator->hydrateCreateTicket($idInput));
    $this->assertIsObject($this->hydrator->hydratePatchTicket($idInput));
  }

  public function testHydratedObjectsAreConsistent(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act
    $result1 = $this->hydrator->hydrateGetTicket($inputDto);
    $result2 = $this->hydrator->hydrateGetTicket($inputDto);

    // Assert
    $this->assertEquals($result1, $result2);
  }

  public function testEmptyMethodReturnsEmptyObject(): void
  {
    // Act
    $result = $this->hydrator->hydrateListTickets();

    // Assert
    $this->assertHydratedObjectPropertyCount($result, 0);
  }

  public function testMethodsWithParametersReturnObjectsWithData(): void
  {
    // Arrange
    $idInput = new GetByIdIntInputDto(123);

    // Act
    $getResult = $this->hydrator->hydrateGetTicket($idInput);
    $createResult = $this->hydrator->hydrateCreateTicket($idInput);
    $patchResult = $this->hydrator->hydratePatchTicket($idInput);

    // Assert
    $this->assertGreaterThan(0, count(get_object_vars($getResult)));
    $this->assertGreaterThan(0, count(get_object_vars($createResult)));
    $this->assertGreaterThan(0, count(get_object_vars($patchResult)));
  }

  public function testHydratedObjectsHaveCorrectPropertyTypes(): void
  {
    // Arrange
    $idInput = new GetByIdIntInputDto(123);

    // Act
    $result = $this->hydrator->hydrateGetTicket($idInput);

    // Assert
    $this->assertHydratedObjectPropertyTypes($result, [
      'Id' => 'int'
    ]);
  }

  public function testMethodsReturnStdClassObjects(): void
  {
    // Arrange
    $idInput = new GetByIdIntInputDto(123);

    // Act
    $result = $this->hydrator->hydrateGetTicket($idInput);

    // Assert
    $this->assertInstanceOf(\stdClass::class, $result);
  }

  public function testAllMethodsWithSameIdReturnSameStructure(): void
  {
    // Arrange
    $idInput = new GetByIdIntInputDto(123);

    // Act
    $getResult = $this->hydrator->hydrateGetTicket($idInput);
    $createResult = $this->hydrator->hydrateCreateTicket($idInput);
    $patchResult = $this->hydrator->hydratePatchTicket($idInput);

    // Assert
    $this->assertEquals($getResult, $createResult);
    $this->assertEquals($createResult, $patchResult);
  }
}
