<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

final class DocumentHydrator extends Hydrator
{
    public const LIVRET_INTER_LISTE = 'LIVRET_INTER_LISTE';

    public function hydrateGetExcel(string $reportType, array $paramsFiltres): object
    {
        if (self::LIVRET_INTER_LISTE === $reportType) {
            // Serialize params array to string format for SOAP
            $paramsFiltresString = $this->toParamsFiltresString($paramsFiltres);

            return (object) [
                'ReportType' => self::LIVRET_INTER_LISTE,
                'ParamsFiltres' => $paramsFiltresString,
            ];
        }

        $pkImmeuble = $paramsFiltres['PKIMMEUBLE'];
        unset($paramsFiltres['PKIMMEUBLE']);

        // Serialize params array to string format for SOAP
        $paramsFiltresString = $this->toParamsFiltresString($paramsFiltres);

        return (object) [
            'PkImmeuble' => $pkImmeuble,
            'ParamsFiltres' => $paramsFiltresString,
        ];
    }

    public function hydrateInsertPrintJobs(string $reportType, array $paramsFiltres): object
    {
        // Serialize params array to string format for SOAP
        $paramsFiltresString = $this->toParamsFiltresString($paramsFiltres);

        return (object) [
            'ReportType' => $reportType,
            'ParamsFiltres' => $paramsFiltresString,
        ];
    }
}
