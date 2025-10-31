<?php

declare(strict_types=1);

namespace App\Application\Factory\Releve;

use App\Application\Dto\Input\Releve\CreateReleveInputDto;
use Symfony\Component\HttpFoundation\Request;

final class ReleveInputFactory
{
    public function createPostReleveFromRequest(Request $request): CreateReleveInputDto
    {
        return new CreateReleveInputDto();
    }
}
