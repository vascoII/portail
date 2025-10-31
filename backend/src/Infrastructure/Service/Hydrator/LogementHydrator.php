<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Logement\GetImmeubleIdAndLogementIdInputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

final class LogementHydrator extends Hydrator
{
    public function hydrateGetLogement(GetByIdIntInputDto $inputDto): object
    {
        return (object) [
            'PkLogement' => $inputDto->id,
            'PkOccupant' => $inputDto->pkOccupant ?? -1,
        ];
    }

    public function hydrateGetLogementCapteur(GetByIdIntInputDto $inputDto): object
    {
        return (object) [
            'PkLogement' => $inputDto->id,
            'PkOccupant' => $inputDto->pkOccupant ?? -1,
        ];
    }

    public function hydrateGetLogementCET(GetByIdIntInputDto $inputDto): object
    {
        return (object) [
            'PkLogement' => $inputDto->id,
            'PkOccupant' => $inputDto->pkOccupant ?? -1,
        ];
    }

    public function hydrateGetLogementEC(GetByIdIntInputDto $inputDto): object
    {
        return (object) [
            'PkLogement' => $inputDto->id,
            'PkOccupant' => $inputDto->pkOccupant ?? -1,
        ];
    }

    public function hydrateGetLogementEF(GetByIdIntInputDto $inputDto): object
    {
        return (object) [
            'PkLogement' => $inputDto->id,
            'PkOccupant' => $inputDto->pkOccupant ?? -1,
        ];
    }

    public function hydrateGetLogementElect(GetByIdIntInputDto $inputDto): object
    {
        return (object) [
            'PkLogement' => $inputDto->id,
            'PkOccupant' => $inputDto->pkOccupant ?? -1,
        ];
    }

    public function hydrateGetLogementGaz(GetByIdIntInputDto $inputDto): object
    {
        return (object) [
            'PkLogement' => $inputDto->id,
            'PkOccupant' => $inputDto->pkOccupant ?? -1,
        ];
    }

    public function hydrateGetLogementRepart(GetByIdIntInputDto $inputDto): object
    {
        return (object) [
            'PkLogement' => $inputDto->id,
            'PkOccupant' => $inputDto->pkOccupant ?? -1,
        ];
    }

    public function hydrateListAnomaliesByLogement(GetImmeubleIdAndLogementIdInputDto $inputDto): object
    {
        return (object) [
            'PkImmeuble' => $inputDto->pkImmeuble,
            'ParamsFiltres' => "PKLOGEMENT={$inputDto->pkLogement}",
        ];
    }

    public function hydrateListDysfonctionnementsByLogement(GetImmeubleIdAndLogementIdInputDto $inputDto): object
    {
        return (object) [
            'PkImmeuble' => $inputDto->pkImmeuble,
            'ParamsFiltres' => "PKLOGEMENT={$inputDto->pkLogement}",
        ];
    }

    public function hydrateListFuitesByLogement(GetImmeubleIdAndLogementIdInputDto $inputDto): object
    {
        return (object) [
            'PkImmeuble' => $inputDto->pkImmeuble,
            'ParamsFiltres' => "PKLOGEMENT={$inputDto->pkLogement}",
        ];
    }

    public function hydrateListInterventionsByLogement(GetImmeubleIdAndLogementIdInputDto $inputDto): object
    {
        return (object) [
            'PkImmeuble' => $inputDto->pkImmeuble,
            'ParamsFiltres' => "PKLOGEMENT={$inputDto->pkLogement}",
        ];
    }
}
