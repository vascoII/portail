<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\DocumentDataProviderInterface;
use App\Application\Dto\Input\Shared\GetByIdStringInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataSource\DocumentDataSourceInterface;
use App\Application\Service\Transformer\SharedTransformerInterface;


final class DocumentDataProvider implements DocumentDataProviderInterface
{

  public function __construct(
    private DocumentDataSourceInterface $documentDataSource,
    private readonly SharedTransformerInterface $sharedTransformer
  ) {}

  public function generateImmeubleAnomaliesExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->documentDataSource->fetchImmeubleAnomalies($inputDto);
    $dto = $this->sharedTransformer->transformSuccess();

    return $dto;
  }

  public function generateImmeubleDysfonctionnementsExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->documentDataSource->fetchImmeubleDysfonctionnements($inputDto);
    $dto = $this->sharedTransformer->transformSuccess();

    return $dto;
  }

  public function generateImmeubleFuitesExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto

  {
    $rawData = $this->documentDataSource->fetchImmeubleFuites($inputDto);
    $dto = $this->sharedTransformer->transformSuccess();

    return $dto;
  }

  public function generateImmeubleInterventionsExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->documentDataSource->fetchImmeubleInterventions($inputDto);
    $dto = $this->sharedTransformer->transformSuccess();

    return $dto;
  }

  public function generateLogementAnomaliesExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->documentDataSource->fetchLogementAnomalies($inputDto);
    $dto = $this->sharedTransformer->transformSuccess();

    return $dto;
  }

  public function generateLogementDysfonctionnementsExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->documentDataSource->fetchLogementDysfonctionnements($inputDto);
    $dto = $this->sharedTransformer->transformSuccess();

    return $dto;
  }

  public function generateLogementFuitesExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->documentDataSource->fetchLogementFuites($inputDto);
    $dto = $this->sharedTransformer->transformSuccess();

    return $dto;
  }

  public function generateLogementInterventionsExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->documentDataSource->fetchLogementInterventions($inputDto);
    $dto = $this->sharedTransformer->transformSuccess();

    return $dto;
  }

  public function generateOccupantAnomaliesExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->documentDataSource->fetchOccupantAnomalies($inputDto);
    $dto = $this->sharedTransformer->transformSuccess();

    return $dto;
  }

  public function generateOccupantDysfonctionnementsExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->documentDataSource->fetchOccupantDysfonctionnements($inputDto);
    $dto = $this->sharedTransformer->transformSuccess();

    return $dto;
  }

  public function generateOccupantFuitesExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->documentDataSource->fetchOccupantFuites($inputDto);
    $dto = $this->sharedTransformer->transformSuccess();

    return $dto;
  }

  public function generateOccupantInterventionsExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
  {
    $rawData = $this->documentDataSource->fetchOccupantInterventions($inputDto);
    $dto = $this->sharedTransformer->transformSuccess();

    return $dto;
  }
}
