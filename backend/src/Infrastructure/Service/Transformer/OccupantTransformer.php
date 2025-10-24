<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\Transformer\OccupantTransformerInterface;

final class OccupantTransformer implements OccupantTransformerInterface
{
    public function transformGetOccupantIntervention(object $dataSourceResult): SuccessOutputDto
    {
        // TODO: Transform actual response when SOAP method is known
        return new SuccessOutputDto(true);
    }

    public function transformGetOccupantReleveEau(object $dataSourceResult): SuccessOutputDto
    {
        // TODO: Transform actual response when SOAP method is known
        return new SuccessOutputDto(true);
    }

    public function transformGetOccupantReleveNote(object $dataSourceResult): SuccessOutputDto
    {
        // TODO: Transform actual response when SOAP method is known
        return new SuccessOutputDto(true);
    }

    public function transformGetOccupantReleveRepart(object $dataSourceResult): SuccessOutputDto
    {
        // TODO: Transform actual response when SOAP method is known
        return new SuccessOutputDto(true);
    }
}
