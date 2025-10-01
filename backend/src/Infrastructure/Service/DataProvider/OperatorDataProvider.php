<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\OperatorDataProviderInterface;
use App\Application\Dto\Input\Operator\IndexInputDto;
use App\Application\Dto\Output\Operator\IndexOutputDto;
use App\Application\Dto\Input\Operator\CreateInputDto;
use App\Application\Dto\Output\Operator\CreateOutputDto;
use App\Application\Dto\Input\Operator\AddBuildingInputDto;
use App\Application\Dto\Output\Operator\AddBuildingOutputDto;
use App\Application\Dto\Input\Operator\RemoveBuildingInputDto;
use App\Application\Dto\Output\Operator\RemoveBuildingOutputDto;
use App\Application\Dto\Input\Operator\ViewInputDto;
use App\Application\Dto\Output\Operator\ViewOutputDto;
use App\Application\Dto\Input\Operator\EditInputDto;
use App\Application\Dto\Output\Operator\EditOutputDto;
use App\Application\Dto\Input\Operator\EditPasswordInputDto;
use App\Application\Dto\Output\Operator\EditPasswordOutputDto;
use App\Application\Dto\Input\Operator\DeleteInputDto;
use App\Application\Dto\Output\Operator\DeleteOutputDto;
use App\Application\Dto\Input\Operator\OtatsoccupantsInputDto;
use App\Application\Dto\Output\Operator\OtatsoccupantsOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\OperatorDataSourceInterface;
use App\Infrastructure\Service\Redis\RedisService;
use App\Infrastructure\Transformer\OperatorTransformer;

final class OperatorDataProvider implements OperatorDataProviderInterface
{
  public function __construct(
    private RedisCacheService $cache,
    private OperatorDataSourceInterface $source,
    private OperatorTransformer $transformer,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function indexService(IndexInputDto $inputDto): IndexOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "operator_index:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof IndexOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->source->fetchIndex($inputDto);
    $dto = $this->transformer->transformIndex($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function createService(CreateInputDto $inputDto): CreateOutputDto
  {
    $rawData = $this->source->fetchCreate($inputDto);
    $dto = $this->transformer->transformCreate($rawData);

    return $dto;
  }

  public function addBuildingService(AddBuildingInputDto $inputDto): AddBuildingOutputDto
  {
    $rawData = $this->source->fetchAddBuilding($inputDto);
    $dto = $this->transformer->transformAddBuilding($rawData);

    return $dto;
  }

  public function removeBuildingService(RemoveBuildingInputDto $inputDto): RemoveBuildingOutputDto
  {
    $rawData = $this->source->fetchRemoveBuilding($inputDto);
    $dto = $this->transformer->transformRemoveBuilding($rawData);

    return $dto;
  }

  public function viewService(ViewInputDto $inputDto): ViewOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "operator_view:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ViewOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->source->fetchView($inputDto);
    $dto = $this->transformer->transformView($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function editService(EditInputDto $inputDto): EditOutputDto
  {
    $rawData = $this->source->fetchEdit($inputDto);
    $dto = $this->transformer->transformEdit($rawData);

    return $dto;
  }

  public function editPasswordService(EditPasswordInputDto $inputDto): EditPasswordOutputDto
  {
    $rawData = $this->source->fetchEditPassword($inputDto);
    $dto = $this->transformer->transformEditPassword($rawData);

    return $dto;
  }

  public function deleteService(DeleteInputDto $inputDto): DeleteOutputDto
  {
    $rawData = $this->source->fetchDelete($inputDto);
    $dto = $this->transformer->transformDelete($rawData);

    return $dto;
  }

  public function otatsoccupantsService(OtatsoccupantsInputDto $inputDto): OtatsoccupantsOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "operator_otatsoccupants:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof OtatsoccupantsOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->source->fetchOtatsoccupants($inputDto);
    $dto = $this->transformer->transformOtatsoccupants($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }
}
