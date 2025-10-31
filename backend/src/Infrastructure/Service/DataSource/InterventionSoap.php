<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Intervention\GetCasesByEmailInpuDto;
use App\Application\Service\DataSource\InterventionDataSourceInterface;
use App\Infrastructure\Service\Hydrator\InterventionHydrator;

final class InterventionSoap extends Soap implements InterventionDataSourceInterface
{
    public function __construct(
        SoapClient $soapClient,
        private readonly InterventionHydrator $hydrator,
    ) {
        parent::__construct($soapClient);
    }

    public function fetchGetCases(GetCasesByEmailInpuDto $inputDto): object
    {
        $soapRequest = $this->hydrator->hydrateGetCases($inputDto);

        return $this->safeCall('getCase', $soapRequest);
    }
}
