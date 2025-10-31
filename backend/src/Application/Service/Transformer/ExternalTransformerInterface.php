<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\External\GetReportByTokenDataSourceOutputDto;

interface ExternalTransformerInterface
{
    /**
     * Transform raw response to GetReportByTokenDataSourceOutputDto.
     */
    public function transformGetReportByToken(string $dataSourceResult): GetReportByTokenDataSourceOutputDto;
}
