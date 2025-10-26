<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Dto\Output\Shared\UserDto;
use App\Application\Service\Auth\AuthServiceInterface;

final class AuthorizationService
{
  public function __construct(
    private readonly AuthServiceInterface $authService
  ) {}

  /**
   * Vérifie si le type d'utilisateur actuel est autorisé
   * 
   * @param array $allowedTypes Types autorisés ['C', 'G', 'O']
   * @return bool true si autorisé, false sinon
   */
  public function isUserTypeAllowed(array $allowedTypes): bool
  {
    $user = $this->authService->getCurrentUser();

    if (!$user || !$user->userType) {
      return false;
    }

    return in_array($user->userType, $allowedTypes, true);
  }

  /**
   * Récupère le type d'utilisateur actuellement connecté
   * 
   * @return string|null Type d'utilisateur ('C', 'G', 'O') ou null si non connecté
   */
  public function getCurrentUserType(): ?string
  {
    $user = $this->authService->getCurrentUser();
    return $user?->userType;
  }
}
