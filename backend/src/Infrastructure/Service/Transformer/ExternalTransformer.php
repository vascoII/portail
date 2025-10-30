<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\External\GetReportByTokenDataSourceOutputDto;
use App\Application\Service\Transformer\ExternalTransformerInterface;

final class ExternalTransformer implements ExternalTransformerInterface
{
    /**
     * Transform raw response to GetReportByTokenDataSourceOutputDto.
     */
    public function transformGetReportByToken(string $dataSourceResult): GetReportByTokenDataSourceOutputDto
    {
        // Extract the ID from the SOAP response
        // Assuming the SOAP response is string
        $pdfContent = is_string($dataSourceResult) && !is_null($dataSourceResult)
        ? $dataSourceResult
        : null;

        return new GetReportByTokenDataSourceOutputDto(pdfContent: $pdfContent);
    }
}
