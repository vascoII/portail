<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Output\Operator\ListOperatorsOutputDto;
use App\Application\Dto\Input\Operator\CreateOperatorInputDto;
use App\Application\Service\DataProvider\OperatorDataProviderInterface;
use App\Application\Dto\Output\Shared\SuccessOutputDto;

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

  public function listOperators(ListOperatorsInputDto $inputDto): ListOperatorsOutputDto
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

}
