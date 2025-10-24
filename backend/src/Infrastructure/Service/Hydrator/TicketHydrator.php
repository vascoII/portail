<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Input\Ticket\CreateTicketInterInputDto;

final class TicketHydrator
{
    public function hydrateCreateTicket(CreateTicketInterInputDto $inputDto): object
    {
        return (object) [
            'PkLogement' => $inputDto->pkLogement,
            'Nom' => $inputDto->name,
            'Email' => $inputDto->email,
            'TelFixe' => $inputDto->phone,
            'TelMobile' => $inputDto->mobile,
            'Objet' => $inputDto->objet,
            'MotifLibre' => $inputDto->message,
            'AttachmentName' => $inputDto->attachmentName,
            'AttachmentContent' => $inputDto->attachmentContent,
        ];
    }

    public function hydrateListTickets(): object
    {
        return (object) [
            'SHOWALL' => null,
        ];
    }

    public function hydratePatchTicket(GetByIdIntInputDto $inputDto): object
    {
        return (object) [
            'pkticket' => $inputDto->id,
            'statut' => 'Clos',
        ];
    }
}
