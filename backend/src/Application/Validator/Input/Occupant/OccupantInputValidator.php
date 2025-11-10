<?php

declare(strict_types=1);

namespace App\Application\Validator\Input\Occupant;

use App\Application\Validator\Input\InputValidatorInterface;
use App\Domain\Exception\DomainExceptionFactory;
use App\Http\Action\Occupant\PatchOccupantAction;
use App\Http\Action\Occupant\PostOccupantAction;

final class OccupantInputValidator implements InputValidatorInterface
{
  public function validatePostOccupantInput(array $data): void
  {
    $errors = [];

    if (empty($data['nom'])) {
      $errors[] = DomainExceptionFactory::requiredField('nom', PostOccupantAction::class);
    }

    if (! isset($data['ref'])) {
      $errors[] = DomainExceptionFactory::requiredField('ref', PostOccupantAction::class);
    } elseif (! is_string($data['ref']) || $data['ref'] === '') {
      $errors[] = DomainExceptionFactory::invalidFormat('ref', 'non-empty string', PostOccupantAction::class);
    }

    if (isset($data['dateArrivee']) && $data['dateArrivee'] !== null && \DateTimeImmutable::createFromFormat('Y-m-d', (string) $data['dateArrivee']) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('dateArrivee', 'date au format YYYY-MM-DD', PostOccupantAction::class);
    }

    if (isset($data['dateDepart']) && $data['dateDepart'] !== null && \DateTimeImmutable::createFromFormat('Y-m-d', (string) $data['dateDepart']) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('dateDepart', 'date au format YYYY-MM-DD', PostOccupantAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(PostOccupantAction::class, $errors);
    }
  }

  public function validatePatchOccupantInput(array $data): void
  {
    $errors = [];

    if (! isset($data['pkOccupant'])) {
      $errors[] = DomainExceptionFactory::requiredField('pkOccupant', PatchOccupantAction::class);
    } elseif (filter_var($data['pkOccupant'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('pkOccupant', 'integer', PatchOccupantAction::class);
    }

    if (isset($data['nom']) && $data['nom'] !== null && $data['nom'] === '') {
      $errors[] = DomainExceptionFactory::invalidFormat('nom', 'non-empty string', PatchOccupantAction::class);
    }

    if (isset($data['ref']) && $data['ref'] !== null && $data['ref'] === '') {
      $errors[] = DomainExceptionFactory::invalidFormat('ref', 'non-empty string', PatchOccupantAction::class);
    }

    if (isset($data['dateArrivee']) && $data['dateArrivee'] !== null && \DateTimeImmutable::createFromFormat('Y-m-d', (string) $data['dateArrivee']) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('dateArrivee', 'date au format YYYY-MM-DD', PatchOccupantAction::class);
    }

    if (isset($data['dateDepart']) && $data['dateDepart'] !== null && \DateTimeImmutable::createFromFormat('Y-m-d', (string) $data['dateDepart']) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('dateDepart', 'date au format YYYY-MM-DD', PatchOccupantAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(PatchOccupantAction::class, $errors);
    }
  }
}
