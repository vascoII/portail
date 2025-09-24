<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\TableTicketingInputDto;
use App\Application\Dto\Output\Ticketing\TableTicketingOutputDto;
use App\Infrastructure\Transformer\TicketingTransformer;
use App\Domain\Service\Soap\TicketingSoapInterface;

final class TableTicketingUseCase
{
  public function __construct(
    private readonly TicketingSoapInterface $service,
    private readonly TicketingTransformer $transformer
  ) {}

  public function execute(TableTicketingInputDto $inputDto): TableTicketingOutputDto
  {
    $serviceResponse = $this->service->tableTicketingService($inputDto);
    return $this->transformer->transformTableTicketingResponse($serviceResponse);
  }
}
