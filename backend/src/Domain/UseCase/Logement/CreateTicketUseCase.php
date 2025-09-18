<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\CreateTicketInputDto;
use App\Application\Dto\Output\Logement\CreateTicketOutputDto;

use App\Domain\Service\Soap\LogementSoapInterface;

final class CreateTicketUseCase
{
  public function __construct(private readonly LogementSoapInterface $service) {}

  public function execute(CreateTicketInputDto $inputDto): CreateTicketOutputDto
  {
    return $this->service->createTicketService($inputDto);
  }
}
