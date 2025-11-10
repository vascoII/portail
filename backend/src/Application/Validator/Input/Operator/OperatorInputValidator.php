<?php

declare(strict_types=1);

namespace App\Application\Validator\Input\Operator;

use App\Application\Validator\Input\InputValidatorInterface;
use App\Domain\Exception\DomainExceptionFactory;
use App\Http\Action\Operator\AddBuildingToOperatorAction;
use App\Http\Action\Operator\CreateOperatorAction;
use App\Http\Action\Operator\PatchOperatorAction;
use App\Http\Action\Operator\PutOperatorAction;
use App\Http\Action\Operator\RemoveBuildingToOperatorAction;

final class OperatorInputValidator implements InputValidatorInterface
{
  public function validateAddBuildingToOperatorInput(array $data): void
  {
    $errors = [];

    if (! isset($data['operatorId'])) {
      $errors[] = DomainExceptionFactory::requiredField('operatorId', AddBuildingToOperatorAction::class);
    } elseif (filter_var($data['operatorId'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('operatorId', 'integer', AddBuildingToOperatorAction::class);
    }

    if (! isset($data['immeubleId'])) {
      $errors[] = DomainExceptionFactory::requiredField('immeubleId', AddBuildingToOperatorAction::class);
    } elseif (filter_var($data['immeubleId'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('immeubleId', 'integer', AddBuildingToOperatorAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(AddBuildingToOperatorAction::class, $errors);
    }
  }
  public function validateCreateOperatorInput(array $data): void
  {
    $errors = [];

    if (! filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
      $errors[] = DomainExceptionFactory::invalidFormat('email', 'email', CreateOperatorAction::class);
    }

    if (! preg_match('/^\+?[0-9]{7,15}$/', $data['phone'] ?? '')) {
      $errors[] = DomainExceptionFactory::invalidFormat('phone', 'international phone number', CreateOperatorAction::class);
    }

    if (empty($data['lastname'])) {
      $errors[] = DomainExceptionFactory::requiredField('lastname', CreateOperatorAction::class);
    }

    if (empty($data['firstname'])) {
      $errors[] = DomainExceptionFactory::requiredField('firstname', CreateOperatorAction::class);
    }

    if (empty($data['job'])) {
      $errors[] = DomainExceptionFactory::requiredField('job', CreateOperatorAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(CreateOperatorAction::class, $errors);
    }
  }

  public function validatePatchOperatorInput(array $data): void
  {
    $errors = [];

    if (! isset($data['id'])) {
      $errors[] = DomainExceptionFactory::requiredField('id', PatchOperatorAction::class);
    } elseif (filter_var($data['id'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('id', 'integer', PatchOperatorAction::class);
    }

    if (empty($data['password'])) {
      $errors[] = DomainExceptionFactory::requiredField('password', PatchOperatorAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(PatchOperatorAction::class, $errors);
    }
  }

  public function validatePutOperatorInput(array $data): void
  {
    $errors = [];

    if (! isset($data['id'])) {
      $errors[] = DomainExceptionFactory::requiredField('id', PutOperatorAction::class);
    } elseif (filter_var($data['id'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('id', 'integer', PutOperatorAction::class);
    }

    if (! filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
      $errors[] = DomainExceptionFactory::invalidFormat('email', 'email', PutOperatorAction::class);
    }

    if (! preg_match('/^\+?[0-9]{7,15}$/', $data['phone'] ?? '')) {
      $errors[] = DomainExceptionFactory::invalidFormat('phone', 'international phone number', PutOperatorAction::class);
    }

    if (empty($data['lastname'])) {
      $errors[] = DomainExceptionFactory::requiredField('lastname', PutOperatorAction::class);
    }

    if (empty($data['firstname'])) {
      $errors[] = DomainExceptionFactory::requiredField('firstname', PutOperatorAction::class);
    }

    if (empty($data['job'])) {
      $errors[] = DomainExceptionFactory::requiredField('job', PutOperatorAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(PutOperatorAction::class, $errors);
    }
  }

  public function validateRemoveBuildingToOperatorInput(array $data): void
  {
    $errors = [];

    if (! isset($data['operatorId'])) {
      $errors[] = DomainExceptionFactory::requiredField('operatorId', RemoveBuildingToOperatorAction::class);
    } elseif (filter_var($data['operatorId'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('operatorId', 'integer', RemoveBuildingToOperatorAction::class);
    }

    if (! isset($data['immeubleId'])) {
      $errors[] = DomainExceptionFactory::requiredField('immeubleId', RemoveBuildingToOperatorAction::class);
    } elseif (filter_var($data['immeubleId'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('immeubleId', 'integer', RemoveBuildingToOperatorAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(RemoveBuildingToOperatorAction::class, $errors);
    }
  }
}
