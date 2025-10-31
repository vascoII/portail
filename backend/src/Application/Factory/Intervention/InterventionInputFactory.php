<?php

declare(strict_types=1);

namespace App\Application\Factory\Intervention;

use App\Application\Dto\Input\Intervention\GetCasesByEmailInpuDto;
use Symfony\Component\HttpFoundation\Request;

final class InterventionInputFactory
{
    public function createGetCasesByEmailFromRequest(Request $request): GetCasesByEmailInpuDto
    {
        $raw = (string) $request->getContent();
        $data = json_decode($raw, true);

        if (! is_array($data)) {
            $data = [];
        }

        $email = array_key_exists('email', $data) && null !== $data['email']
        ? (string) $data['email']
        : '';

        return new GetCasesByEmailInpuDto(
            (int) $request->query->get('id'),
            $email
        );
    }
}
