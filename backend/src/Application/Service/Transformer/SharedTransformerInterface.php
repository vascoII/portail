<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Dto\Output\Shared\ListAlertesOuputDto;
use App\Application\Dto\Output\Shared\ListAnomaliesOuputDto;
use App\Application\Dto\Output\Shared\ListDysfonctionnementsOuputDto;
use App\Application\Dto\Output\Shared\ListFuitesOutputDto;
use App\Application\Dto\Output\Shared\ListInterventionsOutputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Dto\Output\Shared\UserDto;

interface SharedTransformerInterface
{
    public function transformDelete(object $dataSourceResult): SuccessOutputDto;

    public function transformGetReport(string $dataSourceResult, string $filename): GetReportOutputDto;

    public function transformGetUser(object $dataSourceResult): UserDto;

    public function transformListAlertes(object $dataSourceResult): ListAlertesOuputDto;

    public function transformListAnomalies(object $dataSourceResult): ListAnomaliesOuputDto;

    public function transformListDysfonctionnements(object $dataSourceResult): ListDysfonctionnementsOuputDto;

    public function transformListFuites(object $dataSourceResult): ListFuitesOutputDto;

    public function transformListInterventions(object $dataSourceResult): ListInterventionsOutputDto;

    public function transformPatch(object $dataSourceResult): SuccessOutputDto;

    public function transformPost(bool $dataSourceResult): SuccessOutputDto;

    public function transformPut(object $dataSourceResult): SuccessOutputDto;

    public function transformSuccess(): SuccessOutputDto;
}
