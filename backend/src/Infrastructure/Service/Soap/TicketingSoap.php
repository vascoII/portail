<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\Ticketing\AttachmentTicketInputDto;
use App\Application\Dto\Input\Ticketing\CloseTicketInputDto;
use App\Application\Dto\Input\Ticketing\CreateTicketInputDto;
use App\Application\Dto\Input\Ticketing\MenuTicketInputDto;
use App\Application\Dto\Input\Ticketing\TableTicketingInputDto;
use App\Application\Dto\Input\Ticketing\TicketListInputDto;
use App\Domain\Service\Soap\TicketingSoapInterface;
use App\Infrastructure\Hydrator\TicketingHydrator;
use App\Domain\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Soap\SoapClient;

final class TicketingSoap implements TicketingSoapInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly TicketingHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {}

  public function attachmentTicketService(AttachmentTicketInputDto $inputDto): array
  {
    // TODO: Implement attachmentTicketService logic
    return [];
  }

  public function closeTicketService(CloseTicketInputDto $inputDto): array
  {
    // TODO: Implement closeTicketService logic
    return [];
  }

  public function createTicketService(CreateTicketInputDto $inputDto): array
  {
    // TODO: Implement createTicketService logic
    return [];
  }

  public function menuTicketService(MenuTicketInputDto $inputDto): array
  {
    // TODO: Implement menuTicketService logic
    return [];
  }

  public function tableTicketingService(TableTicketingInputDto $inputDto): array
  {
    // TODO: Implement tableTicketingService logic
    return [];
  }

  public function ticketListService(TicketListInputDto $inputDto): array
  {
    // TODO: Implement ticketListService logic
    return [];
  }
}
