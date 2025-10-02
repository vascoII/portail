<?php

declare(strict_types=1);

namespace App\Application\UseCase\Ticketing;

use App\Application\Dto\Input\Ticketing\GetAttachmentInputDto;
use App\Application\Dto\Output\Ticketing\GetAttachmentOutputDto;
use App\Application\Service\DataProvider\TicketingDataProviderInterface;

final class AttachmentTicketUseCase
{
  public function __construct(
    private readonly TicketingDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(GetAttachmentInputDto $inputDto): GetAttachmentOutputDto
  {
    return $this->serviceDataProvider->attachmentTicketService($inputDto);
  }
}
