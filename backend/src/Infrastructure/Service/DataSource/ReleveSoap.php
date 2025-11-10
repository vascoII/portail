<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Releve\GenerateReleveInputDto;
use App\Application\Service\DataSource\ReleveDataSourceInterface;
use App\Infrastructure\Service\Hydrator\ReleveHydrator;

final class ReleveSoap extends Soap implements ReleveDataSourceInterface
{
    public function __construct(
        SoapClient $soapClient,
        private readonly ReleveHydrator $hydrator
    ) {
        parent::__construct($soapClient);
    }

    public function fetchPostReleve(GenerateReleveInputDto $inputDto): object
    {
        $soapRequest = $this->hydrator->hydratePostReleve($inputDto);

        return $this->safeCall('setReleveOccupant', $soapRequest);
    }
}
