<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Transformer;

use App\Infrastructure\Service\Transformer\OperatorTransformer;
use App\Application\Factory\Shared\SharedEntityFactory;
use App\Application\Factory\Operator\OperatorOutputFactory;
use App\Application\Dto\Output\Operator\ListOperatorsOutputDto;
use App\Application\Dto\Output\Operator\GetOperatorOutputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Domain\Entity\User;

class OperatorTransformerTest extends BaseTransformerTest
{
  private OperatorTransformer $transformer;
  private SharedEntityFactory|MockInterface $entityFactory;
  private OperatorOutputFactory|MockInterface $outputFactory;

  protected function setUp(): void
  {
    $this->entityFactory = $this->createFactoryMock(SharedEntityFactory::class);
    $this->outputFactory = $this->createFactoryMock(OperatorOutputFactory::class);
    $this->transformer = new OperatorTransformer($this->entityFactory, $this->outputFactory);
  }

  public function testTransformListOperatorsWithArray(): void
  {
    // Arrange
    $operatorsRaw = [
      (object) ['id' => 1, 'name' => 'Operator 1'],
      (object) ['id' => 2, 'name' => 'Operator 2']
    ];
    $dataSourceResult = $this->createDataSourceResult([
      'ListeUsers' => (object) ['user' => $operatorsRaw]
    ]);

    $entities = [
      $this->createEntityMock(User::class),
      $this->createEntityMock(User::class)
    ];
    $expectedOutput = $this->createDtoMock(ListOperatorsOutputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createManyUsersFromRawList')
      ->with($operatorsRaw)
      ->willReturn($entities);

    $this->outputFactory
      ->expects($this->once())->method('createListOperators')
      ->with($entities)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformListOperators($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformListOperatorsWithSingleObject(): void
  {
    // Arrange
    $operatorRaw = (object) ['id' => 1, 'name' => 'Operator 1'];
    $dataSourceResult = $this->createDataSourceResult([
      'ListeUsers' => (object) ['user' => $operatorRaw]
    ]);

    $entities = [$this->createEntityMock(User::class)];
    $expectedOutput = $this->createDtoMock(ListOperatorsOutputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createManyUsersFromRawList')
      ->with([$operatorRaw])
      ->willReturn($entities);

    $this->outputFactory
      ->expects($this->once())->method('createListOperators')
      ->with($entities)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformListOperators($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformListOperatorsWithNull(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'ListeUsers' => (object) ['user' => null]
    ]);

    $expectedOutput = $this->createDtoMock(ListOperatorsOutputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createManyUsersFromRawList')
      ->with([])
      ->willReturn([]);

    $this->outputFactory
      ->expects($this->once())->method('createListOperators')
      ->with([])
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformListOperators($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformGetOperator(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'id' => 1,
      'name' => 'Test Operator'
    ]);

    $entity = $this->createEntityMock(User::class);
    $expectedOutput = $this->createDtoMock(GetOperatorOutputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createUserFromRaw')
      ->with($dataSourceResult)
      ->willReturn($entity);

    $this->outputFactory
      ->expects($this->once())->method('createGetOperator')
      ->with($entity)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformGetOperator($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformGetOperatorStat(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'stat' => 'some_stat_data'
    ]);

    // Act
    $result = $this->transformer->transformGetOperatorStat($dataSourceResult);

    // Assert
    $this->assertInstanceOf(SuccessOutputDto::class, $result);
    $this->assertTrue($result->bool);
  }

  public function testTransformCreateOperationImmeuble(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'operation' => 'create_operation_data'
    ]);

    // Act
    $result = $this->transformer->transformCreateOperationImmeuble($dataSourceResult);

    // Assert
    $this->assertInstanceOf(SuccessOutputDto::class, $result);
    $this->assertTrue($result->bool);
  }

  public function testTransformPatchOperatorImmeuble(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'patch' => 'patch_operation_data'
    ]);

    // Act
    $result = $this->transformer->transformPatchOperatorImmeuble($dataSourceResult);

    // Assert
    $this->assertInstanceOf(SuccessOutputDto::class, $result);
    $this->assertTrue($result->bool);
  }

  public function testTransformListOperatorsWithComplexData(): void
  {
    // Arrange
    $operatorsRaw = [
      (object) [
        'id' => 1,
        'name' => 'Operator 1',
        'email' => 'operator1@example.com',
        'role' => 'admin',
        'active' => true
      ],
      (object) [
        'id' => 2,
        'name' => 'Operator 2',
        'email' => 'operator2@example.com',
        'role' => 'user',
        'active' => false
      ]
    ];
    $dataSourceResult = $this->createDataSourceResult([
      'ListeUsers' => (object) ['user' => $operatorsRaw]
    ]);

    $entities = [
      $this->createEntityMock(User::class),
      $this->createEntityMock(User::class)
    ];
    $expectedOutput = $this->createDtoMock(ListOperatorsOutputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createManyUsersFromRawList')
      ->with($operatorsRaw)
      ->willReturn($entities);

    $this->outputFactory
      ->expects($this->once())->method('createListOperators')
      ->with($entities)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformListOperators($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformGetOperatorWithComplexData(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'id' => 123,
      'name' => 'Complex Operator',
      'email' => 'complex@example.com',
      'role' => 'admin',
      'active' => true,
      'createdAt' => '2023-01-01 00:00:00',
      'updatedAt' => '2023-12-31 23:59:59',
      'permissions' => ['read', 'write', 'delete']
    ]);

    $entity = $this->createEntityMock(User::class);
    $expectedOutput = $this->createDtoMock(GetOperatorOutputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createUserFromRaw')
      ->with($dataSourceResult)
      ->willReturn($entity);

    $this->outputFactory
      ->expects($this->once())->method('createGetOperator')
      ->with($entity)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformGetOperator($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }
}
