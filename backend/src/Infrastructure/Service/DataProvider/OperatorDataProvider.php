<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Output\Operator\ListOperatorsOutputDto;
use App\Application\Dto\Input\Operator\CreateOperatorInputDto;
use App\Application\Dto\Input\Operator\CreateOperationImmeubleInputDto;
use App\Application\Dto\Input\Operator\PatchOperatorImmeubleInputDto;
use App\Application\Dto\Input\Operator\PutOperatorInputDto;
use App\Application\Dto\Input\Operator\PatchOperatorInputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Operator\GetOperatorOutputDto;

use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\OperatorDataSourceInterface;
use App\Infrastructure\Service\Redis\RedisService;
use App\Application\Service\Transformer\OperatorTransformerInterface;
use App\Application\Service\Transformer\SharedTransformerInterface;

final class OperatorDataProvider implements OperatorDataProviderInterface
{
  public function __construct(
    private RedisService $cache,
    private OperatorDataSourceInterface $operatorDataSource,
    private OperatorTransformerInterface $operatorTransformer,
    private SharedTransformerInterface $sharedTransformer,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function listOperatorsService(ListOperatorsInputDto $inputDto): ListOperatorsOutputDto
  {
    $authContext = $this->getAuthContext();

    $cacheKey = "operator_list:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ListOperatorsOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->operatorDataSource->fetchGetOperators($inputDto);
    $dto = $this->operatorTransformer->transformListOperators($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function createOperatorService(CreateOperatorInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->operatorDataSource->fetchPostOperator($inputDto);
    $dto = $this->sharedTransformer->transformPost($rawData);

    return $dto;
  }

  public function createOperationImmeubleService(CreateOperationImmeubleInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->operatorDataSource->fetchCreateOperationImmeuble($inputDto);
    return $this->operatorTransformer->transformCreateOperationImmeuble($rawData);
  }

  public function patchOperatorImmeubleService(PatchOperatorImmeubleInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->operatorDataSource->fetchPatchOperatorImmeuble($inputDto);
    return $this->operatorTransformer->transformPatchOperatorImmeuble($rawData);
  }

  public function getOperatorService(GetByIdIntInputDto $inputDto): GetOperatorOutputDto
  {
    $cacheKey = "operator_get:$inputDto->id";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetOperatorOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->operatorDataSource->fetchGetOperator($inputDto);
    $dto = $this->operatorTransformer->transformGetOperator($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function getOperatorStatService(GetByIdIntInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->operatorDataSource->fetchGetOperatorStat($inputDto);
    return $this->operatorTransformer->transformGetOperatorStat($rawData);
  }

  public function putOperatorService(PutOperatorInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->operatorDataSource->fetchPutOperator($inputDto);
    $dto = $this->sharedTransformer->transformPut($rawData);

    return $dto;
  }

  public function patchOperatorService(PatchOperatorInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->operatorDataSource->fetchPatchOperator($inputDto);
    $dto = $this->sharedTransformer->transformPatch($rawData);

    return $dto;
  }

  public function  deleteOperatorService(GetByIdIntInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->operatorDataSource->fetchDeleteOperator($inputDto);
    $dto = $this->sharedTransformer->transformDelete($rawData);

    return $dto;
  }
}
