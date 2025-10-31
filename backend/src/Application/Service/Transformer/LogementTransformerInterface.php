<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Logement\ListLogementsOuputDto;
use App\Application\Dto\Output\Logement\LogementOutputDto;
use App\Application\Dto\Output\Shared\ListIndicatorsOuputDto;

interface LogementTransformerInterface
{
    public function transformGetLogement(object $dataSourceResult): LogementOutputDto;

    public function transformGetLogementCapteur(object $dataSourceResult): ListIndicatorsOuputDto;

    public function transformGetLogementCET(object $dataSourceResult): ListIndicatorsOuputDto;

    public function transformGetLogementEC(object $dataSourceResult): ListIndicatorsOuputDto;

    public function transformGetLogementEF(object $dataSourceResult): ListIndicatorsOuputDto;

    public function transformGetLogementRepart(object $dataSourceResult): ListIndicatorsOuputDto;

    public function transformListLogements(object $dataSourceResult): ListLogementsOuputDto;
}
