<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\Transformer\TicketTransformerInterface;

final class TicketTransformer implements TicketTransformerInterface
{
    public function transformCreateTicket(object $dataSourceResult): SuccessOutputDto
    {
        // TODO: Transform actual response when SOAP method is known
        return new SuccessOutputDto(true);
    }

    public function transformGetTicket(object $dataSourceResult): SuccessOutputDto
    {
        // TODO: Transform actual response when SOAP method is known
        return new SuccessOutputDto(true);
    }

    public function transformListTickets(object $dataSourceResult): SuccessOutputDto
    {
        // TODO: Transform actual response when SOAP method is known
        return new SuccessOutputDto(true);
    }

    public function transformPatchTicket(object $dataSourceResult): SuccessOutputDto
    {
        // TODO: Transform actual response when SOAP method is known
        return new SuccessOutputDto(true);
    }
}
