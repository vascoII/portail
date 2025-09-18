<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\AttachmentTicketInputDto;
use App\Application\Dto\Output\Ticketing\AttachmentTicketOutputDto;

use App\Domain\Service\Soap\TicketingSoapInterface;

final class AttachmentTicketUseCase
{
  public function __construct(private readonly TicketingSoapInterface $service) {}

  public function execute(AttachmentTicketInputDto $inputDto): AttachmentTicketOutputDto
  {
    return $this->service->attachmentTicketService($inputDto);
  }
}
