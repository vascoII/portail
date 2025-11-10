<?php

declare(strict_types=1);

namespace App\Application\Validator\Input\External\Suivi;

use App\Application\Validator\Input\InputValidatorInterface;
use App\Domain\Exception\DomainExceptionFactory;
use App\Http\Action\External\Suivi\ListWorkOrdersAction;

final class ListWorkOrdersInputValidator implements InputValidatorInterface
{
  public function validate(array $data): void
  {
    $errors = [];

    if (! isset($data['caseId'])) {
      $errors[] = DomainExceptionFactory::requiredField('caseId', ListWorkOrdersAction::class);
    } elseif (filter_var($data['caseId'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('caseId', 'integer', ListWorkOrdersAction::class);
    }

    if (! filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
      $errors[] = DomainExceptionFactory::invalidFormat('email', 'email', ListWorkOrdersAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(ListWorkOrdersAction::class, $errors);
    }
  }
}
