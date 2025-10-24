<?php

declare(strict_types=1);

namespace App\Application\Factory\Ticket;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Ticket\CreateTicketInterInputDto;

final class TicketInputFactory
{
  public function createGetByIdFromRequest(Request $request, array $args = []): CreateTicketInterInputDto
  {
    $raw = (string) $request->getContent();
    $data = json_decode($raw, true);

    if (!is_array($data)) {
      $data = [];
    }

    $pkLogement = array_key_exists('pkLogement', $data) && $data['pkLogement'] !== null
      ? (int) $data['pkLogement']
      : '';
    $name = array_key_exists('name', $data) && $data['name'] !== null
      ? (string) $data['name']
      : '';
    $email = array_key_exists('email', $data) && $data['email'] !== null
      ? (string) $data['email']
      : '';
    $phone = array_key_exists('phone', $data) && $data['phone'] !== null
    ? (string) $data['phone']
    : '';
    $mobile = array_key_exists('mobile', $data) && $data['mobile'] !== null
    ? (string) $data['mobile']
    : '';
    $objet = array_key_exists('objet', $data) && $data['objet'] !== null
    ? (string) $data['objet']
    : '';
    $message = array_key_exists('message', $data) && $data['message'] !== null
    ? (string) $data['message']
    : '';
    $attachmentName = array_key_exists('attachmentName', $data) && $data['nattachmentNameame'] !== null
    ? (string) $data['attachmentName']
    : '';
    $attachmentContent = array_key_exists('attachmentContent', $data) && $data['attachmentContent'] !== null
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
