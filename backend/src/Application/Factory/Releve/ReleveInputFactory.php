<?php

declare(strict_types=1);

namespace App\Application\Factory\Releve;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Releve\CreateReleveInputDto;

final class ReleveInputFactory
{
  public function createPostReleveFromRequest(Request $request): CreateReleveInputDto
  {
    return new CreateReleveInputDto();
  }

}
