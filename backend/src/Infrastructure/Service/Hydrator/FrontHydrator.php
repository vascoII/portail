<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Dto\Input\Front\IndexInputDto;
use App\Application\Dto\Input\Front\CguInputDto;
use App\Application\Dto\Input\Front\LegalNoticesInputDto;

final class FrontHydrator
{
  public function __construct(
    private readonly string $superLoginID,
    private readonly string $superPassword
  ) {}

  public function hydrateIndex(IndexInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on IndexInputDto properties
    ];
  }

  public function hydrateCgu(CguInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on CguInputDto properties
    ];
  }

  public function hydratePersonalDatas(): object
  {
    return (object) [
      'SuperLoginID' => $this->superLoginID,
      'SuperPassword' => $this->superPassword,
    ];
  }

  public function hydrateLegalNotices(LegalNoticesInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on LegalNoticesInputDto properties
    ];
  }
}
