<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Input\Shared\GetByEnergyStringInputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Input\Occupant\PatchOccupantInputDto;
use App\Application\Dto\Input\Occupant\PostOccupantInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;
use App\Application\Service\DataSource\OccupantDataSourceInterface;
use App\Application\Service\Transformer\OccupantTransformerInterface;

final class OccupantDataProvider implements OccupantDataProviderInterface
{
    public function __construct(
        private readonly OccupantDataSourceInterface $dataSource,
        private readonly OccupantTransformerInterface $transformer
    ) {}

    public function getOccupantInterventionService(GetByIdIntInputDto $inputDto): SuccessOutputDto
    {
        $rawData = $this->dataSource->fetchGetOccupantIntervention($inputDto);

        return $this->transformer->transformGetOccupantIntervention($rawData);
    }

    public function getOccupantReleveEauService(): SuccessOutputDto
    {
        $rawData = $this->dataSource->fetchGetOccupantReleveEau();

        return $this->transformer->transformGetOccupantReleveEau($rawData);
    }

    public function getOccupantReleveNoteService(GetByEnergyStringInputDto $inputDto): SuccessOutputDto
    {
        $rawData = $this->dataSource->fetchGetOccupantReleveNote($inputDto);

        return $this->transformer->transformGetOccupantReleveNote($rawData);
    }

    public function getOccupantReleveRepartService(): SuccessOutputDto
    {
        $rawData = $this->dataSource->fetchGetOccupantReleveRepart();

        return $this->transformer->transformGetOccupantReleveRepart($rawData);
    }

    public function patchOccupantService(PatchOccupantInputDto $inputDto): SuccessOutputDto
    {
        return new SuccessOutputDto(true);
    }

    public function postOccupantService(PostOccupantInputDto $inputDto): SuccessOutputDto
    {
        return new SuccessOutputDto(true);
    }

    public function listFuitesByOccupantService(): SuccessOutputDto
    {
        return new SuccessOutputDto(true);
    }
}
