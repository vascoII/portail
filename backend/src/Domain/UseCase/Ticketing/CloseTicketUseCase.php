<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\CloseTicketInputDto;
use App\Application\Dto\Output\Ticketing\CloseTicketOutputDto;
use App\Infrastructure\Transformer\TicketingTransformer;
use App\Domain\Service\Soap\TicketingSoapInterface;

final class CloseTicketUseCase
{
  public function __construct(
    private readonly TicketingSoapInterface $service,
    private readonly TicketingTransformer $transformer
  ) {}

  public function execute(CloseTicketInputDto $inputDto): CloseTicketOutputDto
  {
    $soapResponse = $this->service->closeTicketService($inputDto);
    return $this->transformer->transformCloseTicketResponse($soapResponse);
  }
}
