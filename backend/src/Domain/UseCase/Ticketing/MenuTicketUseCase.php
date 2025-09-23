<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\MenuTicketInputDto;
use App\Application\Dto\Output\Ticketing\MenuTicketOutputDto;
use App\Infrastructure\Transformer\TicketingTransformer;
use App\Domain\Service\Soap\TicketingSoapInterface;

final class MenuTicketUseCase
{
  public function __construct(
    private readonly TicketingSoapInterface $service,
    private readonly TicketingTransformer $transformer
  ) {}

  public function execute(MenuTicketInputDto $inputDto): MenuTicketOutputDto
  {
    $soapResponse = $this->service->menuTicketService($inputDto);
    return $this->transformer->transformMenuTicketResponse($soapResponse);
  }
}
