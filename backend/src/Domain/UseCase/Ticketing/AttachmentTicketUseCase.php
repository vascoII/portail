<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\AttachmentTicketInputDto;
use App\Application\Dto\Output\Ticketing\AttachmentTicketOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class AttachmentTicketUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof AttachmentTicketInputDto);
    return new AttachmentTicketOutputDto([]);
  }
}
