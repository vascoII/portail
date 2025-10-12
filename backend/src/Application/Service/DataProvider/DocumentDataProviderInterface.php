<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Shared\GetByIdStringInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;

interface DocumentDataProviderInterface
{
  public function generateImmeubleAnomaliesExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto;
  public function generateImmeubleDysfonctionnementsExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto;
  public function generateImmeubleFuitesExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto;
  public function generateImmeubleInterventionsExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto;
  public function generateLogementAnomaliesExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto;
  public function generateLogementDysfonctionnementsExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto;
  public function generateLogementFuitesExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto;
  public function generateLogementInterventionsExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto;
  public function generateOccupantAnomaliesExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto;
  public function generateOccupantDysfonctionnementsExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto;
  public function generateOccupantFuitesExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto;
  public function generateOccupantInterventionsExcelService(GetByIdStringInputDto $inputDto): SuccessOutputDto;
}
