<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\IndexInputDto;
use App\Application\Dto\Output\Logement\IndexOutputDto;

use App\Domain\Service\Soap\LogementSoapInterface;

final class IndexUseCase
{
  public function __construct(private readonly LogementSoapInterface $service) {}

  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    \assert($inputDto instanceof IndexInputDto);
    return new IndexOutputDto([]);
  }
}
