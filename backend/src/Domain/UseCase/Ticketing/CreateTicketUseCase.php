<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\CreateTicketInputDto;
use App\Application\Dto\Output\Ticketing\CreateTicketOutputDto;
use App\Infrastructure\Transformer\TicketingTransformer;
use App\Domain\Service\Soap\TicketingSoapInterface;

final class CreateTicketUseCase
{
  public function __construct(
    private readonly TicketingSoapInterface $service,
    private readonly TicketingTransformer $transformer
  ) {}

  public function execute(CreateTicketInputDto $inputDto): CreateTicketOutputDto
  {
    $serviceResponse = $this->service->createTicketService($inputDto);
    return $this->transformer->transformCreateTicketResponse($serviceResponse);
  }
}
