<?php

declare(strict_types=1);

namespace App\Application\Factory\Intervention;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Intervention\GetCasesByEmailInpuDto;

final class InterventionInputFactory
{
  public function createGetCasesByEmailFromRequest(Request $request): GetCasesByEmailInpuDto
  {
    $raw = (string) $request->getContent();
    $data = json_decode($raw, true);

    if (!is_array($data)) {
      $data = [];
    }

    $email = array_key_exists('email', $data) && $data['email'] !== null
    ? (string) $data['email']
    : '';
    
    return new GetCasesByEmailInpuDto(
        (int) $request->query->get('id'),
        $email
    );
    
    
  }

}
