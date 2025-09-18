<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ListLeaksInputDto;
use App\Application\Dto\Output\Logement\ListLeaksOutputDto;

use App\Domain\Service\Soap\LogementSoapInterface;

final class ListLeaksUseCase
{
  public function __construct(private readonly LogementSoapInterface $service) {}

  public function execute(ListLeaksInputDto $inputDto): ListLeaksOutputDto
  {
    return $this->service->listLeaksService($inputDto);
  }
}
