<?php

declare(strict_types=1);

namespace App\Application\Validator\Input\Security;

use App\Application\Validator\Input\InputValidatorInterface;
use App\Domain\Exception\DomainExceptionFactory;
use App\Http\Action\Security\LoginAction;
use App\Http\Action\Security\ResetPasswordAction;
use App\Http\Action\Security\UpdatePasswordAction;
use App\Http\Action\Security\UpdateEmailAction;
use App\Http\Action\Security\UpdateCguAction;

final class SecurityInputValidator implements InputValidatorInterface
{
  public function validateLoginInput(array $data): void
  {
    $errors = [];

    if (empty($data['username'])) {
      $errors[] = DomainExceptionFactory::requiredField('username', LoginAction::class);
    }

    if (empty($data['password'])) {
      $errors[] = DomainExceptionFactory::requiredField('password', LoginAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(LoginAction::class, $errors);
    }
  }

  public function validateResetPasswordInput(array $data): void
  {
    $errors = [];

    if (isset($data['email']) && ! filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
      $errors[] = DomainExceptionFactory::invalidFormat('email', 'email', ResetPasswordAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(ResetPasswordAction::class, $errors);
    }
  }

  public function validateUpdatePasswordInput(array $data): void
  {
    $errors = [];

    if (empty($data['pkUser'])) {
      $errors[] = DomainExceptionFactory::requiredField('pkUser', UpdatePasswordAction::class);
    }

    if (empty($data['password'])) {
      $errors[] = DomainExceptionFactory::requiredField('password', UpdatePasswordAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(UpdatePasswordAction::class, $errors);
    }
  }

  public function validateUpdateEmailInput(array $data): void
  {
    $errors = [];

    if (! isset($data['pkUser']) || ! is_int($data['pkUser'])) {
      $errors[] = DomainExceptionFactory::requiredField('pkUser', UpdateEmailAction::class);
    }

    if (empty($data['email'])) {
      $errors[] = DomainExceptionFactory::requiredField('email', UpdateEmailAction::class);
    } elseif (! filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
      $errors[] = DomainExceptionFactory::invalidFormat('email', 'email', UpdateEmailAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(UpdateEmailAction::class, $errors);
    }
  }

  public function validateUpdateCguInput(array $data): void
  {
    $errors = [];

    if (! isset($data['pkUser']) || ! is_int($data['pkUser'])) {
      $errors[] = DomainExceptionFactory::requiredField('pkUser', UpdateCguAction::class);
    }

    if (empty($data['cgu'])) {
      $errors[] = DomainExceptionFactory::requiredField('cgu', UpdateCguAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(UpdateCguAction::class, $errors);
    }
  }
}
