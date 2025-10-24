<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Input\Shared\GetByIdStringInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\DocumentDataProviderInterface;
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

        return $this->sharedTransformer->transformSuccess();
    }

    public function generateImmeubleDysfonctionnementsExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
    {
        $rawData = $this->documentDataSource->fetchImmeubleDysfonctionnements($inputDto);

        return $this->sharedTransformer->transformSuccess();
    }

    public function generateImmeubleFuitesExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
    {
        $rawData = $this->documentDataSource->fetchImmeubleFuites($inputDto);

        return $this->sharedTransformer->transformSuccess();
    }

    public function generateImmeubleInterventionsExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
    {
        $rawData = $this->documentDataSource->fetchImmeubleInterventions($inputDto);

        return $this->sharedTransformer->transformSuccess();
    }

    public function generateLogementAnomaliesExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
    {
        $rawData = $this->documentDataSource->fetchLogementAnomalies($inputDto);

        return $this->sharedTransformer->transformSuccess();
    }

    public function generateLogementDysfonctionnementsExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
    {
        $rawData = $this->documentDataSource->fetchLogementDysfonctionnements($inputDto);

        return $this->sharedTransformer->transformSuccess();
    }

    public function generateLogementFuitesExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
    {
        $rawData = $this->documentDataSource->fetchLogementFuites($inputDto);

        return $this->sharedTransformer->transformSuccess();
    }

    public function generateLogementInterventionsExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
    {
        $rawData = $this->documentDataSource->fetchLogementInterventions($inputDto);

        return $this->sharedTransformer->transformSuccess();
    }

    public function generateOccupantAnomaliesExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
    {
        $rawData = $this->documentDataSource->fetchOccupantAnomalies($inputDto);

        return $this->sharedTransformer->transformSuccess();
    }

    public function generateOccupantDysfonctionnementsExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
    {
        $rawData = $this->documentDataSource->fetchOccupantDysfonctionnements($inputDto);

        return $this->sharedTransformer->transformSuccess();
    }

    public function generateOccupantFuitesExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
    {
        $rawData = $this->documentDataSource->fetchOccupantFuites($inputDto);

        return $this->sharedTransformer->transformSuccess();
    }

    public function generateOccupantInterventionsExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto
    {
        $rawData = $this->documentDataSource->fetchOccupantInterventions($inputDto);

        return $this->sharedTransformer->transformSuccess();
    }
}
