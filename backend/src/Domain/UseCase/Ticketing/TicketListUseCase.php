<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\TicketListInputDto;
use App\Application\Dto\Output\Ticketing\TicketListOutputDto;
use App\Infrastructure\Transformer\TicketingTransformer;
use App\Domain\Service\Soap\TicketingSoapInterface;

final class TicketListUseCase
{
  public function __construct(
    private readonly TicketingSoapInterface $service,
    private readonly TicketingTransformer $transformer
  ) {}

  public function execute(TicketListInputDto $inputDto): TicketListOutputDto
  {
    $serviceResponse = $this->service->ticketListService($inputDto);
    return $this->transformer->transformTicketListResponse($serviceResponse);
  }
}
