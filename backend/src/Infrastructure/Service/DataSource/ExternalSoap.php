<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Shared\GetByIdStringInputDto;
use App\Application\Service\DataSource\ExternalDataSourceInterface;
use App\Infrastructure\Service\Hydrator\ExternalHydrator;

final class ExternalSoap extends Soap implements ExternalDataSourceInterface
{
    public function __construct(
        SoapClient $soapClient,
        private readonly ExternalHydrator $hydrator
    ) {
        parent::__construct($soapClient);
    }

    public function fetchGetReportByToken(GetByIdStringInputDto $inputDto): string
    {
        $soapRequest = $this->hydrator->hydrateGetReportByToken($inputDto);

        return $this->safeCall('GetReportByToken', $soapRequest);
    }
}
