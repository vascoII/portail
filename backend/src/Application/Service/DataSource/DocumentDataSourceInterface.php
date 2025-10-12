<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Shared\GetByIdStringInputDto;

interface DocumentDataSourceInterface
{
  public function fetchImmeubleAnomalies(GetByIdStringInputDto $inputDto): bool;
  public function fetchImmeubleDysfonctionnements(GetByIdStringInputDto $inputDto): bool;
  public function fetchImmeubleFuites(GetByIdStringInputDto $inputDto): bool;
  public function fetchImmeubleInterventions(GetByIdStringInputDto $inputDto): bool;
  public function fetchLogementAnomalies(GetByIdStringInputDto $inputDto): bool;
  public function fetchLogementDysfonctionnements(GetByIdStringInputDto $inputDto): bool;
  public function fetchLogementFuites(GetByIdStringInputDto $inputDto): bool;
  public function fetchLogementInterventions(GetByIdStringInputDto $inputDto): bool;
}
