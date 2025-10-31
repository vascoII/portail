<?php

declare(strict_types=1);

namespace App\Application\UseCase\Ticket;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\DataProvider\TicketDataProviderInterface;

final class PatchTicketUseCase
{
    public function __construct(
        private readonly TicketDataProviderInterface $dataProvider
    ) {}

    public function execute(GetByIdIntInputDto $inputDto): SuccessOutputDto
    {
        return $this->dataProvider->patchTicketService($inputDto);
    }
}
