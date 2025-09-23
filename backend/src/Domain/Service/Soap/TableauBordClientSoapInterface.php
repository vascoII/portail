<?php

declare(strict_types=1);

namespace App\Domain\Service\Soap;

use App\Application\Dto\Input\TableauBordClient\IndexInputDto;
use App\Application\Dto\Input\TableauBordClient\InterventionInputDto;

interface TableauBordClientSoapInterface
{

  public function indexService(IndexInputDto $inputDto): array;
  public function interventionService(InterventionInputDto $inputDto): array;
}
