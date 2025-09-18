<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\FilterResultInputDto;
use App\Application\Dto\Output\Logement\FilterResultOutputDto;

use App\Domain\Service\Soap\LogementSoapInterface;

final class FilterResultUseCase
{
  public function __construct(private readonly LogementSoapInterface $service) {}

  public function execute(FilterResultInputDto $inputDto): FilterResultOutputDto
  {
    \assert($inputDto instanceof FilterResultInputDto);
    return new FilterResultOutputDto([]);
  }
}
