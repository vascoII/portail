<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\GetTicketOnwerInputDto;
use App\Application\Dto\Output\Logement\GetTicketOnwerOutputDto;

use App\Domain\Service\Soap\LogementSoapInterface;

final class GetTicketOnwerUseCase
{
  public function __construct(private readonly LogementSoapInterface $service) {}

  public function execute(GetTicketOnwerInputDto $inputDto): GetTicketOnwerOutputDto
  {
    return $this->service->getTicketOnwerService($inputDto);
  }
}
