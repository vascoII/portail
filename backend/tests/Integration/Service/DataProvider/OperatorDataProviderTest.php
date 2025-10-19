<?php

declare(strict_types=1);

namespace App\Tests\Integration\Service\DataProvider;

use App\Infrastructure\Service\DataProvider\OperatorDataProvider;
use App\Application\Service\DataSource\OperatorDataSourceInterface;
use App\Application\Service\Transformer\OperatorTransformerInterface;
use App\Application\Service\Transformer\SharedTransformerInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Redis\RedisService;
use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Input\Operator\CreateOperatorInputDto;
use App\Application\Dto\Input\Operator\CreateOperationImmeubleInputDto;
use App\Application\Dto\Input\Operator\PatchOperatorImmeubleInputDto;
use App\Application\Dto\Input\Operator\PutOperatorInputDto;
use App\Application\Dto\Input\Operator\PatchOperatorInputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Operator\ListOperatorsOutputDto;
use App\Application\Dto\Output\Operator\GetOperatorOutputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;

class OperatorDataProviderTest extends BaseDataProviderTest
{
  private RedisService $cache;
  private OperatorDataSourceInterface $dataSource;
  private OperatorTransformerInterface $operatorTransformer;
  private SharedTransformerInterface $sharedTransformer;
  private AuthServiceInterface $authService;
  private OperatorDataProvider $dataProvider;

  protected function setUp(): void
  {
    $this->cache = $this->createCacheServiceMock();
    $this->dataSource = $this->createDataSourceMock(OperatorDataSourceInterface::class);
    $this->operatorTransformer = $this->createTransformerMock(OperatorTransformerInterface::class);
    $this->sharedTransformer = $this->createTransformerMock(SharedTransformerInterface::class);
    $this->authService = $this->createAuthServiceMock();

    $this->dataProvider = new OperatorDataProvider(
      $this->cache,
      $this->dataSource,
      $this->operatorTransformer,
      $this->sharedTransformer,
      $this->authService
    );
  }

  public function testListOperatorsService(): void
  {
    // Arrange
    $inputDto = new ListOperatorsInputDto('active');
    $authContext = $this->createTestAuthContext();
    $rawData = $this->createDataSourceResult(['operators' => []]);
    $expectedOutput = new ListOperatorsOutputDto([]);

    $this->authService
      ->shouldReceive('getCurrentSessionId')
      ->andReturn('test_session_123');

    $this->authService
      ->shouldReceive('getCurrentUser')
      ->andReturn($this->createTestUserDto());

    $this->cache
      ->shouldReceive('get')
      ->with("operator_list:123")
      ->once()
      ->andReturn(null);

    $this->dataSource
      ->shouldReceive('fetchGetOperators')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->operatorTransformer
      ->shouldReceive('transformListOperators')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    $this->cache
      ->shouldReceive('set')
      ->with("operator_list:123", $expectedOutput)
      ->once();

    // Act
    $result = $this->dataProvider->listOperatorsService($inputDto);

    // Assert
    $this->assertResultType($result, ListOperatorsOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testListOperatorsServiceWithCache(): void
  {
    // Arrange
    $inputDto = new ListOperatorsInputDto('active');
    $cachedOutput = new ListOperatorsOutputDto([]);

    $this->authService
      ->shouldReceive('getCurrentSessionId')
      ->andReturn('test_session_123');

    $this->authService
      ->shouldReceive('getCurrentUser')
      ->andReturn($this->createTestUserDto());

    $this->cache
      ->shouldReceive('get')
      ->with("operator_list:123")
      ->once()
      ->andReturn($cachedOutput);

    // Act
    $result = $this->dataProvider->listOperatorsService($inputDto);

    // Assert
    $this->assertResultType($result, ListOperatorsOutputDto::class);
    $this->assertEquals($cachedOutput, $result);
  }

  public function testCreateOperatorService(): void
  {
    // Arrange
    $inputDto = new CreateOperatorInputDto('test@example.com', 'Doe', 'John', '123456789', 'Manager');
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchPostOperator')
      ->with($inputDto)
      ->once()
      ->andReturn(true);

    $this->sharedTransformer
      ->shouldReceive('transformPost')
      ->with(true)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->createOperatorService($inputDto);

    // Assert
    $this->assertResultType($result, SuccessOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testGetOperatorService(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);
    $rawData = $this->createDataSourceResult(['operator' => ['id' => 123, 'name' => 'Test Operator']]);
    $expectedOutput = new GetOperatorOutputDto('John Doe', 'test@example.com', 'admin', 123, '123 Main St', '12345', 'City', 1, '1234567890', 'John', 'admin', 'Client Name', 'client123', 'accepted', 1, 1, 5, 100, 200, 300, 400, true, 'test@example.com', true, true, true, true);

    $this->cache
      ->shouldReceive('get')
      ->with("operator_get:123")
      ->once()
      ->andReturn(null);

    $this->dataSource
      ->shouldReceive('fetchGetOperator')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->operatorTransformer
      ->shouldReceive('transformGetOperator')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    $this->cache
      ->shouldReceive('set')
      ->with("operator_get:123", $expectedOutput)
      ->once();

    // Act
    $result = $this->dataProvider->getOperatorService($inputDto);

    // Assert
    $this->assertResultType($result, GetOperatorOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testGetOperatorServiceWithCache(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);
    $cachedOutput = new GetOperatorOutputDto('John Doe', 'test@example.com', 'admin', 123, '123 Main St', '12345', 'City', 1, '1234567890', 'John', 'admin', 'Client Name', 'client123', 'accepted', 1, 1, 5, 100, 200, 300, 400, true, 'test@example.com', true, true, true, true);

    $this->cache
      ->shouldReceive('get')
      ->with("operator_get:123")
      ->once()
      ->andReturn($cachedOutput);

    // Act
    $result = $this->dataProvider->getOperatorService($inputDto);

    // Assert
    $this->assertResultType($result, GetOperatorOutputDto::class);
    $this->assertEquals($cachedOutput, $result);
  }

  public function testCreateOperationImmeubleService(): void
  {
    // Arrange
    $inputDto = new CreateOperationImmeubleInputDto(123, 456);
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchCreateOperationImmeuble')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->operatorTransformer
      ->shouldReceive('transformCreateOperationImmeuble')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->createOperationImmeubleService($inputDto);

    // Assert
    $this->assertResultType($result, SuccessOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testPatchOperatorImmeubleService(): void
  {
    // Arrange
    $inputDto = new PatchOperatorImmeubleInputDto(123, 456, 'active');
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchPatchOperatorImmeuble')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->operatorTransformer
      ->shouldReceive('transformPatchOperatorImmeuble')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->patchOperatorImmeubleService($inputDto);

    // Assert
    $this->assertResultType($result, SuccessOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testPutOperatorService(): void
  {
    // Arrange
    $inputDto = new PutOperatorInputDto(123, 'updated@example.com', 'Smith', 'Jane', '987654321', 'Senior Manager');
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchPutOperator')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->sharedTransformer
      ->shouldReceive('transformPut')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->putOperatorService($inputDto);

    // Assert
    $this->assertResultType($result, SuccessOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testPatchOperatorService(): void
  {
    // Arrange
    $inputDto = new PatchOperatorInputDto(123, 'Updated Name');
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchPatchOperator')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->sharedTransformer
      ->shouldReceive('transformPatch')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->patchOperatorService($inputDto);

    // Assert
    $this->assertResultType($result, SuccessOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testDeleteOperatorService(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchDeleteOperator')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->sharedTransformer
      ->shouldReceive('transformDelete')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->deleteOperatorService($inputDto);

    // Assert
    $this->assertResultType($result, SuccessOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testGetOperatorStatService(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);
    $rawData = $this->createDataSourceResult(['stats' => ['total' => 100]]);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchGetOperatorStat')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->operatorTransformer
      ->shouldReceive('transformGetOperatorStat')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getOperatorStatService($inputDto);

    // Assert
    $this->assertResultType($result, SuccessOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testCacheIntegration(): void
  {
    // Arrange
    $inputDto = new ListOperatorsInputDto('active');
    $rawData = $this->createDataSourceResult(['operators' => []]);
    $expectedOutput = new ListOperatorsOutputDto([]);

    $this->authService
      ->shouldReceive('getCurrentSessionId')
      ->andReturn('test_session_123');

    $this->authService
      ->shouldReceive('getCurrentUser')
      ->andReturn($this->createTestUserDto());

    // First call - should fetch from data source and cache
    $this->cache
      ->shouldReceive('get')
      ->with("operator_list:123")
      ->once()
      ->andReturn(null);

    $this->dataSource
      ->shouldReceive('fetchGetOperators')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->operatorTransformer
      ->shouldReceive('transformListOperators')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    $this->cache
      ->shouldReceive('set')
      ->with("operator_list:123", $expectedOutput)
      ->once();

    // Second call - should return from cache
    $this->authService
      ->shouldReceive('getCurrentSessionId')
      ->andReturn('test_session_123');

    $this->authService
      ->shouldReceive('getCurrentUser')
      ->andReturn($this->createTestUserDto());

    $this->cache
      ->shouldReceive('get')
      ->with("operator_list:123")
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result1 = $this->dataProvider->listOperatorsService($inputDto);
    $result2 = $this->dataProvider->listOperatorsService($inputDto);

    // Assert
    $this->assertEquals($result1, $result2);
    $this->assertResultType($result1, ListOperatorsOutputDto::class);
    $this->assertResultType($result2, ListOperatorsOutputDto::class);
  }

  public function testAllMethodsReturnCorrectTypes(): void
  {
    // Arrange
    $listInput = new ListOperatorsInputDto('active');
    $createInput = new CreateOperatorInputDto('test@example.com', 'Doe', 'John', '123456789', 'Manager');
    $getInput = new GetByIdIntInputDto(123);
    $createOpInput = new CreateOperationImmeubleInputDto(123, 456);
    $patchOpInput = new PatchOperatorImmeubleInputDto(123, 456, 'active');
    $putInput = new PutOperatorInputDto(123, 'test@example.com', 'Smith', 'Jane', '987654321', 'Senior Manager');
    $patchInput = new PatchOperatorInputDto(123, 'Test');

    // Setup common mocks
    $this->authService->shouldReceive('getCurrentSessionId')->andReturn('test_session_123');
    $this->authService->shouldReceive('getCurrentUser')->andReturn($this->createTestUserDto());
    $this->cache->shouldReceive('get')->andReturn(null);
    $this->cache->shouldReceive('set');
    $this->dataSource->shouldReceive('fetchGetOperators')->andReturn($this->createDataSourceResult([]));
    $this->dataSource->shouldReceive('fetchPostOperator')->andReturn(true);
    $this->dataSource->shouldReceive('fetchGetOperator')->andReturn($this->createDataSourceResult([]));
    $this->dataSource->shouldReceive('fetchCreateOperationImmeuble')->andReturn($this->createDataSourceResult([]));
    $this->dataSource->shouldReceive('fetchPatchOperatorImmeuble')->andReturn($this->createDataSourceResult([]));
    $this->dataSource->shouldReceive('fetchPutOperator')->andReturn($this->createDataSourceResult([]));
    $this->dataSource->shouldReceive('fetchPatchOperator')->andReturn($this->createDataSourceResult([]));
    $this->dataSource->shouldReceive('fetchDeleteOperator')->andReturn($this->createDataSourceResult([]));
    $this->dataSource->shouldReceive('fetchGetOperatorStat')->andReturn($this->createDataSourceResult([]));

    $this->operatorTransformer->shouldReceive('transformListOperators')->andReturn(new ListOperatorsOutputDto([]));
    $this->operatorTransformer->shouldReceive('transformGetOperator')->andReturn(new GetOperatorOutputDto('John Doe', 'test@example.com', 'admin', 123, '123 Main St', '12345', 'City', 1, '1234567890', 'John', 'admin', 'Client Name', 'client123', 'accepted', 1, 1, 5, 100, 200, 300, 400, true, 'test@example.com', true, true, true, true));
    $this->operatorTransformer->shouldReceive('transformCreateOperationImmeuble')->andReturn(new SuccessOutputDto(true));
    $this->operatorTransformer->shouldReceive('transformPatchOperatorImmeuble')->andReturn(new SuccessOutputDto(true));
    $this->operatorTransformer->shouldReceive('transformGetOperatorStat')->andReturn(new SuccessOutputDto(true));

    $this->sharedTransformer->shouldReceive('transformPost')->andReturn(new SuccessOutputDto(true));
    $this->sharedTransformer->shouldReceive('transformPut')->andReturn(new SuccessOutputDto(true));
    $this->sharedTransformer->shouldReceive('transformPatch')->andReturn(new SuccessOutputDto(true));
    $this->sharedTransformer->shouldReceive('transformDelete')->andReturn(new SuccessOutputDto(true));

    // Act & Assert
    $this->assertResultType($this->dataProvider->listOperatorsService($listInput), ListOperatorsOutputDto::class);
    $this->assertResultType($this->dataProvider->createOperatorService($createInput), SuccessOutputDto::class);
    $this->assertResultType($this->dataProvider->getOperatorService($getInput), GetOperatorOutputDto::class);
    $this->assertResultType($this->dataProvider->createOperationImmeubleService($createOpInput), SuccessOutputDto::class);
    $this->assertResultType($this->dataProvider->patchOperatorImmeubleService($patchOpInput), SuccessOutputDto::class);
    $this->assertResultType($this->dataProvider->putOperatorService($putInput), SuccessOutputDto::class);
    $this->assertResultType($this->dataProvider->patchOperatorService($patchInput), SuccessOutputDto::class);
    $this->assertResultType($this->dataProvider->deleteOperatorService($getInput), SuccessOutputDto::class);
    $this->assertResultType($this->dataProvider->getOperatorStatService($getInput), SuccessOutputDto::class);
  }
}
