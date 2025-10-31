<?php

declare(strict_types=1);

namespace App\Application\Factory\Ticket;

use App\Application\Dto\Input\Ticket\CreateTicketInterInputDto;
use Symfony\Component\HttpFoundation\Request;

final class TicketInputFactory
{
    public function createGetByIdFromRequest(Request $request, array $args = []): CreateTicketInterInputDto
    {
        $raw = (string) $request->getContent();
        $data = json_decode($raw, true);

        if (! is_array($data)) {
            $data = [];
        }

        $pkLogement = array_key_exists('pkLogement', $data) && null !== $data['pkLogement']
          ? (int) $data['pkLogement']
          : '';
        $name = array_key_exists('name', $data) && null !== $data['name']
          ? (string) $data['name']
          : '';
        $email = array_key_exists('email', $data) && null !== $data['email']
          ? (string) $data['email']
          : '';
        $phone = array_key_exists('phone', $data) && null !== $data['phone']
        ? (string) $data['phone']
        : '';
        $mobile = array_key_exists('mobile', $data) && null !== $data['mobile']
        ? (string) $data['mobile']
        : '';
        $objet = array_key_exists('objet', $data) && null !== $data['objet']
        ? (string) $data['objet']
        : '';
        $message = array_key_exists('message', $data) && null !== $data['message']
        ? (string) $data['message']
        : '';
        $attachmentName = array_key_exists('attachmentName', $data) && null !== $data['nattachmentNameame']
        ? (string) $data['attachmentName']
        : '';
        $attachmentContent = array_key_exists('attachmentContent', $data) && null !== $data['attachmentContent']
        ? (string) $data['attachmentContent']
        : '';

        return new CreateTicketInterInputDto(
            $pkLogement,
            $name,
            $email,
            $phone,
            $mobile,
            $objet,
            $message,
            $attachmentName,
            $attachmentContent
        );
    }
}
