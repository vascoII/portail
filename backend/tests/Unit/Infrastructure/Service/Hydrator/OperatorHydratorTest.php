<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Hydrator;

use App\Infrastructure\Service\Hydrator\OperatorHydrator;
use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Input\Operator\CreateOperatorInputDto;
use App\Application\Dto\Input\Operator\CreateOperationImmeubleInputDto;
use App\Application\Dto\Input\Operator\PatchOperatorImmeubleInputDto;
use App\Application\Dto\Input\Operator\PutOperatorInputDto;
use App\Application\Dto\Input\Operator\PatchOperatorInputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

class OperatorHydratorTest extends BaseHydratorTest
{
  private OperatorHydrator $hydrator;

  protected function setUp(): void
  {
    $this->hydrator = new OperatorHydrator();
  }

  public function testHydrateGetListOperators(): void
  {
    // Arrange
    $inputDto = new ListOperatorsInputDto('admin');

    // Act
    $result = $this->hydrator->hydrateGetListOperators($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'type' => 'admin'
    ]);
    $this->assertHydratedObjectPropertyCount($result, 1);
  }

  public function testHydratePostOperator(): void
  {
    // Arrange
    $inputDto = new CreateOperatorInputDto(
      'john@example.com',
      'Doe',
      'John',
      '0123456789',
      'admin'
    );

    // Act
    $result = $this->hydrator->hydratePostOperator($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'LoginID' => 'john@example.com',
      'UserName' => 'Doe',
      'FirstName' => 'John',
      'PhoneNumber' => '0123456789',
      'Email' => 'john@example.com',
      'UserRole' => 'admin'
    ]);
    $this->assertHydratedObjectPropertyCount($result, 6);
  }

  public function testHydrateGetOperator(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act
    $result = $this->hydrator->hydrateGetOperator($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkUserChild' => 123
    ]);
    $this->assertHydratedObjectPropertyCount($result, 1);
  }

  public function testHydrateGetOperatorStat(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(456);

    // Act
    $result = $this->hydrator->hydrateGetOperatorStat($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkUserChild' => 456
    ]);
    $this->assertHydratedObjectPropertyCount($result, 1);
  }

  public function testHydrateDeleteOperator(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(789);

    // Act
    $result = $this->hydrator->hydrateDeleteOperator($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkUserChild' => 789
    ]);
    $this->assertHydratedObjectPropertyCount($result, 1);
  }

  public function testHydratePutOperator(): void
  {
    // Arrange
    $inputDto = new PutOperatorInputDto(
      123,
      'jane@example.com',
      'Smith',
      'Jane',
      '0987654321',
      'user'
    );

    // Act
    $result = $this->hydrator->hydratePutOperator($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkUserChild' => 123,
      'LoginID' => 'jane@example.com',
      'UserName' => 'Smith',
      'FirstName' => 'Jane',
      'PhoneNumber' => '0987654321',
      'Email' => 'jane@example.com',
      'UserRole' => 'user'
    ]);
    $this->assertHydratedObjectPropertyCount($result, 7);
  }

  public function testHydratePatchOperator(): void
  {
    // Arrange
    $inputDto = new PatchOperatorInputDto(123, 'new_password');

    // Act
    $result = $this->hydrator->hydratePatchOperator($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkUserChild' => 123,
      'Password' => 'new_password'
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateCreateOperationImmeuble(): void
  {
    // Arrange
    $inputDto = new CreateOperationImmeubleInputDto(123, 456);

    // Act
    $result = $this->hydrator->hydrateCreateOperationImmeuble($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkUserChild' => 123,
      'PkImmeuble' => 456
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydratePatchOperatorImmeuble(): void
  {
    // Arrange
    $inputDto = new PatchOperatorImmeubleInputDto(123, 456);

    // Act
    $result = $this->hydrator->hydratePatchOperatorImmeuble($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkUserChild' => 123,
      'PkImmeuble' => 456
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateGetListOperatorsWithDifferentTypes(): void
  {
    // Arrange
    $inputDto1 = new ListOperatorsInputDto('admin');
    $inputDto2 = new ListOperatorsInputDto('user');
    $inputDto3 = new ListOperatorsInputDto('manager');

    // Act
    $result1 = $this->hydrator->hydrateGetListOperators($inputDto1);
    $result2 = $this->hydrator->hydrateGetListOperators($inputDto2);
    $result3 = $this->hydrator->hydrateGetListOperators($inputDto3);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, ['type' => 'admin']);
    $this->assertHydratedObjectHasProperties($result2, ['type' => 'user']);
    $this->assertHydratedObjectHasProperties($result3, ['type' => 'manager']);
  }

  public function testHydratePostOperatorWithDifferentData(): void
  {
    // Arrange
    $inputDto1 = new CreateOperatorInputDto(
      'user1@example.com',
      'Doe',
      'John',
      '0123456789',
      'admin'
    );
    $inputDto2 = new CreateOperatorInputDto(
      'user2@example.com',
      'Smith',
      'Jane',
      '0987654321',
      'user'
    );

    // Act
    $result1 = $this->hydrator->hydratePostOperator($inputDto1);
    $result2 = $this->hydrator->hydratePostOperator($inputDto2);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, [
      'LoginID' => 'user1@example.com',
      'UserName' => 'Doe',
      'FirstName' => 'John',
      'PhoneNumber' => '0123456789',
      'Email' => 'user1@example.com',
      'UserRole' => 'admin'
    ]);
    $this->assertHydratedObjectHasProperties($result2, [
      'LoginID' => 'user2@example.com',
      'UserName' => 'Smith',
      'FirstName' => 'Jane',
      'PhoneNumber' => '0987654321',
      'Email' => 'user2@example.com',
      'UserRole' => 'user'
    ]);
  }

  public function testAllMethodsReturnObjects(): void
  {
    // Arrange
    $listInput = new ListOperatorsInputDto('admin');
    $createInput = new CreateOperatorInputDto('test@example.com', 'Test', 'User', '0123456789', 'admin');
    $getInput = new GetByIdIntInputDto(123);
    $putInput = new PutOperatorInputDto(123, 'test@example.com', 'Test', 'User', '0123456789', 'admin');
    $patchInput = new PatchOperatorInputDto(123, 'password');
    $createOpInput = new CreateOperationImmeubleInputDto(123, 456);
    $patchOpInput = new PatchOperatorImmeubleInputDto(123, 456);

    // Act & Assert
    $this->assertIsObject($this->hydrator->hydrateGetListOperators($listInput));
    $this->assertIsObject($this->hydrator->hydratePostOperator($createInput));
    $this->assertIsObject($this->hydrator->hydrateGetOperator($getInput));
    $this->assertIsObject($this->hydrator->hydrateGetOperatorStat($getInput));
    $this->assertIsObject($this->hydrator->hydrateDeleteOperator($getInput));
    $this->assertIsObject($this->hydrator->hydratePutOperator($putInput));
    $this->assertIsObject($this->hydrator->hydratePatchOperator($patchInput));
    $this->assertIsObject($this->hydrator->hydrateCreateOperationImmeuble($createOpInput));
    $this->assertIsObject($this->hydrator->hydratePatchOperatorImmeuble($patchOpInput));
  }

  public function testHydratedObjectsAreConsistent(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act
    $result1 = $this->hydrator->hydrateGetOperator($inputDto);
    $result2 = $this->hydrator->hydrateGetOperator($inputDto);

    // Assert
    $this->assertEquals($result1, $result2);
  }

  public function testHydratedObjectsHaveCorrectPropertyTypes(): void
  {
    // Arrange
    $inputDto = new CreateOperatorInputDto(
      'test@example.com',
      'Test',
      'User',
      '0123456789',
      'admin'
    );

    // Act
    $result = $this->hydrator->hydratePostOperator($inputDto);

    // Assert
    $this->assertHydratedObjectPropertyTypes($result, [
      'LoginID' => 'string',
      'UserName' => 'string',
      'FirstName' => 'string',
      'PhoneNumber' => 'string',
      'Email' => 'string',
      'UserRole' => 'string'
    ]);
  }
}
