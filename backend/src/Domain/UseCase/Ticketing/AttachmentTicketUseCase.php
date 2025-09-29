<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\AttachmentTicketInputDto;
use App\Application\Dto\Output\Ticketing\AttachmentTicketOutputDto;
use App\Application\Service\DataProvider\TicketingDataProviderInterface;

final class AttachmentTicketUseCase
{
  public function __construct(
    private readonly TicketingDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(AttachmentTicketInputDto $inputDto): AttachmentTicketOutputDto
  {
    return $this->serviceDataProvider->attachmentTicketService($inputDto);
  }
}
