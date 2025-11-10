<?php

declare(strict_types=1);

namespace App\Application\Validator\Input\Document\Excel;

use App\Application\Validator\Input\InputValidatorInterface;
use App\Domain\Exception\DomainExceptionFactory;
use App\Http\Action\Document\Excel\GenerateAnomaliesExcelAction;
use App\Http\Action\Document\Excel\GenerateDysfonctionnementsExcelAction;
use App\Http\Action\Document\Excel\GenerateFuitesExcelAction;
use App\Http\Action\Document\Excel\GenerateImmeubleInterventionsExcelAction;
use App\Http\Action\Document\Excel\GenerateInterventionsExcelAction;

final class GenerateExcelInputValidator implements InputValidatorInterface
{
  public function validateGenerateAnomaliesExcelInput(array $data): void
  {
    $errors = [];

    if (! isset($data['pkImmeuble'])) {
      $errors[] = DomainExceptionFactory::requiredField('pkImmeuble', GenerateAnomaliesExcelAction::class);
    } elseif (filter_var($data['pkImmeuble'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('pkImmeuble', 'integer', GenerateAnomaliesExcelAction::class);
    }

    if (isset($data['pkLogement']) && $data['pkLogement'] !== null && filter_var($data['pkLogement'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('pkLogement', 'integer', GenerateAnomaliesExcelAction::class);
    }

    if (isset($data['pkOccupant']) && $data['pkOccupant'] !== null && filter_var($data['pkOccupant'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('pkOccupant', 'integer', GenerateAnomaliesExcelAction::class);
    }

    if (isset($data['pkAppareil']) && $data['pkAppareil'] !== null && filter_var($data['pkAppareil'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('pkAppareil', 'integer', GenerateAnomaliesExcelAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(GenerateAnomaliesExcelAction::class, $errors);
    }
  }

  public function validateGenerateDysfonctionnementsExcelInput(array $data): void
  {
    $errors = [];

    if (! isset($data['pkImmeuble'])) {
      $errors[] = DomainExceptionFactory::requiredField('pkImmeuble', GenerateDysfonctionnementsExcelAction::class);
    } elseif (filter_var($data['pkImmeuble'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('pkImmeuble', 'integer', GenerateDysfonctionnementsExcelAction::class);
    }

    if (isset($data['pkLogement']) && $data['pkLogement'] !== null && filter_var($data['pkLogement'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('pkLogement', 'integer', GenerateDysfonctionnementsExcelAction::class);
    }

    if (isset($data['pkOccupant']) && $data['pkOccupant'] !== null && filter_var($data['pkOccupant'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('pkOccupant', 'integer', GenerateDysfonctionnementsExcelAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(GenerateDysfonctionnementsExcelAction::class, $errors);
    }
  }

  public function validateGenerateFuitesExcelInput(array $data): void
  {
    $errors = [];

    if (! isset($data['pkImmeuble'])) {
      $errors[] = DomainExceptionFactory::requiredField('pkImmeuble', GenerateFuitesExcelAction::class);
    } elseif (filter_var($data['pkImmeuble'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('pkImmeuble', 'integer', GenerateFuitesExcelAction::class);
    }

    if (isset($data['pkLogement']) && $data['pkLogement'] !== null && filter_var($data['pkLogement'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('pkLogement', 'integer', GenerateFuitesExcelAction::class);
    }

    if (isset($data['pkOccupant']) && $data['pkOccupant'] !== null && filter_var($data['pkOccupant'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('pkOccupant', 'integer', GenerateFuitesExcelAction::class);
    }

    if (isset($data['pkAppareil']) && $data['pkAppareil'] !== null && filter_var($data['pkAppareil'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('pkAppareil', 'integer', GenerateFuitesExcelAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(GenerateFuitesExcelAction::class, $errors);
    }
  }

  public function validateGenerateImmeubleInterventionsExcel(array $data): void
  {
    $errors = [];

    if (! isset($data['pkImmeuble'])) {
      $errors[] = DomainExceptionFactory::requiredField('pkImmeuble', GenerateImmeubleInterventionsExcelAction::class);
    } elseif (filter_var($data['pkImmeuble'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('pkImmeuble', 'integer', GenerateImmeubleInterventionsExcelAction::class);
    }

    if (isset($data['date1']) && $data['date1'] !== null && \DateTimeImmutable::createFromFormat('Y-m-d', (string) $data['date1']) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('date1', 'date au format YYYY-MM-DD', GenerateImmeubleInterventionsExcelAction::class);
    }

    if (isset($data['date2']) && $data['date2'] !== null && \DateTimeImmutable::createFromFormat('Y-m-d', (string) $data['date2']) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('date2', 'date au format YYYY-MM-DD', GenerateImmeubleInterventionsExcelAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(GenerateImmeubleInterventionsExcelAction::class, $errors);
    }
  }

  public function validateGenerateInterventionsExcelInput(array $data): void
  {
    $errors = [];

    if (isset($data['pkImmeuble']) && $data['pkImmeuble'] !== null && filter_var($data['pkImmeuble'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('pkImmeuble', 'integer', GenerateInterventionsExcelAction::class);
    }

    if (isset($data['pkLogement']) && $data['pkLogement'] !== null && filter_var($data['pkLogement'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('pkLogement', 'integer', GenerateInterventionsExcelAction::class);
    }

    if (isset($data['pkOccupant']) && $data['pkOccupant'] !== null && filter_var($data['pkOccupant'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('pkOccupant', 'integer', GenerateInterventionsExcelAction::class);
    }

    if (isset($data['date1']) && $data['date1'] !== null && \DateTimeImmutable::createFromFormat('Y-m-d', (string) $data['date1']) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('date1', 'date au format YYYY-MM-DD', GenerateInterventionsExcelAction::class);
    }

    if (isset($data['date2']) && $data['date2'] !== null && \DateTimeImmutable::createFromFormat('Y-m-d', (string) $data['date2']) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('date2', 'date au format YYYY-MM-DD', GenerateInterventionsExcelAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(GenerateInterventionsExcelAction::class, $errors);
    }
  }
}
